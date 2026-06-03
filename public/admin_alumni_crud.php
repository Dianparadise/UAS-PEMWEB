<?php
session_start();
require_once '../config/koneksi.php';

if (!isset($_SESSION['status']) || $_SESSION['role'] !== 'admin') {
    header("location: login.php");
    exit;
}

// 1. Logika Pencarian
$search = "";
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $query = mysqli_query($conn, "SELECT ap.*, u.nama, u.email FROM alumni_profiles ap 
                                  JOIN users u ON ap.user_id = u.id 
                                  WHERE u.nama LIKE '%$search%' 
                                  OR u.email LIKE '%$search%' 
                                  OR ap.pekerjaan LIKE '%$search%' 
                                  OR ap.perusahaan LIKE '%$search%' 
                                  ORDER BY ap.id DESC");
} else {
    $query = mysqli_query($conn, "SELECT ap.*, u.nama, u.email FROM alumni_profiles ap 
                                  JOIN users u ON ap.user_id = u.id ORDER BY ap.id DESC");
}

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
        <a href="admin_validasi.php">Validasi Data (
            <?= $total_notif ?>)
        </a>
        <a href="admin_alumni_crud.php" class="active">Kelola Data Alumni</a>
        <a href="logout.php" class="logout">Logout</a>
    </div>

    <div class="admin-main-content">
        <div class="admin-header">
            <h1>Kelola Data Alumni</h1>
            <p>Admin dapat mengubah informasi profil, akun, dan data pekerjaan alumni di sini.</p>
        </div>

        <form method="GET" action="admin_alumni_crud.php" style="margin-bottom: 20px; display: flex; gap: 10px;">
            <input type="text" name="search" value="<?= htmlspecialchars($search) ?>"
                placeholder="Cari nama, email, pekerjaan..."
                style="padding: 8px 12px; width: 300px; border: 1px solid #ccc; border-radius: 4px;">
            <button type="submit"
                style="padding: 8px 16px; background-color: #2e7d32; color: white; border: none; border-radius: 4px; cursor: pointer;">Cari</button>
            <?php if ($search !== ""): ?><a href="admin_alumni_crud.php"
                    style="padding: 8px 12px; background-color: #757575; color: white; text-decoration: none; border-radius: 4px;">Reset</a>
            <?php endif; ?>
        </form>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Angkatan</th>
                    <th>Pekerjaan</th>
                    <th>Perusahaan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($query) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($query)): ?>
                        <tr>
                            <form action="../app/controller/UpdateAlumniController.php" method="POST">
                                <input type="hidden" name="id_profil" value="<?= $row['id'] ?>">
                                <input type="hidden" name="user_id" value="<?= $row['user_id'] ?>">
                                <td><input type="text" name="nama" value="<?= htmlspecialchars($row['nama']) ?>"
                                        class="admin-input-table"></td>
                                <td><input type="email" name="email" value="<?= htmlspecialchars($row['email']) ?>"
                                        class="admin-input-table"></td>
                                <td><input type="number" name="angkatan" value="<?= $row['angkatan'] ?>"
                                        class="admin-input-table" style="width: 70px;"></td>
                                <td><input type="text" name="pekerjaan" value="<?= htmlspecialchars($row['pekerjaan'] ?? '') ?>"
                                        class="admin-input-table"></td>
                                <td><input type="text" name="perusahaan"
                                        value="<?= htmlspecialchars($row['perusahaan'] ?? '') ?>" class="admin-input-table">
                                </td>
                                <td>
                                    <button type="submit" class="admin-btn admin-btn-edit">Simpan</button>
                            </form>
                            <form action="../app/controller/DeleteAlumniController.php" method="POST" style="display:inline;">
                                <input type="hidden" name="id_profil" value="<?= $row['id'] ?>">
                                <input type="hidden" name="user_id" value="<?= $row['user_id'] ?>">
                                <button type="submit" class="admin-btn admin-btn-delete"
                                    onclick="return confirm('Yakin hapus permanen?')">Hapus</button>
                            </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 20px;">Data tidak ditemukan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>