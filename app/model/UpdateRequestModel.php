<?php

require_once __DIR__ . '/../../config/koneksi.php';

class UpdateRequestModel {

    // Ambil semua riwayat pengajuan
    public static function getByAlumniId($alumni_id) {

        global $conn;

        return mysqli_query($conn,
            "SELECT * FROM update_requests
             WHERE alumni_id='$alumni_id'
             ORDER BY id DESC"
        );
    }
}