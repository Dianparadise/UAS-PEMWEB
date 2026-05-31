<?php
// 1. Panggil perlengkapan yang dibutuhkan
// KELUAR DUA LANGKAH: dari controller -> app -> folder utama -> config
require_once '../../config/koneksi.php';
require_once 'AuthController.php';

// 2. Bangun (instansiasi) objek Controller-nya
$auth = new AuthController($conn);

// 3. Tangkap data dari form public/login.php
$username = $_POST['username'];
$password = $_POST['password'];

// 4. Suruh Controller menjalankan fungsi login()
$cek_login = $auth->login($username, $password);

// 5. Atur arah halaman berdasarkan jawaban dari Controller
if ($cek_login == true) {
    // Jika true, lempar ke Beranda
    header("location:../../public/index.php");
} else {
    // Jika false, kembalikan ke form dengan peringatan
    header("location:../../public/login.php?pesan=gagal");
}
?>