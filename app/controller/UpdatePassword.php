<?php
session_start();
require_once '../../config/koneksi.php';

if (!isset($_SESSION['status']) || $_SESSION['status'] != 'login') {
    header("location: ../../public/login.php");
    exit;
}

$email = $_SESSION['email'];
$pass_lama = $_POST['pass_lama'];
$pass_baru = $_POST['pass_baru'];

// Cari user berdasarkan email
$query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
$user = mysqli_fetch_assoc($query);

// Cek apakah password lama yang dimasukkan cocok dengan di database
// Catatan: Sesuaikan ini jika kamu menggunakan enkripsi md5() atau password_hash() saat register
if ($user['password'] == $pass_lama) {
    // Jika cocok, update ke password baru
    $update = mysqli_query($conn, "UPDATE users SET password='$pass_baru' WHERE email='$email'");

    if ($update) {
        echo "<script>alert('Password berhasil diubah!'); window.location='../../public/profil.php';</script>";
    } else {
        echo "<script>alert('Gagal merubah password.'); window.location='../../public/profil.php';</script>";
    }
} else {
    // Jika password lama salah
    echo "<script>alert('Password lama yang Anda masukkan SALAH!'); window.location='../../public/profil.php';</script>";
}
