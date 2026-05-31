<?php

require_once __DIR__ . '/../../config/koneksi.php';

class UserModel {

    // Ambil user berdasarkan email login
    public static function getByEmail($email) {

        global $conn;

        $query = mysqli_query($conn,
            "SELECT * FROM users WHERE email='$email'"
        );

        return mysqli_fetch_assoc($query);
    }
}