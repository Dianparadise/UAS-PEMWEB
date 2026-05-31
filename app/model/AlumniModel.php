<?php

require_once __DIR__ . '/../../config/koneksi.php';

class AlumniProfileModel {

    // Ambil biodata berdasarkan user_id
    public static function getByUserId($user_id) {

        global $conn;

        $query = mysqli_query($conn,
            "SELECT * FROM alumni_profiles
             WHERE user_id='$user_id'"
        );

        return mysqli_fetch_assoc($query);
    }
}
class AlumniHomeModel {

    public static function getTerbaru() {

        global $conn;

        $query = mysqli_query($conn, "
            SELECT 
                alumni_profiles.*,
                users.nama
            FROM alumni_profiles
            JOIN users 
                ON alumni_profiles.user_id = users.id
            ORDER BY alumni_profiles.created_at DESC
            LIMIT 6
        ");

        return $query;
    }
}