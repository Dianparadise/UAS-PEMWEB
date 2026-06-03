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

// 2. Proses Upload Berkas Bukti Kelulusan (Ijazah / SKL)
$bukti_kelulusan = "";
if (isset($_FILES['bukti_kelulusan']) && $_FILES['bukti_kelulusan']['error'] == 0) {
    $target_dir = "../../uploads/";

    // Buat folder uploads jika belum ada
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $filename = time() . "_" . basename($_FILES["bukti_kelulusan"]["name"]);
    $target_file = $target_dir . $filename;

    if (move_uploaded_file($_FILES["bukti_kelulusan"]["tmp_name"], $target_file)) {
        $bukti_kelulusan = $filename;
    }
}

// 3. JANGAN UBAH ROLE MENJADI ALUMNI DULU!
// Kita simpan tahun kelulusan, berkas ijazah, dan set status_kelulusan menjadi 'pending'
$query_update = "UPDATE alumni_profiles SET 
                 tahun_kelulusan='$tahun_kelulusan', 
                 angkatan='$tahun_kelulusan', 
                 status_kelulusan='pending'";

// Jika ada file yang diunggah, masukkan ke query
if (!empty($bukti_kelulusan)) {
    $query_update .= ", bukti_kelulusan='$bukti_kelulusan'";
}

$query_update .= " WHERE user_id='$user_id'";
mysqli_query($conn, $query_update);

echo "<script>alert('Pengajuan kelulusan Anda berhasil dikirim! Silakan tunggu validasi dan persetujuan dari Admin.'); window.location='../../public/profil.php';</script>";
?>