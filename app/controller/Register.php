<?php
require_once '../../config/koneksi.php';

// 1. Tangkap semua data teks standar
$nama = mysqli_real_escape_string($conn, $_POST['nama']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$role = mysqli_real_escape_string($conn, $_POST['role']);
$password = $_POST['password'];
$konfirmasi_password = $_POST['konfirmasi_password'];

// 2. TRIK MENGATASI "OUT OF RANGE":
// Jika form kosong, ubah menjadi NULL agar MySQL tidak error
$angkatan = !empty($_POST['angkatan']) ? "'" . mysqli_real_escape_string($conn, $_POST['angkatan']) . "'" : "NULL";
$tahun_kelulusan = !empty($_POST['tahun_kelulusan']) ? "'" . mysqli_real_escape_string($conn, $_POST['tahun_kelulusan']) . "'" : "NULL";

// 3. Validasi Password
if ($password !== $konfirmasi_password) {
    header("location:../../public/register.php?pesan=password_beda");
    exit;
}

// 4. Validasi Email Kembar
$cek_email = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
if (mysqli_num_rows($cek_email) > 0) {
    header("location:../../public/register.php?pesan=email_kembar");
    exit;
}

// 5. Masukkan ke tabel `users`
$query_user = "INSERT INTO users (nama, email, password, role, created_at) VALUES ('$nama', '$email', '$password', '$role', NOW())";

if (mysqli_query($conn, $query_user)) {
    // Ambil ID user yang barusan otomatis dibikin
    $user_id_baru = mysqli_insert_id($conn);

    // 6. Buatkan profil di tabel `alumni_profiles`
    // PERHATIKAN: Variabel $angkatan dan $tahun_kelulusan tidak lagi diapit tanda kutip ('') 
    // karena sudah kita atur di langkah ke-2 di atas.
    $query_profil = "INSERT INTO alumni_profiles (user_id, angkatan, tahun_kelulusan, created_at) VALUES ('$user_id_baru', $angkatan, $tahun_kelulusan, NOW())";

    mysqli_query($conn, $query_profil);

    // Sukses, tendang ke login!
    header("location:../../public/login.php?pesan=registrasi_sukses");
} else {
    header("location:../../public/register.php?pesan=gagal");
}
?>