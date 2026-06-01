<?php
session_start();
require_once '../../config/koneksi.php';

if (!isset($_SESSION['status']) || $_SESSION['role'] !== 'admin') {
    header("location: ../../public/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_profil = $_POST['id_profil'];
    $angkatan = mysqli_real_escape_string($conn, $_POST['angkatan']);

    mysqli_query($conn, "UPDATE alumni_profiles SET angkatan='$angkatan' WHERE id='$id_profil'");

    header("location: ../../public/admin_alumni_crud.php");
    exit;
}