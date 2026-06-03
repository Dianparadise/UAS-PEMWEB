<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != 'login') {
    header("location: login.php");
    exit;
}

require_once '../config/koneksi.php';
$email_user = $_SESSION['email'];

// Ambil data user & profil
$queryUser = mysqli_query($conn, "SELECT * FROM users WHERE email='$email_user'");
$data_user = mysqli_fetch_assoc($queryUser);
$user_id = $data_user['id'];

$queryProfil = mysqli_query($conn, "SELECT * FROM alumni_profiles WHERE user_id='$user_id'");
$data_profil = mysqli_fetch_assoc($queryProfil);
$profil_id = isset($data_profil['id']) ? $data_profil['id'] : 0;

// Ambil 3 riwayat pengajuan terakhir untuk sidebar kanan
$queryRiwayat = mysqli_query($conn, "SELECT * FROM update_requests WHERE alumni_id='$profil_id' ORDER BY id DESC LIMIT 3");
// Ambil pengajuan terakhir untuk status paling atas
$queryStatus = mysqli_query($conn, "SELECT * FROM update_requests WHERE alumni_id='$profil_id' ORDER BY id DESC LIMIT 1");
$status_terakhir = mysqli_fetch_assoc($queryStatus);

// Amankan pengecekan status kelulusan dari perbedaan kapital atau spasi
$status_kelulusan = isset($data_profil['status_kelulusan']) ? strtolower(trim($data_profil['status_kelulusan'])) : '';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajukan Perubahan Data - Alumni IPB Pedia</title>
    <link rel="stylesheet" href="../asset/css/style.css">
</head>

<body class="bg-light">

    <header class="main-header">
        <div class="container header-content">
            <div class="logo">
                <img src="../uploads/Asset/logo1.png" alt="Logo Dashboard" class="logo-img">
                <span class="logo-text">SIJA (Sistem Informasi Jejak Alumni)</span>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="index.php">BERANDA</a></li>
                    <li><a href="update_data.php" class="active">UPDATE DATA</a></li>
                    <li><a href="profil.php">PROFIL</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container update-page-container">
        <div class="page-header">
            <h2>Ajukan Perubahan Data</h2>
            <p class="breadcrumb">Dashboard > Ajukan Perubahan Data > Form Pekerjaan & Sosial Media</p>
        </div>

        <div class="update-layout-grid">

            <div class="left-column">

                <?php if ($data_user['role'] == 'mahasiswa'): ?>
                    <div class="card-box claim-box">
                        <h3 class="claim-title">
                            <img src="../uploads/Asset/graduation.png" alt="Icon Lulus" class="claim-icon-title">
                            Sudah Lulus?
                        </h3>

                        <?php if ($status_kelulusan == 'pending'): ?>
                            <div class="alert-pending">
                                <img src="../uploads/Asset/pending.png" alt="Icon Pending" class="alert-icon">
                                <div class="alert-content">
                                    <strong>Status: Menunggu Validasi Admin</strong>
                                    <p>Pengajuan klaim alumni Anda sudah berhasil dikirim. Mohon tunggu beberapa saat hingga
                                        Admin memverifikasi berkas berkas Ijazah/SKL Anda.</p>
                                </div>
                            </div>

                        <?php else: ?>
                            <?php if ($status_kelulusan == 'ditolak'): ?>
                                <div class="alert-rejected">
                                    <img src="../uploads/Asset/rejected.png" alt="Icon Ditolak" class="alert-icon">
                                    <span>Pengajuan klaim kelulusan Anda sebelumnya ditolak oleh admin. Silakan unggah kembali
                                        berkas ijazah/SKL yang sah dan jelas.</span>
                                </div>
                            <?php endif; ?>

                            <p class="claim-text">Selamat! Silakan perbarui statusmu menjadi Alumni dengan mengisi tahun
                                kelulusan serta melampirkan bukti kelulusan di bawah ini.</p>

                            <form action="../app/controller/UpdateStatus.php" method="POST" enctype="multipart/form-data"
                                class="claim-form">
                                <div class="claim-form-row">
                                    <div class="claim-form-group type-year">
                                        <label class="claim-label">Tahun Kelulusan</label>
                                        <input type="number" name="tahun_kelulusan" placeholder="Contoh: 2026" required
                                            class="claim-input">
                                    </div>
                                    <div class="claim-form-group type-file">
                                        <label class="claim-label">Upload Ijazah / SKL (PDF/JPG/PNG)</label>
                                        <input type="file" name="bukti_kelulusan" accept=".pdf, .jpg, .jpeg, .png" required
                                            class="claim-input-file">
                                    </div>
                                </div>
                                <button type="submit" class="claim-btn">
                                    Kirim Berkas & Klaim Status Alumni
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <div class="card-box">
                    <div class="stepper">
                        <div class="step active"><span class="step-num">1</span> Isi Data</div>
                        <div class="step-line"></div>
                        <div class="step active"><span class="step-num">2</span> Upload Bukti</div>
                        <div class="step-line"></div>
                        <div class="step"><span class="step-num">3</span> Tunggu Validasi</div>
                    </div>

                    <h3 class="form-title">Form Perubahan Data Alumni</h3>

                    <form action="../app/controller/ProsesUpdateData.php" method="POST" enctype="multipart/form-data"
                        class="modern-form">

                        <div class="form-row">
                            <div class="form-group half">
                                <label>Pekerjaan Baru <span class="text-danger">*</span></label>
                                <input type="text" name="pekerjaan_baru" placeholder="Contoh: Senior Frontend Developer"
                                    required>
                            </div>
                            <div class="form-group half">
                                <label>Perusahaan Baru <span class="text-danger">*</span></label>
                                <input type="text" name="perusahaan_baru" placeholder="Contoh: PT Digital Nusantara"
                                    required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group half">
                                <label>Link LinkedIn Baru</label>
                                <input type="url" name="linkedin_baru" placeholder="https://linkedin.com/in/username">
                            </div>
                            <div class="form-group half">
                                <label>Link Instagram Baru</label>
                                <input type="url" name="instagram_baru" placeholder="https://instagram.com/username">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Upload File Bukti (PDF/JPG) <span class="text-danger">*</span></label>
                            <input type="file" name="bukti_file" class="file-input" accept=".pdf, .jpg, .jpeg, .png"
                                required>
                            <small class="help-text">Upload ID Card perusahaan, surat keterangan kerja, atau screenshot
                                profil.</small>
                        </div>

                        <div class="form-actions">
                            <a href="profil.php" class="btn-cancel">Batal</a>
                            <button type="submit" class="btn-submit">Simpan & Ajukan</button>
                        </div>
                    </form>
                </div>

                <div class="card-box guide-box">
                    <div class="guide-content">
                        <h4>Panduan Upload Bukti</h4>
                        <p>Pastikan file bukti yang Anda upload terlihat jelas, tidak buram, dan ukurannya tidak
                            melebihi 5MB. Format yang didukung: <strong>PDF, JPG, PNG</strong>.</p>
                    </div>
                </div>
            </div>

            <div class="right-column">

                <div class="card-box status-card">
                    <div class="status-header">
                        <h3>Status Pengajuan</h3>
                        <?php if ($status_terakhir): ?>
                            <?php if ($status_terakhir['status'] == 'pending'): ?>
                                <span class="badge-status pending-badge">PENDING</span>
                            <?php elseif ($status_terakhir['status'] == 'approved'): ?>
                                <span class="badge-status approved-badge">DISETUJUI</span>
                            <?php else: ?>
                                <span class="badge-status rejected-badge">DITOLAK</span>
                            <?php endif; ?>
                        <?php else: ?>
                            <span class="badge-status grey-badge">KOSONG</span>
                        <?php endif; ?>
                    </div>

                    <?php if ($status_terakhir): ?>
                        <div class="status-detail">
                            <p class="meta-label">Tanggal Pengajuan</p>
                            <p class="meta-value">
                                <?= date('d F Y H:i', strtotime($status_terakhir['created_at'])); ?>
                            </p>

                            <p class="meta-label mt-3">Catatan Admin</p>
                            <p class="meta-note">
                                <?= $status_terakhir['admin_notes'] ?? 'Menunggu verifikasi dari admin. Anda akan mendapat update jika disetujui.'; ?>
                            </p>
                        </div>
                    <?php else: ?>
                        <p class="meta-note">Belum ada pengajuan perubahan data saat ini.</p>
                    <?php endif; ?>
                </div>

                <div class="card-box history-card">
                    <h3>Riwayat Pengajuan</h3>
                    <div class="history-list">
                        <?php if (mysqli_num_rows($queryRiwayat) > 0): ?>
                            <?php while ($riwayat = mysqli_fetch_assoc($queryRiwayat)): ?>
                                <div class="history-item">
                                    <div class="history-info">
                                        <span class="indicator <?= $riwayat['status']; ?>"></span>
                                        <div>
                                            <p class="history-title">Update Data Profil</p>
                                            <p class="history-date">
                                                <?= date('d M Y H:i', strtotime($riwayat['created_at'])); ?>
                                            </p>
                                        </div>
                                    </div>
                                    <span class="history-status-text <?= $riwayat['status']; ?>">
                                        <?= strtoupper($riwayat['status']); ?>
                                    </span>
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <p class="meta-note text-center">Belum ada riwayat.</p>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

</html>