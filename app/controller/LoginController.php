<?php
require_once '../../config/koneksi.php';
require_once 'AuthController.php';

$auth = new AuthController($conn);


$username = $_POST['username'];
$password = md5($_POST['password']);

$cek_login = $auth->login($username, $password);


if ($cek_login == true) {
    // Cek role 
    if ($_SESSION['role'] === 'admin') {

        header("location:../../public/admin_dashboard.php");
    } else {
    
        header("location:../../public/index.php");
    }
    exit; 
} else {
  
    header("location:../../public/login.php?pesan=gagal");
    exit;
}
?>