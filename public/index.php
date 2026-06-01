<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../config/koneksi.php';
require_once '../app/controller/HomeController.php';

$controller = new HomeController();

$search = $_GET['search'] ?? '';
$tahun = $_GET['tahun'] ?? '';
$angkatan = $_GET['angkatan'] ?? '';
$jurusan = $_GET['jurusan'] ?? '';
$fakultas = $_GET['fakultas'] ?? '';

$queryTerbaru = $controller->index(
    $search,
    $tahun,
    $angkatan,
    $jurusan,
    $fakultas
);
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

    <!-- HEADER -->
    <header class="main-header">

        <div class="container header-content">

            <!-- LOGO -->
            <div class="logo">

                <img 
                    src="../asset/img/logo.png" 
                    alt="Logo" 
                    class="logo-img"
                >

                <span class="logo-text">
                    alumniipbpedia
                </span>

            </div>

            <!-- NAVBAR -->
            <nav class="main-nav">

                <ul>

                    <li>
                        <a href="index.php" class="active">
                            BERANDA
                        </a>
                    </li>

                    <li>
                        <a href="update_data.php">
                            UPDATE DATA
                        </a>
                    </li>

                    <?php if (
                        isset($_SESSION['status']) &&
                        $_SESSION['status'] == 'login'
                    ): ?>

                        <li>
                            <a href="profil.php">
                                PROFIL (<?= $_SESSION['nama']; ?>)
                            </a>
                        </li>

                        <li>
                            <a 
                                href="logout.php"
                                style="
                                    color:#ff4d4d;
                                    font-weight:bold;
                                "
                            >
                                LOGOUT
                            </a>
                        </li>

                    <?php else: ?>

                        <li>
                            <a href="login.php">
                                LOGIN
                            </a>
                        </li>

                    <?php endif; ?>

                </ul>

            </nav>

            <!-- SEARCH -->
            <form class="header-search" method="GET">

                <input 
                    type="text"
                    name="search"
                    placeholder="Cari nama / pekerjaan..."
                    value="<?= $_GET['search'] ?? ''; ?>"
                >

                <button type="submit">
                    🔍
                </button>

            </form>

        </div>

    </header>

    <!-- CONTENT -->
    <main class="container">

        <div class="content-layout">

            <!-- SIDEBAR FILTER -->
            <aside class="filter-sidebar">

                <h3>FILTER</h3>

                <form method="GET" class="sidebar-filter">

                    <!-- SEARCH TETAP DIBAWA -->
                    <input 
                        type="hidden"
                        name="search"
                        value="<?= $_GET['search'] ?? ''; ?>"
                    >

                    <!-- TAHUN -->
                    <label>
                        Tahun Kelulusan
                    </label>

                    <select name="tahun">

                        <option value="">
                            Semua
                        </option>

                        <option value="2024">
                            2024
                        </option>

                        <option value="2023">
                            2023
                        </option>

                        <option value="2022">
                            2022
                        </option>

                    </select>

                    <!-- ANGKATAN -->
                    <label>
                        Angkatan
                    </label>

                    <select name="angkatan">

                        <option value="">
                            Semua
                        </option>

                        <option value="2020">
                            2020
                        </option>

                        <option value="2021">
                            2021
                        </option>

                        <option value="2022">
                            2022
                        </option>

                    </select>

                    <!-- JURUSAN -->
                    <label>
                        Jurusan
                    </label>

                    <select name="jurusan">

                        <option value="">
                            Semua
                        </option>

                        <option value="Teknik Informatika">
                            Teknik Informatika
                        </option>

                        <option value="Sistem Informasi">
                            Sistem Informasi
                        </option>

                    </select>

                    <!-- FAKULTAS -->
                    <label>
                        Fakultas
                    </label>

                    <select name="fakultas">

                        <option value="">
                            Semua
                        </option>

                        <option value="Ilmu Komputer">
                            Ilmu Komputer
                        </option>

                        <option value="Teknik">
                            Teknik
                        </option>

                    </select>

                    <button type="submit">
                        Terapkan Filter
                    </button>

                </form>

            </aside>

            <!-- CONTENT KANAN -->
            <div class="content-main">

                <section class="section-terbaru">

                    <h2 class="section-title">
                        TERBARU
                    </h2>

                    <div class="alumni-grid">

                        <?php while (
                            $baru = mysqli_fetch_assoc($queryTerbaru)
                        ): ?>

                            <a 
                                href="detail.php?id=<?php echo $baru['user_id']; ?>"
                                style="
                                    text-decoration:none;
                                    color:inherit;
                                    display:block;
                                "
                            >

                                <div class="card-alumni">

                                    <img
                                        src="../<?php echo $baru['foto']; ?>"
                                        alt="<?php echo $baru['nama']; ?>"
                                        loading="lazy"
                                    >

                                    <h3>
                                        <?php echo $baru['nama']; ?>
                                    </h3>

                                    <p class="meta small-meta">

                                        <?php echo $baru['tahun_kelulusan']; ?>

                                        <?php echo $baru['pekerjaan']; ?>

                                    </p>

                                </div>

                            </a>

                        <?php endwhile; ?>

                    </div>

                </section>

            </div>

        </div>

    </main>

</body>

</html>