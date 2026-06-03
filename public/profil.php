<?php

session_start();

if (!isset($_SESSION['status'])) {
    header("location: login.php");
    exit;
}

require_once '../app/controller/ProfileController.php';

$controller = new ProfileController();

// Ambil semua data profil
$data = $controller->index($_SESSION['email']);

$data_user = $data['user'];
$data_profil = $data['profil'];
$queryRequest = $data['request'];

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Profil - Alumni IPB Pedia</title>
    <link rel="stylesheet" href="../asset/css/style.css">
</head>

<body>

    <!-- HEADER NAVIGATION -->
    <header class="main-header">
        <div class="container header-content">
            <div class="logo">
                <img src="../uploads/Asset/logo1.png" alt="Logo Dashboard" class="logo-img">
                <span class="logo-text">SIJA (Sistem Informasi Jejak Alumni)</span>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="index.php">BERANDA</a></li>
                    <li><a href="update_data.php">UPDATE DATA</a></li>
                    <li><a href="profil.php" class="active">PROFIL</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <!-- LAYOUT UTAMA: SIDEBAR & KONTEN -->
        <div class="dashboard-layout">

            <!-- MENU SIDEBAR PROFIL -->
            <aside class="profile-sidebar">
                <div class="user-avatar-section" style="text-align: center;">

                    <div class="avatar-big">
                        <img id="preview-foto" src="../<?= htmlspecialchars($data_profil['foto'] ?? 'asset/img/default-avatar.png'); ?>" alt="Foto Profil">
                    </div>

                    <form action="../app/controller/UpdateFotoController.php" method="POST" enctype="multipart/form-data" style="margin-bottom: 25px;">

                        <input type="file" name="foto_profil" id="input-foto" accept="image/jpeg, image/png, image/jpg" required style="display: none;" onchange="previewImage(event)">

                        <label for="input-foto" class="btn-edit-foto" id="label-foto">
                            Edit Foto
                        </label>

                        <br>

                        <button id="btn-simpan" type="submit" class="btn-simpan-foto">
                            Simpan Perubahan
                        </button>
                    </form>

                    <h3 style="margin-bottom: 5px; color: #333; font-size: 1.3rem;">
                        <?= $data_user['nama']; ?>
                    </h3>
                    <span class="badge-role" style="background-color: #e8f5e9; color: #2c5e38; padding: 4px 12px; border-radius: 12px; font-size: 0.75rem; font-weight: bold;">
                        <?= strtoupper($data_user['role']); ?>
                    </span>
                </div>

                <script>
                    function previewImage(event) {
                        var reader = new FileReader();
                        reader.onload = function() {
                            // Ganti gambar langsung di lingkaran
                            var output = document.getElementById('preview-foto');
                            output.src = reader.result;

                            // Memanggil class CSS .success-state agar label otomatis berubah menjadi hijau
                            var label = document.getElementById('label-foto');
                            label.classList.add('success-state');
                            label.innerHTML = 'Foto Terpilih, Siap Disimpan!';

                            // Munculkan tombol simpan
                            document.getElementById('btn-simpan').style.display = 'inline-block';
                        };
                        reader.readAsDataURL(event.target.files[0]);
                    }
                </script>
                <nav class="sidebar-menu">
                    <nav class="sidebar-menu">
                        <a href="#biodata" class="menu-item active">
                            <img src="../uploads/Asset/biodata.png" alt="Biodata" class="menu-icon">
                            Biodata Alumni
                        </a>

                        <a href="#status-pengajuan" class="menu-item">
                            <img src="../uploads/Asset/status.png" alt="Status" class="menu-icon">
                            Status Pengajuan
                        </a>

                        <a href="#ubah-password" class="menu-item">
                            <img src="../uploads/Asset//password.png" alt="Password" class="menu-icon">
                            Ubah Password
                        </a>

                        <a href="logout.php" class="menu-item logout-link">
                            <img src="../uploads/Asset/logout.png" alt="Logout" class="menu-icon">
                            Logout
                        </a>
                    </nav>
                </nav>
            </aside>

            <!-- KONTEN UTAMA UTK TIAP FITUR -->
            <main class="profile-main-content">

                <!-- FITUR 1: NAMA AKUN & BIODATA -->
                <section id="biodata" class="content-section">
                    <div class="section-header-box">
                        <h2>Biodata Alumni</h2>

                    </div>

                    <div class="info-grid">
                        <div class="info-group">
                            <label>Nama Akun</label>
                            <p>
                                <?= $data_user['nama']; ?>
                            </p>
                        </div>
                        <div class="info-group">
                            <label>Email Resmi</label>
                            <p>
                                <?= $data_user['email']; ?>
                            </p>
                        </div>
                        <div class="info-group">
                            <label>Fakultas</label>
                            <p>
                                <?= htmlspecialchars($data_profil['fakultas'] ?? '- Belum diisi -'); ?>
                            </p>
                        </div>
                        <div class="info-group">
                            <label>Jurusan</label>
                            <p>
                                <?= htmlspecialchars($data_profil['jurusan'] ?? '- Belum diisi -'); ?>
                            </p>
                        </div>
                        <div class="info-group">
                            <label>Tahun Kelulusan</label>
                            <p>
                                <?= $data_profil['tahun_kelulusan'] ?? '- Belum diisi -'; ?>
                            </p>
                        </div>
                        <div class="info-group">
                            <label>Angkatan</label>
                            <p>
                                <?= $data_profil['angkatan'] ?? '- Belum diisi -'; ?>
                            </p>
                        </div>
                        <div class="info-group">
                            <label>Pekerjaan Saat Ini</label>
                            <p>
                                <?= $data_profil['pekerjaan'] ?? '- Belum diisi -'; ?>
                            </p>
                        </div>
                        <div class="info-group">
                            <label>Perusahaan</label>
                            <p>
                                <?= $data_profil['perusahaan'] ?? '- Belum diisi -'; ?>
                            </p>
                        </div>
                    </div>
                </section>

                <!-- FITUR 2: STATUS PENGAJUAN UPDATE -->
                <section id="status-pengajuan" class="content-section" style="margin-top: 30px;">
                    <div class="section-header-box">
                        <h2>Status Pengajuan Perubahan Data</h2>
                    </div>

                    <div class="table-responsive">
                        <table class="status-table">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Pekerjaan Baru</th>
                                    <th>Perusahaan Baru</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($queryRequest && mysqli_num_rows($queryRequest) > 0): ?>
                                    <?php while ($row = mysqli_fetch_assoc($queryRequest)): ?>
                                        <tr>
                                            <td>
                                                <?= date('d M Y', strtotime($row['created_at'])); ?>
                                            </td>
                                            <td>
                                                <?= $row['pekerjaan_baru'] ?? '-'; ?>
                                            </td>
                                            <td>
                                                <?= $row['perusahaan_baru'] ?? '-'; ?>
                                            </td>
                                            <td>
                                                <?php if ($row['status'] == 'approved'): ?>
                                                    <span class="status-badge approved">Disetujui</span>
                                                <?php elseif ($row['status'] == 'rejected'): ?>
                                                    <span class="status-badge rejected">Ditolak</span>
                                                <?php else: ?>
                                                    <span class="status-badge pending">Diproses</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="empty-table-text">Belum ada riwayat pengajuan update data.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- FITUR 3: UBAH PASSWORD -->
                <section id="ubah-password" class="content-section" style="margin-top: 30px;">
                    <div class="section-header-box">
                        <h2>Keamanan Akun (Ubah Password)</h2>
                    </div>

                    <form action="../app/controller/UpdatePassword.php" method="POST" class="password-form">
                        <div class="form-group">
                            <label for="pass_lama">Password Sekarang</label>
                            <input type="password" id="pass_lama" name="pass_lama"
                                placeholder="Masukkan password saat ini..." required>
                        </div>
                        <div class="form-group">
                            <label for="pass_baru">Password Baru</label>
                            <input type="password" id="pass_baru" name="pass_baru"
                                placeholder="Masukkan password baru..." required>
                        </div>
                        <button type="submit" class="btn-save-password">Simpan Password Baru</button>
                    </form>
                </section>

            </main>
        </div>
    </div>

    <script>
        // Ambil semua menu kiri dan semua kotak konten (section) di kanan
        const menuItems = document.querySelectorAll('.sidebar-menu .menu-item:not(.logout-link)');
        const sections = document.querySelectorAll('.profile-main-content .content-section');

        // Aturan deteksi: jalankan fungsi ketika 50% (0.5) bagian section terlihat di layar
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.5
        };

        // Mesin pendeteksi posisi layar (Intersection Observer)
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                // Jika kotak section sedang muncul di layar...
                if (entry.isIntersecting) {
                    // Ambil ID dari kotak tersebut (misal: 'biodata' atau 'status-pengajuan')
                    const currentId = entry.target.getAttribute('id');

                    // Bersihkan warna biru dari semua menu
                    menuItems.forEach(item => {
                        item.classList.remove('active');
                        // Cari menu yang link-nya cocok dengan kotak yang tampil, lalu warnai biru!
                        if (item.getAttribute('href') === `#${currentId}`) {
                            item.classList.add('active');
                        }
                    });
                }
            });
        }, observerOptions);


        sections.forEach(section => {
            observer.observe(section);
        });
    </script>
</body>

</html>

</html>