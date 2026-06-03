<?php
session_start();
require_once '../../config/koneksi.php';

// Pastikan pengguna sudah login
if (!isset($_SESSION['status']) || $_SESSION['status'] != 'login') {
    header("location: ../../public/login.php");
    exit;
}

$email = $_SESSION['email'];
$tahun_kelulusan = mysqli_real_escape_string($conn, $_POST['tahun_kelulusan']);

// 1. Ambil ID User
$queryUser = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");
$user = mysqli_fetch_assoc($queryUser);
$user_id = $user['id'];

// 2. Ubah role di tabel users dari 'mahasiswa' menjadi 'alumni'
mysqli_query($conn, "UPDATE users SET role='alumni' WHERE id='$user_id'");

// 3. Update tahun kelulusan di tabel alumni_profiles
mysqli_query($conn, "UPDATE alumni_profiles SET tahun_kelulusan='$tahun_kelulusan' WHERE user_id='$user_id'");

// 4. Perbarui data sesi (session) agar navigasi dan hak akses langsung berubah tanpa perlu login ulang
$_SESSION['role'] = 'alumni';

echo "<script>alert('Selamat! Status Anda berhasil diperbarui menjadi Alumni.'); window.location='../../public/profil.php';</script>";
