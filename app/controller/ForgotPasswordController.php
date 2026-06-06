<?php
session_start();
require_once '../../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    
    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if (mysqli_num_rows($query) > 0) {
        
        $_SESSION['reset_email'] = $email;

        header("location: ../../public/reset_password.php");
        exit;
    } else {
        header("location: ../../public/forgot_password.php?pesan=not_found");
        exit;
    }
} else {
    header("location: ../../public/login.php");
    exit;
}
