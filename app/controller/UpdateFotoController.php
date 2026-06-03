<?php
session_start();
require_once '../../config/koneksi.php';

// 1. Pastikan pengguna sudah masuk (login)
if (!isset($_SESSION['status']) || $_SESSION['status'] != 'login') {
    header("location: ../../public/login.php");
    exit;
}

$email = $_SESSION['email'];

// 2. Ambil ID Profil dari pengguna yang sedang masuk
$queryUser = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");
$user = mysqli_fetch_assoc($queryUser);
$user_id = $user['id'];

$queryProfil = mysqli_query($conn, "SELECT id FROM alumni_profiles WHERE user_id='$user_id'");
$profil = mysqli_fetch_assoc($queryProfil);

if (!$profil) {
    echo "<script>alert('Gagal: Anda belum memiliki biodata alumni!'); window.location='../../public/profil.php';</script>";
    exit;
}
$alumni_id = $profil['id'];

// 3. Proses Pengunggahan Berkas Foto
if (isset($_FILES['foto_profil']) && $_FILES['foto_profil']['error'] == 0) {
    $nama_berkas = $_FILES['foto_profil']['name'];
    $ukuran_berkas = $_FILES['foto_profil']['size'];
    $lokasi_sementara = $_FILES['foto_profil']['tmp_name'];

    // Periksa jenis berkas (Hanya izinkan JPG, JPEG, PNG)
    $jenis_diizinkan = ['jpg', 'jpeg', 'png'];
    $jenis_berkas = explode('.', $nama_berkas);
    $jenis_berkas = strtolower(end($jenis_berkas));

    if (!in_array($jenis_berkas, $jenis_diizinkan)) {
        echo "<script>alert('Gagal: Format foto harus JPG atau PNG.'); window.location='../../public/profil.php';</script>";
        exit;
    }

    // Periksa ukuran berkas (Maksimal 2MB)
    if ($ukuran_berkas > 2000000) {
        echo "<script>alert('Gagal: Ukuran foto terlalu besar! Maksimal 2MB.'); window.location='../../public/profil.php';</script>";
        exit;
    }

    // Buat nama berkas acak agar tidak tertukar dengan foto orang lain
    $nama_baru = 'profil_' . $alumni_id . '_' . uniqid() . '.' . $jenis_berkas;

    // === JALUR PENYIMPANAN BARU (MASUK KE FOLDER Profil) ===
    $tujuan_simpan = '../../uploads/Profil/' . $nama_baru;

    // Alamat yang akan disimpan ke dalam basis data
    $alamat_basis_data = 'uploads/Profil/' . $nama_baru;

    // Pindahkan berkas dan perbarui basis data
    if (move_uploaded_file($lokasi_sementara, $tujuan_simpan)) {
        $perintah_ubah = "UPDATE alumni_profiles SET foto='$alamat_basis_data' WHERE id='$alumni_id'";

        if (mysqli_query($conn, $perintah_ubah)) {
            echo "<script>alert('Sukses! Foto profil Anda berhasil diperbarui.'); window.location='../../public/profil.php';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat menyimpan ke basis data.'); window.location='../../public/profil.php';</script>";
        }
    } else {
        echo "<script>alert('Gagal mengunggah berkas foto ke peladen (server).'); window.location='../../public/profil.php';</script>";
    }
} else {
    echo "<script>alert('Silakan pilih berkas foto terlebih dahulu.'); window.location='../../public/profil.php';</script>";
}
