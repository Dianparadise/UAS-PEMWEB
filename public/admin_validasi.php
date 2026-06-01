<?php
session_start();
require_once '../config/koneksi.php';

if (!isset($_SESSION['status']) || $_SESSION['role'] !== 'admin') {
    header("location: login.php");
    exit;
}

$query = mysqli_query($conn, "SELECT ur.*, u.nama FROM update_requests ur 
                              JOIN alumni_profiles ap ON ur.alumni_id = ap.id 
                              JOIN users u ON ap.user_id = u.id 
                              WHERE ur.status='pending' ORDER BY ur.created_at DESC");
$count_pending = mysqli_num_rows($query);
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
        <a href="admin_dashboard.php">💻 Dashboard</a>
        <a href="admin_validasi.php" class="active">📥 Validasi Data (
            <?= $count_pending ?>)
        </a>
        <a href="admin_alumni_crud.php">👥 Kelola Data Alumni</a>
        <a href="logout.php" class="logout">🚪 Logout</a>
    </div>

    <div class="admin-main-content">
        <div class="admin-header">
            <h1>📥 Validasi Perubahan Data Alumni</h1>
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
                <?php if ($count_pending == 0): ?>
                    <tr>
                        <td colspan="5" class="no-data">Tidak ada pengajuan perubahan data yang pending saat ini.</td>
                    </tr>
                <?php endif; ?>
                <?php while ($row = mysqli_fetch_assoc($query)): ?>
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
                                target="_blank">📄 Lihat Bukti</a>
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
    </div>

</body>

</html>