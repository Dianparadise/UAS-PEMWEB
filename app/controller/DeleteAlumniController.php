<?php
session_start();
require_once '../../config/koneksi.php';

if (!isset($_SESSION['status']) || $_SESSION['role'] !== 'admin') {
    header("location: ../../public/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_profil = $_POST['id_profil'];
    $user_id = $_POST['user_id'];

    mysqli_query($conn, "DELETE FROM update_requests WHERE alumni_id='$id_profil'");
    mysqli_query($conn, "DELETE FROM alumni_profiles WHERE id='$id_profil'");
    mysqli_query($conn, "DELETE FROM users WHERE id='$user_id'");

    header("location: ../../public/admin_alumni_crud.php");
    exit;
}