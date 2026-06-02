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
                <img src="../uploads/logo1.png" alt="Logo Dashboard" class="logo-img"
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
                                ">
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
                    value="<?= $_GET['search'] ?? ''; ?>">

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

                    <input type="hidden" name="search" value="<?= $_GET['search'] ?? ''; ?>">

                    <label>Tahun Kelulusan</label>
                    <input
                        type="number"
                        name="tahun"
                        value="<?= htmlspecialchars($tahun); ?>"
                        placeholder="Contoh: 2024"
                        style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 15px; box-sizing: border-box; font-family: inherit;">

                    <label>Angkatan</label>
                    <input
                        type="number"
                        name="angkatan"
                        value="<?= htmlspecialchars($angkatan); ?>"
                        placeholder="Contoh: 2020"
                        style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 15px; box-sizing: border-box; font-family: inherit;">
                    <label>Jurusan</label>
                    <select name="jurusan">
                        <option value="">Semua</option>

                        <option value="Teknik Informatika" <?php if ($jurusan == 'Teknik Informatika') echo 'selected'; ?>>Teknik Informatika</option>
                        <option value="Sistem Informasi" <?php if ($jurusan == 'Sistem Informasi') echo 'selected'; ?>>Sistem Informasi</option>
                        <option value="Sains Data" <?php if ($jurusan == 'Sains Data') echo 'selected'; ?>>Sains Data</option>
                        <option value="Bisnis Digital" <?php if ($jurusan == 'Bisnis Digital') echo 'selected'; ?>>Bisnis Digital</option>

                        <option value="Teknik Industri" <?php if ($jurusan == 'Teknik Industri') echo 'selected'; ?>>Teknik Industri</option>
                        <option value="Teknik Sipil" <?php if ($jurusan == 'Teknik Sipil') echo 'selected'; ?>>Teknik Sipil</option>
                        <option value="Teknik Lingkungan" <?php if ($jurusan == 'Teknik Lingkungan') echo 'selected'; ?>>Teknik Lingkungan</option>
                        <option value="Teknik Kimia" <?php if ($jurusan == 'Teknik Kimia') echo 'selected'; ?>>Teknik Kimia</option>
                        <option value="Teknologi Pangan" <?php if ($jurusan == 'Teknologi Pangan') echo 'selected'; ?>>Teknologi Pangan</option>

                        <option value="Manajemen" <?php if ($jurusan == 'Manajemen') echo 'selected'; ?>>Manajemen</option>
                        <option value="Akuntansi" <?php if ($jurusan == 'Akuntansi') echo 'selected'; ?>>Akuntansi</option>
                        <option value="Ilmu Komunikasi" <?php if ($jurusan == 'Ilmu Komunikasi') echo 'selected'; ?>>Ilmu Komunikasi</option>
                        <option value="Hubungan Internasional" <?php if ($jurusan == 'Hubungan Internasional') echo 'selected'; ?>>Hubungan Internasional</option>
                        <option value="Administrasi Bisnis" <?php if ($jurusan == 'Administrasi Bisnis') echo 'selected'; ?>>Administrasi Bisnis</option>
                        <option value="Administrasi Publik" <?php if ($jurusan == 'Administrasi Publik') echo 'selected'; ?>>Administrasi Publik</option>
                    </select>
                    <label>Fakultas</label>
                    <select name="fakultas">
                        <option value="">Semua</option>

                        <option value="Ilmu Komputer" <?php if ($fakultas == 'Ilmu Komputer') echo 'selected'; ?>>Ilmu Komputer</option>
                        <option value="Teknik" <?php if ($fakultas == 'Teknik') echo 'selected'; ?>>Teknik</option>
                        <option value="Ekonomi dan Bisnis" <?php if ($fakultas == 'Ekonomi dan Bisnis') echo 'selected'; ?>>Ekonomi dan Bisnis</option>
                        <option value="Ilmu Sosial dan Ilmu Politik" <?php if ($fakultas == 'Ilmu Sosial dan Ilmu Politik') echo 'selected'; ?>>Ilmu Sosial dan Ilmu Politik</option>
                        <option value="Pertanian" <?php if ($fakultas == 'Pertanian') echo 'selected'; ?>>Pertanian</option>
                        <option value="Hukum" <?php if ($fakultas == 'Hukum') echo 'selected'; ?>>Hukum</option>
                        <option value="Arsitektur dan Desain" <?php if ($fakultas == 'Arsitektur dan Desain') echo 'selected'; ?>>Arsitektur dan Desain</option>
                    </select>

                    <button type="submit">Terapkan Filter</button>

                </form>

            </aside>

            <!-- CONTENT KANAN -->
            <div class="content-main">

                <section class="section-terbaru">

                    <h2 class="section-title">
                        TERBARU
                    </h2>

                    <div class="alumni-grid">

                        <?php if (mysqli_num_rows($queryTerbaru) > 0): ?>

                            <?php while (
                                $baru = mysqli_fetch_assoc($queryTerbaru)
                            ): ?>

                                <a
                                    href="detail.php?id=<?php echo $baru['user_id']; ?>"
                                    style="
                    text-decoration:none;
                    color:inherit;
                    display:block;
                ">

                                    <div class="card-alumni">

                                        <img
                                            src="../<?php echo $baru['foto']; ?>"
                                            alt="<?php echo $baru['nama']; ?>"
                                            loading="lazy">

                                        <h3>
                                            <?php echo $baru['nama']; ?>
                                        </h3>

                                        <p class="meta small-meta">

                                            <?php echo $baru['tahun_kelulusan']; ?> |

                                            <?php echo $baru['pekerjaan']; ?>

                                        </p>

                                    </div>

                                </a>

                            <?php endwhile; ?>

                        <?php else: ?>

                            <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px; background-color: #f8f9fa; border-radius: 12px; border: 2px dashed #ddd;">
                                <h3 style="color: #555; margin-bottom: 10px; font-size: 1.5rem;">🔍 Data Tidak Ditemukan</h3>
                                <p style="color: #777; margin-bottom: 20px;">Maaf, tidak ada alumni yang sesuai dengan filter atau pencarian Anda.</p>
                                <a href="index.php" style="display: inline-block; padding: 10px 20px; background-color: #2c5e38; color: white; text-decoration: none; border-radius: 6px; font-weight: bold; transition: 0.3s;">
                                    ↺ Reset Filter
                                </a>
                            </div>

                        <?php endif; ?>

                    </div>

                </section>

            </div>

        </div>

    </main>

</body>

</html>