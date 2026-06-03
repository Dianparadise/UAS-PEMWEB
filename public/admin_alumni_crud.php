<?php
session_start();
require_once '../config/koneksi.php';

if (!isset($_SESSION['status']) || $_SESSION['role'] !== 'admin') {
    header("location: login.php");
    exit;
}

// Query ambil data utama alumni
$query = mysqli_query($conn, "SELECT ap.*, u.nama, u.email FROM alumni_profiles ap 
                              JOIN users u ON ap.user_id = u.id ORDER BY ap.id DESC");

// Hitung ulang komponen pending gabungan agar angka sidebar tidak berubah-ubah
$count_pending_kerja = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM update_requests WHERE status='pending'"))['total'];
$count_pending_lulus = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM alumni_profiles WHERE status_kelulusan='pending'"))['total'];
$total_notif = $count_pending_kerja + $count_pending_lulus;
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kelola Data Alumni - Admin</title>
    <link rel="stylesheet" href="../asset/css/style.css">
</head>

<body class="admin-body">

    <div class="admin-sidebar">
        <h2>Panel Admin</h2>
        <a href="admin_dashboard.php">Dashboard</a>
        <a href="admin_validasi.php">Validasi Data (<?= $total_notif ?>)</a>
        <a href="admin_alumni_crud.php" class="active">Kelola Data Alumni</a>
        <a href="logout.php" class="logout">Logout</a>
    </div>

    <div class="admin-main-content">
        <div class="admin-header">
            <h1>Data Kelola Alumni</h1>
            <p>Manajemen penuh modifikasi, pembaruan angkatan, dan penghapusan data akun alumni.</p>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Angkatan</th>
                    <th>Pekerjaan Saat Ini</th>
                    <th>Perusahaan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($query)): ?>
                    <tr>
                        <td><strong><?= $row['nama'] ?></strong></td>
                        <td><?= $row['email'] ?></td>

                        <form action="../app/controller/UpdateAlumniController.php" method="POST" class="admin-inline-form">
                            <td>
                                <input type="number" name="angkatan" value="<?= $row['angkatan'] ?>"
                                    class="admin-input-table">
                            </td>
                            <td><?= $row['pekerjaan'] ? $row['pekerjaan'] : '-' ?></td>
                            <td><?= $row['perusahaan'] ? $row['perusahaan'] : '-' ?></td>
                            <td>
                                <input type="hidden" name="id_profil" value="<?= $row['id'] ?>">
                                <button type="submit" class="admin-btn admin-btn-edit">Simpan</button>
                        </form>

                        <form action="../app/controller/DeleteAlumniController.php" method="POST" class="admin-inline-form">
                            <input type="hidden" name="id_profil" value="<?= $row['id'] ?>">
                            <input type="hidden" name="user_id" value="<?= $row['user_id'] ?>">
                            <button type="submit" class="admin-btn admin-btn-delete"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus akun alumni ini permanen?')">
                                Hapus</button>
                        </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</body>

</html>