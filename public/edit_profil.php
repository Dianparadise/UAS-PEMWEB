<?php
session_start();
require_once '../config/koneksi.php';

if (!isset($_SESSION['status'])) {
    header("location: login.php");
    exit;
}

$email_session = $_SESSION['email'];

// 1. Ambil data nama & email dari tabel users
$query_user = mysqli_query($conn, "SELECT id, nama, email FROM users WHERE email='$email_session'");
$user = mysqli_fetch_assoc($query_user);

if (!$user) {
    echo "Data user tidak ditemukan!";
    exit;
}

$user_id = $user['id'];
$_SESSION['user_id'] = $user_id;

// 2. Ambil data bio dari tabel alumni_profiles (Diubah menjadi 'bio' sesuai databasemu)
$query_profil = mysqli_query($conn, "SELECT bio FROM alumni_profiles WHERE user_id='$user_id'");
$profil = mysqli_fetch_assoc($query_profil);
$bio = $profil['bio'] ?? '';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - SIJA</title>
    <!-- Memanggil file style.css -->
    <link rel="stylesheet" href="../asset/css/style.css">
</head>

<body class="edit-profile-body">
    <div class="edit-profile-box">
        <h2>Edit Profil</h2>

        <form action="../app/controller/UpdateProfilController.php" method="POST">

            <div class="edit-form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" class="edit-form-input" value="<?= htmlspecialchars($user['nama']) ?>"
                    required>
            </div>

            <div class="edit-form-group">
                <label>Email Resmi</label>
                <input type="email" name="email" class="edit-form-input" value="<?= htmlspecialchars($user['email']) ?>"
                    required>
            </div>

            <!-- Input Textarea untuk Bio Singkat (name diubah jadi 'bio') -->
            <div class="edit-form-group">
                <label>Bio Singkat</label>
                <textarea name="bio" class="edit-form-textarea"
                    placeholder="Tuliskan sedikit tentang diri Anda..."><?= htmlspecialchars($bio) ?></textarea>
            </div>

            <div class="edit-form-actions">
                <a href="profil.php" class="btn-batal">Batal</a>
                <button type="submit" name="update_profil" class="btn-simpan-profil">Simpan Perubahan</button>
            </div>

        </form>
    </div>
</body>

</html>