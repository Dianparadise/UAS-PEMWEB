<?php
session_start();
require_once '../../config/koneksi.php';

if (isset($_POST['update_profil'])) {
    $user_id = $_SESSION['user_id'];
    $email_lama = $_SESSION['email'];

    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $email_baru = mysqli_real_escape_string($conn, $_POST['email']);
    $bio = mysqli_real_escape_string($conn, $_POST['bio']);

    $query_users = "UPDATE users SET nama='$nama', email='$email_baru' WHERE id='$user_id'";
    $update_users = mysqli_query($conn, $query_users);

    $query_profil = "UPDATE alumni_profiles SET bio='$bio' WHERE user_id='$user_id'";
    $update_profil = mysqli_query($conn, $query_profil);

    // Jika KEDUANYA berhasil di-update
    if ($update_users && $update_profil) {

        if ($email_lama !== $email_baru) {
            $_SESSION['email'] = $email_baru;
        }

        echo "<script>
                alert('Profil dan Bio Singkat berhasil diperbarui!');
                window.location='../../public/profil.php';
              </script>";
        exit;
    } else {
        echo "<script>
                alert('Gagal memperbarui profil: " . mysqli_error($conn) . "');
                window.location='../../public/edit_profil.php';
              </script>";
        exit;
    }
} else {
    header("location: ../../public/profil.php");
    exit;
}
?>