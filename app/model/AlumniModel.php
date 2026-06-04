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
            "SELECT
                a.*,
                j.nama_jurusan,
                f.nama_fakultas
            FROM alumni_profiles a
            LEFT JOIN jurusan j ON a.jurusan_id = j.id
            LEFT JOIN fakultas f ON j.fakultas_id = f.id
            WHERE a.user_id = $user_id"
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
        // MENGUBAH 'WHERE 1=1' MENJADI FILTER STATUS KELULUSAN YANG DISETUJUI
        $sql = "SELECT COUNT(*) as total
        FROM alumni_profiles a
        JOIN users u ON a.user_id = u.id
        LEFT JOIN jurusan j ON a.jurusan_id = j.id
        LEFT JOIN fakultas f ON j.fakultas_id = f.id
        WHERE a.status_kelulusan = 'disetujui'";

        if (!empty($search)) {
    $sql .= " AND (u.nama LIKE '%$search%' OR a.pekerjaan LIKE '%$search%')";
        }

        if (!empty($tahun)) {
            $sql .= " AND a.tahun_kelulusan = '$tahun'";
        }

        if (!empty($angkatan)) {
            $sql .= " AND a.angkatan = '$angkatan'";
        }

        if (!empty($jurusan)) {
            $sql .= " AND j.nama_jurusan = '$jurusan'";
        }

        if (!empty($fakultas)) {
            $sql .= " AND f.nama_fakultas = '$fakultas'";
        }
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($query);
        return $row['total'];
    }

    // 2. Fungsi Super (Gabungan getTerbaru, search, filter, dan Pagination)
    public static function getDataPaginated($search, $tahun, $angkatan, $jurusan, $fakultas, $limit, $offset)
    {
        global $conn;
        // MENGUBAH 'WHERE 1=1' MENJADI FILTER STATUS KELULUSAN YANG DISETUJUI
        $sql = "SELECT
                a.*,
                u.nama,
                j.nama_jurusan,
                f.nama_fakultas
            FROM alumni_profiles a
            JOIN users u ON a.user_id = u.id
            LEFT JOIN jurusan j ON a.jurusan_id = j.id
            LEFT JOIN fakultas f ON j.fakultas_id = f.id
            WHERE a.status_kelulusan = 'disetujui' ";
                
            if (!empty($search)) {
                $sql .= " AND (u.nama LIKE '%$search%' OR a.pekerjaan LIKE '%$search%')";
            }

            if (!empty($tahun)) {
                $sql .= " AND a.tahun_kelulusan = '$tahun'";
            }

            if (!empty($angkatan)) {
                $sql .= " AND a.angkatan = '$angkatan'";
            }

            if (!empty($jurusan)) {
                $sql .= " AND j.nama_jurusan = '$jurusan'";
            }

            if (!empty($fakultas)) {
                $sql .= " AND f.nama_fakultas = '$fakultas'";
            }
        // Urutkan dari yang terbaru, lalu potong datanya (LIMIT)
       $sql .= " ORDER BY a.tahun_kelulusan DESC, a.created_at DESC ";
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
            a.*,
            u.nama,
            u.email,
            j.nama_jurusan,
            f.nama_fakultas
        FROM alumni_profiles a
        JOIN users u
            ON a.user_id = u.id
        LEFT JOIN jurusan j
            ON a.jurusan_id = j.id
        LEFT JOIN fakultas f
            ON j.fakultas_id = f.id
        WHERE u.id = '$user_id'
    ");
        return mysqli_fetch_assoc($query);
    }
}