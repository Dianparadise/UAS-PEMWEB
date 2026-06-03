<?php
session_start();
require_once '../config/koneksi.php';

if (!isset($_SESSION['status']) || $_SESSION['role'] !== 'admin') {
    header("location: login.php");
    exit;
}

// 1. Ambil data pengajuan Perubahan Kerja/Karir Alumni yang pending
$query_kerja = mysqli_query($conn, "SELECT ur.*, u.nama FROM update_requests ur 
                                    JOIN alumni_profiles ap ON ur.alumni_id = ap.id 
                                    JOIN users u ON ap.user_id = u.id 
                                    WHERE ur.status='pending' ORDER BY ur.created_at DESC");
$count_pending_kerja = mysqli_num_rows($query_kerja);

// 2. Ambil data Klaim Kelulusan Mahasiswa Baru yang pending
$query_kelulusan = mysqli_query($conn, "SELECT ap.*, u.nama, u.email FROM alumni_profiles ap 
                                        JOIN users u ON ap.user_id = u.id 
                                        WHERE ap.status_kelulusan='pending' ORDER BY ap.id DESC");
$count_pending_lulus = mysqli_num_rows($query_kelulusan);

// Gabungkan total notifikasi untuk ditaruh di sidebar admin
$total_notif = $count_pending_kerja + $count_pending_lulus;
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Validasi Pengajuan - Admin</title>
    <link rel="stylesheet" href="../asset/css/style.css">
</head>

<body class="admin-body">

    <div class="admin-sidebar">
        <h2>Panel Admin</h2>
        <a href="admin_dashboard.php">Dashboard</a>
        <a href="admin_validasi.php" class="active">Validasi Data (
            <?= $total_notif ?>)
        </a>
        <a href="admin_alumni_crud.php">Kelola Data Alumni</a>
        <a href="logout.php" class="logout">Logout</a>
    </div>

    <div class="admin-main-content">

        <div class="admin-header">
            <h1>Validasi Perubahan Data Alumni</h1>
            <p>Daftar alumni yang mengajukan pembaharuan data pekerjaan/karier.</p>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nama Alumni</th>
                    <th>Pekerjaan Baru</th>
                    <th>Perusahaan Baru</th>
                    <th>Berkas Bukti</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($count_pending_kerja == 0): ?>
                    <tr>
                        <td colspan="5" class="no-data">Tidak ada pengajuan perubahan data pekerjaan yang pending saat ini.
                        </td>
                    </tr>
                <?php endif; ?>
                <?php while ($row = mysqli_fetch_assoc($query_kerja)): ?>
                    <tr>
                        <td><strong>
                                <?= $row['nama'] ?>
                            </strong></td>
                        <td>
                            <?= $row['pekerjaan_baru'] ?>
                        </td>
                        <td>
                            <?= $row['perusahaan_baru'] ?>
                        </td>
                        <td>
                            <a href="download.php?file=<?= $row['bukti_file'] ?>" class="admin-btn admin-btn-file"
                                target="_blank">Lihat Bukti</a>
                        </td>
                        <td>
                            <form action="../app/controller/ApproveAlumniController.php" method="POST"
                                class="admin-inline-form">
                                <input type="hidden" name="id_request" value="<?= $row['id'] ?>">
                                <input type="hidden" name="alumni_id" value="<?= $row['alumni_id'] ?>">
                                <button type="submit" class="admin-btn admin-btn-approve">Setujui</button>
                            </form>

                            <form action="../app/controller/RejectAlumniController.php" method="POST"
                                class="admin-inline-form">
                                <input type="hidden" name="id_request" value="<?= $row['id'] ?>">
                                <button type="submit" class="admin-btn admin-btn-reject">Tolak</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>


        <div class="admin-header" style="margin-top: 50px;">
            <h1>Validasi Kelulusan Mahasiswa Baru</h1>
            <p>Daftar mahasiswa aktif yang mengajukan klaim kelulusan menjadi alumni baru.</p>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nama Mahasiswa</th>
                    <th>Email</th>
                    <th>Tahun Lulus</th>
                    <th>Berkas Ijazah/SKL</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($count_pending_lulus == 0): ?>
                    <tr>
                        <td colspan="5" class="no-data">Tidak ada berkas kelulusan mahasiswa baru yang pending saat ini.
                        </td>
                    </tr>
                <?php endif; ?>
                <?php while ($row_k = mysqli_fetch_assoc($query_kelulusan)): ?>
                    <tr>
                        <td><strong>
                                <?= $row_k['nama'] ?>
                            </strong></td>
                        <td>
                            <?= $row_k['email'] ?>
                        </td>
                        <td>
                            <?= $row_k['tahun_kelulusan'] ?>
                        </td>
                        <td>
                            <?php if (!empty($row_k['bukti_kelulusan'])): ?>
                                <a href="../uploads/<?= $row_k['bukti_kelulusan'] ?>" class="admin-btn admin-btn-file"
                                    target="_blank">Lihat Ijazah</a>
                            <?php else: ?>
                                <span style="color: red; font-style: italic;">Tidak ada berkas</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <form action="../app/controller/ApproveGraduationController.php" method="POST"
                                class="admin-inline-form">
                                <input type="hidden" name="user_id" value="<?= $row_k['user_id'] ?>">
                                <button type="submit" class="admin-btn admin-btn-approve">Setujui</button>
                            </form>

                            <form action="../app/controller/RejectGraduationController.php" method="POST"
                                class="admin-inline-form">
                                <input type="hidden" name="user_id" value="<?= $row_k['user_id'] ?>">
                                <button type="submit" class="admin-btn admin-btn-reject">Tolak</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

    </div>

</body>

</html>