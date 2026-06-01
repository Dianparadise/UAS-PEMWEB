<?php
session_start();
require_once '../../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Cari tahu apakah email terdaftar di tabel users
    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if (mysqli_num_rows($query) > 0) {
        // Jika ketemu, simpan tanda keamanan di session bahwa email ini diizinkan reset password
        $_SESSION['reset_email'] = $email;

        // Alihkan ke halaman input password baru
        header("location: ../../public/reset_password.php");
        exit;
    } else {
        // Jika email tidak terdaftar
        header("location: ../../public/forgot_password.php?pesan=not_found");
        exit;
    }
} else {
    header("location: ../../public/login.php");
    exit;
}
