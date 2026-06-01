<?php
session_start();
require_once '../../config/koneksi.php';

// Pastikan user datang dari halaman resmi dan membawa session email
if (!isset($_SESSION['reset_email']) || $_SERVER['REQUEST_METHOD'] != 'POST') {
    header("location: ../../public/login.php");
    exit;
}

$email = $_SESSION['reset_email'];
$password_baru = mysqli_real_escape_string($conn, $_POST['password_baru']);

// Eksekusi update password ke tabel users
$query_update = mysqli_query($conn, "UPDATE users SET password='$password_baru' WHERE email='$email'");

if ($query_update) {
    // Bersihkan session reset agar tidak disalahgunakan lagi
    unset($_SESSION['reset_email']);

    // Tampilkan notifikasi sukses menggunakan javascript, lalu oper ke login
    echo "<script>
            alert('Password berhasil diperbarui! Silakan login menggunakan password baru Anda.');
            window.location='../../public/login.php';
          </script>";
    exit;
} else {
    echo "<script>
            alert('Gagal memperbarui password. Terjadi kesalahan server.');
            window.location='../../public/forgot_password.php';
          </script>";
    exit;
}
