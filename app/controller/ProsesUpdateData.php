<?php
session_start();
require_once '../../config/koneksi.php';

// Pastikan pengguna sudah login
if (!isset($_SESSION['status']) || $_SESSION['status'] != 'login') {
    header("location: ../../public/login.php");
    exit;
}

$email = $_SESSION['email'];

// 1. Ambil ID User
$queryUser = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");
$user = mysqli_fetch_assoc($queryUser);
$user_id = $user['id'];

// 2. Ambil ID Profil (Alumni ID)
$queryProfil = mysqli_query($conn, "SELECT id FROM alumni_profiles WHERE user_id='$user_id'");
$profil = mysqli_fetch_assoc($queryProfil);

if (!$profil) {
    echo "<script>alert('Gagal: Profil belum ditemukan!'); window.location='../../public/update_data.php';</script>";
    exit;
}

$alumni_id = $profil['id'];

// 3. Tangkap data dari form (Aman dari SQL Injection)
$pekerjaan = mysqli_real_escape_string($conn, $_POST['pekerjaan_baru']);
$perusahaan = mysqli_real_escape_string($conn, $_POST['perusahaan_baru']);
$linkedin = mysqli_real_escape_string($conn, $_POST['linkedin_baru']);
$instagram = mysqli_real_escape_string($conn, $_POST['instagram_baru']);

// 4. Proses Upload File Bukti
$nama_file = $_FILES['bukti_file']['name'];
$ukuran_file = $_FILES['bukti_file']['size'];
$tmp_file = $_FILES['bukti_file']['tmp_name'];
$error_file = $_FILES['bukti_file']['error'];

if ($error_file === 0) {
    $ekstensi_diperbolehkan = ['pdf', 'jpg', 'jpeg', 'png'];
    $x = explode('.', $nama_file);
    $ekstensi = strtolower(end($x));

    if (in_array($ekstensi, $ekstensi_diperbolehkan)) {
        if ($ukuran_file <= 5000000) { // Maks 5MB
            // Buat nama unik agar file tidak tertimpa foto pengguna lain
            $nama_baru = 'bukti_' . $alumni_id . '_' . time() . '.' . $ekstensi;
            $lokasi_simpan = '../uploads/Bukti/' . $nama_baru;

            if (move_uploaded_file($tmp_file, $lokasi_simpan)) {
                // 5. Masukkan data ke antrean tabel update_requests
                $query_insert = "INSERT INTO update_requests 
                                (alumni_id, pekerjaan_baru, perusahaan_baru, linkedin_baru, instagram_baru, bukti_file, status, created_at) 
                                VALUES 
                                ('$alumni_id', '$pekerjaan', '$perusahaan', '$linkedin', '$instagram', '$nama_baru', 'pending', NOW())";

                if (mysqli_query($conn, $query_insert)) {
                    echo "<script>alert('Pengajuan berhasil dikirim! Menunggu validasi admin.'); window.location='../../public/update_data.php';</script>";
                } else {
                    echo "<script>alert('Gagal menyimpan pengajuan ke database.'); window.location='../../public/update_data.php';</script>";
                }
            } else {
                echo "<script>alert('Gagal mengupload file bukti.'); window.location='../../public/update_data.php';</script>";
            }
        } else {
            echo "<script>alert('Ukuran file terlalu besar! Maksimal 5MB.'); window.location='../../public/update_data.php';</script>";
        }
    } else {
        echo "<script>alert('Format file tidak diizinkan! Hanya PDF, JPG, PNG.'); window.location='../../public/update_data.php';</script>";
    }
} else {
    echo "<script>alert('Silakan upload file bukti.'); window.location='../../public/update_data.php';</script>";
}
