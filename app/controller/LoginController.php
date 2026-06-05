<?php
// 1. Panggil perlengkapan yang dibutuhkan
require_once '../../config/koneksi.php';
require_once 'AuthController.php';

// 2. Bangun (instansiasi) objek Controller-nya
$auth = new AuthController($conn);

// 3. Tangkap data dari form public/login.php
$username = $_POST['username'];
$password = md5($_POST['password']);

// 4. Suruh Controller menjalankan fungsi login()
$cek_login = $auth->login($username, $password);

// ==========================================================================
// 5. ATUR ARAH HALAMAN BERDASARKAN ROLE USER (SUDAH DIPERBAIKI)
// ==========================================================================
if ($cek_login == true) {
    // Cek role yang sudah disimpan oleh AuthController ke dalam SESSION
    if ($_SESSION['role'] === 'admin') {
        // Jika dia admin, lempar ke Panel Dashboard Admin
        header("location:../../public/admin_dashboard.php");
    } else {
        // Jika dia alumni/mahasiswa, lempar ke Beranda Utama
        header("location:../../public/index.php");
    }
    exit; // Menghentikan script agar proses redirect berjalan sempurna
} else {
    // Jika false, kembalikan ke form dengan peringatan
    header("location:../../public/login.php?pesan=gagal");
    exit;
}
?>