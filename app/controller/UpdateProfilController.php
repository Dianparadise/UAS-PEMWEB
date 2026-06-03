<?php
session_start();
require_once '../../config/koneksi.php';

if (isset($_POST['update_profil'])) {
    $user_id = $_SESSION['user_id'];
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $query = "UPDATE users SET nama='$nama', email='$email' WHERE id='$user_id'";

    if (mysqli_query($conn, $query)) {
        // Update Session agar nama di header langsung sinkron
        $_SESSION['nama'] = $nama;
        header("location: ../../public/profil.php?status=success");
    } else {
        echo "Gagal update: " . mysqli_error($conn);
    }
}
?>