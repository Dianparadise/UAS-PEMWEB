
<?php
session_start();


ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require_once '../config/koneksi.php';
require_once '../app/controller/HomeController.php';

$controller = new HomeController();

$queryTerbaru = $controller->index();


?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Alumni UPNVJT</title>
    <link rel="stylesheet" href="../asset/css/style.css">
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
                    <li><a href="index.php" class="active">BERANDA</a></li>
                    <li><a href="#">UPDATE DATA</a></li>

                    <?php if (isset($_SESSION['status']) && $_SESSION['status'] == 'login'): ?>
                        <li><a href="profil.php">PROFIL (<?= $_SESSION['nama']; ?>)</a></li>
                        <li><a href="logout.php" style="color: #ff4d4d; font-weight: bold;">LOGOUT</a></li>
                    <?php else: ?>
                        <li><a href="login.php">LOGIN</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
            <div class="header-search">
                <select>
                    <option>Semua Nama</option>
                </select>
                <input type="text" placeholder="Tulis & Tekan Enter...">
                <button type="submit">🔍</button>
            </div>
        </div>
    </header>

    <main class="container">



        <div class="content-middle-grid">

            <section class="section-terbaru">
                <h2 class="section-title">TERBARU</h2>

                <div class="alumni-grid">

                    <?php while ($baru = mysqli_fetch_assoc($queryTerbaru)): ?>

                        <div class="card-alumni">

                            <img src="../<?php echo $baru['foto']; ?>" alt="<?php echo $baru['nama']; ?>" loading="lazy">

                            <h3>
                                <?php echo $baru['nama']; ?>
                            </h3>

                            <p class="meta small-meta">
                                <?php echo $baru['tahun_kelulusan']; ?>
                                <?php echo $baru['pekerjaan']; ?>

                            </p>

                        </div>

                    <?php endwhile; ?>

                </div>
            </section>
        </div>
    </main>

</body>

</html>