<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);


require_once '../config/koneksi.php';
require_once '../app/controller/HomeController.php';


require_once '../app/model/AlumniModel.php';


$user_id = isset($_GET['id']) ? $_GET['id'] : null;


if (!$user_id) {
    header("Location: index.php");
    exit;
}


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

</head>

<body>

    <header class="main-header">
        <div class="container header-content">
            <div class="logo">
                <img src="../uploads/logo1.png" alt="Logo Dashboard" class="logo-img"
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



                <hr style="border: 1px solid #eee; margin-bottom: 20px;">

                <p></p><strong>Fakultas :</strong> <?= htmlspecialchars($alumniDetail['fakultas'] ?? '-'); ?></p>
                <p><strong>Jurusan :</strong> <?= htmlspecialchars($alumniDetail['jurusan'] ?? '-'); ?></p>
                <p><strong>Angkatan :</strong> <?= htmlspecialchars($alumniDetail['angkatan'] ?? '-'); ?></p>
                <p><strong>Tahun Kelulusan :</strong> <?= htmlspecialchars($alumniDetail['tahun_kelulusan'] ?? '-'); ?></p>
                <p><strong>Pekerjaan Saat Ini :</strong> <?= htmlspecialchars($alumniDetail['pekerjaan'] ?? '-'); ?></p>
                <p><strong>Perusahaan / Instansi :</strong> <?= htmlspecialchars($alumniDetail['perusahaan'] ?? '-'); ?></p>

                <p><strong>Email Resmi :</strong> <?= htmlspecialchars($alumniDetail['email'] ?? '-'); ?></p>

                <?php if (!empty($alumniDetail['linkedin'])): ?>
                    <p><strong>LinkedIn :</strong>
                        <a href="<?= htmlspecialchars($alumniDetail['linkedin']); ?>" target="_blank" style="color: #2c5e38; text-decoration: none; font-weight: 500;">
                            <?= htmlspecialchars($alumniDetail['linkedin']); ?>
                        </a>
                    </p>
                <?php endif; ?>

                <?php if (!empty($alumniDetail['instagram'])): ?>
                    <p><strong>Instagram :</strong>
                        <a href="<?= htmlspecialchars($alumniDetail['instagram']); ?>" target="_blank" style="color: #2c5e38; text-decoration: none; font-weight: 500;">
                            <?= htmlspecialchars($alumniDetail['instagram']); ?>
                        </a>
                    </p>
                <?php endif; ?>
                <p class="alumni-bio" style="line-height: 1.6; text-align: justify; color: #555; font-style: italic;">
                    "<?= htmlspecialchars($alumniDetail['biografi'] ?? 'Belum menuliskan deskripsi profil.'); ?>"
                </p>

                <hr style="border: 1px solid #eee; margin-bottom: 20px;">

                <a href="index.php" class="btn-kembali">&larr; Kembali ke Beranda</a>
            </div>
    </main>

</body>

</html>