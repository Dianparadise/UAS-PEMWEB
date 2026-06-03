<?php
require_once '../../config/koneksi.php';

$user_id = $_POST['user_id'];
$id_profil = $_POST['id_profil'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$angkatan = $_POST['angkatan'];
$pekerjaan = $_POST['pekerjaan'];
$perusahaan = $_POST['perusahaan'];

// Update ke tabel users
mysqli_query($conn, "UPDATE users SET nama='$nama', email='$email' WHERE id='$user_id'");

// Update ke tabel alumni_profiles
mysqli_query($conn, "UPDATE alumni_profiles SET angkatan='$angkatan', pekerjaan='$pekerjaan', perusahaan='$perusahaan' WHERE id='$id_profil'");

header("location: ../../public/admin_alumni_crud.php");
?>