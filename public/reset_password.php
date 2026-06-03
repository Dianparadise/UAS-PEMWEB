<?php
session_start();
// Proteksi halaman: jika tidak ada session reset_email, tendang balik ke form awal
if (!isset($_SESSION['reset_email'])) {
    header("location: forgot_password.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - SIJA</title>
    <link rel="stylesheet" href="../asset/css/style.css">
</head>

<body class="login-body">

    <div class="login-container">

        <a href="forgot_password.php" class="btn-back-icon" title="Kembali">
            <img src="../uploads/Asset/icon-back.png" alt="Kembali">
        </a>

        <div class="login-header">
            <img src="../uploads/Asset/logo1.png" alt="Logo UPN" class="logo-img">
            <h2>Password Baru</h2>
            <p>Silakan masukkan password baru untuk akun:<br><strong><?= $_SESSION['reset_email']; ?></strong></p>
        </div>

        <form action="../app/controller/ProsesResetPassword.php" method="POST" class="login-form">
            <div class="input-group">
                <label for="password_baru">Password Baru</label>
                <input type="password" id="password_baru" name="password_baru" placeholder="Minimal 6 karakter..." required>
            </div>

            <button type="submit" class="btn-login">Simpan Password Baru</button>
        </form>
    </div>

</body>

</html>