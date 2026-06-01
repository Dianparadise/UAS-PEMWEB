<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Panggil koneksi dan controller
require_once '../config/koneksi.php';
require_once '../app/controller/HomeController.php';

// Pastikan model yang memuat class AlumniHomeModel ikut terpanggil.
// (Jika file modelmu di-require di dalam HomeController, kamu bisa melewati baris ini)
require_once '../app/model/AlumniModel.php';

// 1. Tangkap parameter ID dari URL
$user_id = isset($_GET['id']) ? $_GET['id'] : null;

// Jika tidak ada ID, kembalikan ke halaman utama
if (!$user_id) {
    header("Location: index.php");
    exit;
}

// 2. Ambil data menggunakan Controller
$controller = new HomeController();
$alumniDetail = $controller->detail($user_id);

// Jika data tidak ada di database
if (!$alumniDetail) {
    echo "<h2 style='text-align:center; margin-top:50px;'>Data alumni tidak ditemukan.</h2>";
    echo "<div style='text-align:center;'><a href='index.php'>Kembali ke Beranda</a></div>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail - <?= htmlspecialchars($alumniDetail['nama']); ?></title>
    <link rel="stylesheet" href="../asset/css/style.css">
    <style>
        /* CSS tambahan khusus untuk halaman detail agar rapi */
        .detail-wrapper {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            margin-top: 40px;
            display: flex;
            gap: 40px;
        }

        .detail-foto img {
            width: 100%;
            max-width: 300px;
            border-radius: 8px;
            object-fit: cover;
        }

        .detail-info h2 {
            margin-top: 0;
            color: #2c5e38;
            /* Warna hijau khas UI kamu */
            font-size: 28px;
        }

        .detail-info p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 12px;
            color: #555;
        }

        .btn-kembali {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #2c5e38;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .btn-kembali:hover {
            background-color: #1f4227;
        }
    </style>
</head>

<body>

    <header class="main-header">
        <div class="container header-content">
            <div class="logo">
                <img src="../asset/img/logo.png" alt="Logo" class="logo-img">
                <span class="logo-text">alumniipbpedia</span>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="index.php">BERANDA</a></li>
                    <li><a href="#">UPDATE DATA</a></li>
                    <?php if (isset($_SESSION['status']) && $_SESSION['status'] == 'login'): ?>
                        <li><a href="profil.php">PROFIL (<?= $_SESSION['nama']; ?>)</a></li>
                        <li><a href="logout.php" style="color: #ff4d4d; font-weight: bold;">LOGOUT</a></li>
                    <?php else: ?>
                        <li><a href="login.php">LOGIN</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container">
        <div class="detail-wrapper">
            <div class="detail-foto">
                <img src="../<?= htmlspecialchars($alumniDetail['foto'] ?? 'asset/img/default-avatar.png'); ?>" alt="<?= htmlspecialchars($alumniDetail['nama']); ?>">
            </div>

            <div class="detail-info">
                <h2><?= htmlspecialchars($alumniDetail['nama']); ?></h2>

                <p class="alumni-bio">
                    "<?= htmlspecialchars($alumniDetail['bio'] ?? 'Belum menuliskan deskripsi profil.'); ?>"
                </p>

                <hr style="border: 1px solid #eee; margin-bottom: 20px;">

                <p><strong>Angkatan :</strong> <?= htmlspecialchars($alumniDetail['angkatan'] ?? '-'); ?></p>
                <p><strong>Tahun Kelulusan :</strong> <?= htmlspecialchars($alumniDetail['tahun_kelulusan'] ?? '-'); ?></p>
                <p><strong>Pekerjaan Saat Ini :</strong> <?= htmlspecialchars($alumniDetail['pekerjaan'] ?? '-'); ?></p>
                <p><strong>Perusahaan / Instansi :</strong> <?= htmlspecialchars($alumniDetail['perusahaan'] ?? '-'); ?></p>

                <p><strong>Email Resmi :</strong> <?= htmlspecialchars($alumniDetail['email'] ?? '-'); ?></p>

                <?php if (!empty($alumniDetail['linkedin'])): ?>
                    <p><strong>LinkedIn :</strong> <?= htmlspecialchars($alumniDetail['linkedin']); ?></p>
                <?php endif; ?>

                <?php if (!empty($alumniDetail['instagram'])): ?>
                    <p><strong>Instagram :</strong> <?= htmlspecialchars($alumniDetail['instagram']); ?></p>
                <?php endif; ?>

                <a href="index.php" class="btn-kembali">&larr; Kembali ke Beranda</a>
            </div>
    </main>

</body>

</html>