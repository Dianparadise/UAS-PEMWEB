<?php
// Mulai sesi untuk mengenali user yang sedang login
session_start();

// Hapus semua data sesi (nama, email, dll)
session_unset();
session_destroy();

// Tendang balik ke halaman beranda setelah berhasil keluar
header("location: index.php");
?>