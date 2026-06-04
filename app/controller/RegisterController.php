<?php
require_once '../../config/koneksi.php';

// 1. Tangkap semua data teks standar
$nama = mysqli_real_escape_string($conn, $_POST['nama']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$role = mysqli_real_escape_string($conn, $_POST['role']);
$jurusan_id = mysqli_real_escape_string($conn, $_POST['jurusan_id']);
$password = md5($_POST['password']);
$konfirmasi_password = md5($_POST['konfirmasi_password']);

// 2. VALIDASI ANGKATAN (WAJIB DIISI!)
// Jika kosong, langsung tolak dan kembalikan ke halaman register
if (empty($_POST['angkatan'])) {
    header("location:../../public/register.php?pesan=angkatan_kosong");
    exit;
}
// Jika ada isinya, amankan datanya dan beri tanda kutip
$angkatan = "'" . mysqli_real_escape_string($conn, $_POST['angkatan']) . "'";

// 3. TAHUN KELULUSAN (Boleh kosong/NULL jika yang daftar adalah Mahasiswa)
$tahun_kelulusan = !empty($_POST['tahun_kelulusan']) ? "'" . mysqli_real_escape_string($conn, $_POST['tahun_kelulusan']) . "'" : "NULL";

// 4. Validasi Password
if ($password !== $konfirmasi_password) {
    header("location:../../public/register.php?pesan=password_beda");
    exit;
}

// 5. Validasi Email Kembar
$cek_email = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
if (mysqli_num_rows($cek_email) > 0) {
    header("location:../../public/register.php?pesan=email_kembar");
    exit;
}

// 6. Masukkan ke tabel `users`
$query_user = "INSERT INTO users (nama, email, password, role, created_at) VALUES ('$nama', '$email', '$password', '$role', NOW())";

if (mysqli_query($conn, $query_user)) {
    // Ambil ID user yang barusan otomatis dibikin
    $user_id_baru = mysqli_insert_id($conn);

    // 7. Buatkan profil di tabel `alumni_profiles`
    // Perhatikan: $angkatan tidak pakai kutip lagi karena sudah diatur di langkah nomor 2
    $query_profil = "INSERT INTO alumni_profiles
(user_id, jurusan_id, angkatan, tahun_kelulusan, created_at)
VALUES
('$user_id_baru', '$jurusan_id', $angkatan, $tahun_kelulusan, NOW())";
    mysqli_query($conn, $query_profil);

    // Sukses, tendang ke login!
    header("location:../../public/login.php?pesan=registrasi_sukses");
} else {
    header("location:../../public/register.php?pesan=gagal");
}
?>