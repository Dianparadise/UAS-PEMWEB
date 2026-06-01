<?php
session_start();
require_once '../config/koneksi.php';

if (!isset($_SESSION['status']) || $_SESSION['role'] !== 'admin') {
    header("location: login.php");
    exit;
}

$count_alumni = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM users WHERE role='alumni'"))['total'];
$count_mhs = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM users WHERE role='mahasiswa'"))['total'];
$count_pending = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM update_requests WHERE status='pending'"))['total'];
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
        <a href="admin_dashboard.php" class="active">💻 Dashboard</a>
        <a href="admin_validasi.php">📥 Validasi Data (
            <?= $count_pending ?>)
        </a>
        <a href="admin_alumni_crud.php">👥 Kelola Data Alumni</a>
        <a href="logout.php" class="logout">🚪 Logout</a>
    </div>

    <div class="admin-main-content">
        <div class="admin-header">
            <h1>Selamat Datang, Admin! 👋</h1>
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
                <h3>Total Mahasiswa</h3>
                <p>
                    <?= $count_mhs ?> Orang
                </p>
            </div>
            <div class="admin-card <?= $count_pending > 0 ? 'warning' : '' ?>">
                <h3>Menunggu Validasi</h3>
                <p>
                    <?= $count_pending ?> Pengajuan
                </p>
            </div>
        </div>
    </div>

</body>

</html>