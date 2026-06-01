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

    public static function getTerbaru()
    {

        global $conn;

        $query = mysqli_query($conn, "
            SELECT 
                alumni_profiles.*,
                users.nama
            FROM alumni_profiles
            JOIN users 
                ON alumni_profiles.user_id = users.id
            ORDER BY alumni_profiles.tahun_kelulusan DESC
            LIMIT 15
        ");

        return $query;
    }
    // Tambahkan fungsi ini di bawah fungsi getTerbaru()
    public static function getDetail($user_id)
    {
        global $conn;

        // Mencegah SQL Injection
        $user_id = mysqli_real_escape_string($conn, $user_id);

        // Pastikan format komanya pas seperti di bawah ini
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
    public static function search($search) {

    global $conn;

    $sql = "
        SELECT 
            alumni_profiles.*,
            users.nama
        FROM alumni_profiles
        JOIN users
            ON alumni_profiles.user_id = users.id
        WHERE 
            users.nama LIKE '%$search%'
            OR alumni_profiles.pekerjaan LIKE '%$search%'
        ORDER BY alumni_profiles.created_at DESC
    ";

    return mysqli_query($conn, $sql);

    
}
    public static function filter(
    $search,
    $tahun,
    $angkatan,
    $jurusan,
    $fakultas
) {

    global $conn;

    $sql = "
        SELECT 
            alumni_profiles.*,
            users.nama
        FROM alumni_profiles
        JOIN users
            ON alumni_profiles.user_id = users.id
        WHERE 1=1
    ";

    // SEARCH
    if (!empty($search)) {

        $sql .= "
            AND (
                users.nama LIKE '%$search%'
                OR alumni_profiles.pekerjaan LIKE '%$search%'
            )
        ";
    }

    // TAHUN
    if (!empty($tahun)) {

        $sql .= "
            AND alumni_profiles.tahun_kelulusan = '$tahun'
        ";
    }

    // ANGKATAN
    if (!empty($angkatan)) {

        $sql .= "
            AND alumni_profiles.angkatan = '$angkatan'
        ";
    }

    // JURUSAN
    if (!empty($jurusan)) {

        $sql .= "
            AND alumni_profiles.jurusan = '$jurusan'
        ";
    }

    // FAKULTAS
    if (!empty($fakultas)) {

        $sql .= "
            AND alumni_profiles.fakultas = '$fakultas'
        ";
    }

    $sql .= "
        ORDER BY alumni_profiles.created_at DESC
    ";

    return mysqli_query($conn, $sql);
}
}

