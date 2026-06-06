<?php
session_start();
require_once '../../config/koneksi.php';

if (!isset($_SESSION['reset_email']) || $_SERVER['REQUEST_METHOD'] != 'POST') {
    header("location: ../../public/login.php");
    exit;
}

$email = $_SESSION['reset_email'];


$password_baru = md5($_POST['password_baru']);

// Ambil password lama dari database
$query = mysqli_query($conn, "SELECT password FROM users WHERE email='$email'");
$user = mysqli_fetch_assoc($query);

// 2. BANDINGKAN
if ($password_baru == $user['password']) {
    echo "<script>
            alert('Password baru tidak boleh sama dengan password sebelumnya!');
            window.location='../../public/reset_password.php';
          </script>";
    exit;
}

// 3. EKSEKUSI UPDATE
$query_update = mysqli_query($conn, "UPDATE users SET password='$password_baru' WHERE email='$email'");

if ($query_update) {
    // Bersihkan session reset agar tidak disalahgunakan lagi
    unset($_SESSION['reset_email']);

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
?>