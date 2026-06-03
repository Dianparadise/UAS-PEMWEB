<?php

require_once __DIR__ . '/../../config/koneksi.php';

class AlumniProfileModel
{

    // Ambil biodata berdasarkan user_id
    public static function getByUserId($user_id)
    {

        global $conn;

        $query = mysqli_query(
            $conn,
            "SELECT * FROM alumni_profiles
             WHERE user_id='$user_id'"
        );

        return mysqli_fetch_assoc($query);
    }
}

class AlumniHomeModel
{
    // 1. Menghitung total data untuk keperluan halaman (Pagination)
    public static function getTotalRows($search, $tahun, $angkatan, $jurusan, $fakultas)
    {
        global $conn;
        $sql = "SELECT COUNT(*) as total FROM alumni_profiles 
                JOIN users ON alumni_profiles.user_id = users.id WHERE 1=1 ";

        if (!empty($search)) {
            $sql .= " AND (users.nama LIKE '%$search%' OR alumni_profiles.pekerjaan LIKE '%$search%')";
        }
        if (!empty($tahun)) {
            $sql .= " AND alumni_profiles.tahun_kelulusan = '$tahun'";
        }
        if (!empty($angkatan)) {
            $sql .= " AND alumni_profiles.angkatan = '$angkatan'";
        }
        if (!empty($jurusan)) {
            $sql .= " AND alumni_profiles.jurusan = '$jurusan'";
        }
        if (!empty($fakultas)) {
            $sql .= " AND alumni_profiles.fakultas = '$fakultas'";
        }

        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($query);
        return $row['total'];
    }

    // 2. Fungsi Super (Gabungan getTerbaru, search, filter, dan Pagination)
    public static function getDataPaginated($search, $tahun, $angkatan, $jurusan, $fakultas, $limit, $offset)
    {
        global $conn;
        $sql = "SELECT alumni_profiles.*, users.nama FROM alumni_profiles 
                JOIN users ON alumni_profiles.user_id = users.id WHERE 1=1 ";

        if (!empty($search)) {
            $sql .= " AND (users.nama LIKE '%$search%' OR alumni_profiles.pekerjaan LIKE '%$search%')";
        }
        if (!empty($tahun)) {
            $sql .= " AND alumni_profiles.tahun_kelulusan = '$tahun'";
        }
        if (!empty($angkatan)) {
            $sql .= " AND alumni_profiles.angkatan = '$angkatan'";
        }
        if (!empty($jurusan)) {
            $sql .= " AND alumni_profiles.jurusan = '$jurusan'";
        }
        if (!empty($fakultas)) {
            $sql .= " AND alumni_profiles.fakultas = '$fakultas'";
        }

        // Urutkan dari yang terbaru, lalu potong datanya (LIMIT)
        $sql .= " ORDER BY alumni_profiles.tahun_kelulusan DESC, alumni_profiles.created_at DESC ";
        $sql .= " LIMIT $limit OFFSET $offset";

        return mysqli_query($conn, $sql);
    }

    // 3. Fungsi Detail (Tetap seperti aslimu)
    public static function getDetail($user_id)
    {
        global $conn;
        $user_id = mysqli_real_escape_string($conn, $user_id);

        $query = mysqli_query($conn, "
            SELECT 
                alumni_profiles.*,
                users.nama,
                users.email
            FROM alumni_profiles
            JOIN users 
                ON alumni_profiles.user_id = users.id
            WHERE users.id = '$user_id'
        ");

        return mysqli_fetch_assoc($query);
    }
}
