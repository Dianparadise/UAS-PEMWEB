<?php
session_start();
require_once '../../config/koneksi.php';

if (!isset($_SESSION['status']) || $_SESSION['role'] !== 'admin') {
    header("location: ../../public/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];

    // 1. Resmi ubah role user menjadi alumni
    mysqli_query($conn, "UPDATE users SET role='alumni' WHERE id='$user_id'");

    // 2. Set status kelulusan di profil menjadi disetujui agar muncul di depan
    mysqli_query($conn, "UPDATE alumni_profiles SET status_kelulusan='disetujui' WHERE user_id='$user_id'");

    header("location: ../../public/admin_validasi.php");
    exit;
}