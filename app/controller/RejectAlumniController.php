<?php
session_start();
require_once '../../config/koneksi.php';

if (!isset($_SESSION['status']) || $_SESSION['role'] !== 'admin') {
    header("location: ../../public/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_request = $_POST['id_request'];

    mysqli_query($conn, "UPDATE update_requests SET status='rejected', admin_notes='Pengajuan ditolak karena bukti berkas tidak valid' WHERE id='$id_request'");

    header("location: ../../public/admin_validasi.php");
    exit;
}