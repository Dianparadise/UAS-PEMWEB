<?php
session_start();
require_once '../config/koneksi.php';

if (!isset($_SESSION['status'])) {
    header("location: login.php");
    exit;
}

// Gunakan email yang ada di session untuk mencari data user
$email_session = $_SESSION['email'];

// Query mengambil data berdasarkan email dari session
$query = mysqli_query($conn, "SELECT id, nama, email FROM users WHERE email='$email_session'");
$user = mysqli_fetch_assoc($query);

// Tambahan: Pastikan $user tidak null/kosong
if (!$user) {
    echo "Data user tidak ditemukan!";
    exit;
}

// Sekarang $user['id'] akan berisi ID yang benar
$_SESSION['user_id'] = $user['id'];
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Profil - SIJA</title>
    <link rel="stylesheet" href="../asset/css/style.css">
</head>

<body>
    <div class="container"
        style="max-width: 600px; margin: 50px auto; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <h2>Edit Nama & Email</h2>
        <form action="../app/controller/UpdateProfilController.php" method="POST">
            <div style="margin-bottom: 15px;">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" value="<?= htmlspecialchars($user['nama']) ?>" required
                    style="width: 100%; padding: 10px;">
            </div>
            <div style="margin-bottom: 15px;">
                <label>Email Resmi</label>
                <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required
                    style="width: 100%; padding: 10px;">
            </div>
            <a href="profil.php" style="color: #757575;">Batal</a>
            <button type="submit" name="update_profil"
                style="padding: 10px 20px; background: #2e7d32; color: white; border: none; border-radius: 4px; float: right;">Simpan
                Perubahan</button>
        </form>
    </div>
</body>

</html>