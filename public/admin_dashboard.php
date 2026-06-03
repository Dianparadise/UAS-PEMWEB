<?php
session_start();
require_once '../config/koneksi.php';

if (!isset($_SESSION['status']) || $_SESSION['role'] !== 'admin') {
    header("location: login.php");
    exit;
}

// Hitung total user berdasarkan role
$count_alumni = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM users WHERE role='alumni'"))['total'];
$count_mhs = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM users WHERE role='mahasiswa'"))['total'];

// 1. Hitung pengajuan data pekerjaan alumni yang pending
$count_pending_kerja = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM update_requests WHERE status='pending'"))['total'];

// 2. Hitung pengajuan klaim kelulusan mahasiswa baru yang pending
$count_pending_lulus = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM alumni_profiles WHERE status_kelulusan='pending'"))['total'];

// Akumulasi total notifikasi untuk ditaruh di sidebar
$total_notif = $count_pending_kerja + $count_pending_lulus;
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Sistem Alumni</title>
    <link rel="stylesheet" href="../asset/css/style.css">
</head>

<body class="admin-body">

    <div class="admin-sidebar">
        <h2>Panel Admin</h2>
        <a href="admin_dashboard.php" class="active">Dashboard</a>
        <a href="admin_validasi.php">Validasi Data (
            <?= $total_notif ?>)
        </a>
        <a href="admin_alumni_crud.php">Kelola Data Alumni</a>
        <a href="logout.php" class="logout">Logout</a>
    </div>

    <div class="admin-main-content">
        <div class="admin-header">
            <h1>Selamat Datang, Admin!</h1>
            <p>Berikut adalah ringkasan aktivitas sistem data alumni hari ini.</p>
        </div>

        <div class="admin-stats-grid">
            <div class="admin-card">
                <h3>Total Alumni Terdaftar</h3>
                <p>
                    <?= $count_alumni ?> Orang
                </p>
            </div>

            <div class="admin-card">
                <h3>Total Mahasiswa Aktif</h3>
                <p>
                    <?= $count_mhs ?> Orang
                </p>
            </div>

            <div class="admin-card <?= $total_notif > 0 ? 'warning' : '' ?>">
                <h3>Total Validasi Tertunda</h3>
                <p>
                    <?= $total_notif ?> Pengajuan
                </p>
                <small style="color: #666; display: block; margin-top: 5px; font-size: 0.8rem;">
                    (<img src="../uploads/Asset/work.png" class="admin-mini-icon" alt="Karir">
                    <?= $count_pending_kerja ?> Pekerjaan <img src="../uploads/Asset/graduation.png"
                        class="admin-mini-icon" alt="Kelulusan"> <?= $count_pending_lulus ?> Kelulusan Mhs)
                </small>
            </div>
        </div>
    </div>

</body>

</html>