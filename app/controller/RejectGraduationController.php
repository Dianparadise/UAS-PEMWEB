<?php
session_start();
require_once '../../config/koneksi.php';

if (!isset($_SESSION['status']) || $_SESSION['role'] !== 'admin') {
    header("location: ../../public/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];

    // Tolak status kelulusan, role user tetap dibiarkan sebagai mahasiswa
    mysqli_query($conn, "UPDATE alumni_profiles SET status_kelulusan='ditolak' WHERE user_id='$user_id'");

    header("location: ../../public/admin_validasi.php");
    exit;
}