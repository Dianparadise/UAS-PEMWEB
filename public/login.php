<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Alumni IPB Pedia</title>
    <link rel="stylesheet" href="../asset/css/style.css">
</head>

<body class="login-body">

    <div class="login-container">
        <div class="login-header">
            <img src="../asset/img/logo.png" alt="Logo" class="logo-img">
            <h2>Masuk ke Akun</h2>
            <p>Silakan login untuk update data alumni</p>
        </div>

        <?php
        if (isset($_GET['pesan'])) {
            if ($_GET['pesan'] == "gagal") {
                echo "<p style='color: #dc143c; text-align: center; margin-bottom: 15px; font-weight: bold; background-color: #ffdce0; padding: 10px; border-radius: 5px;'>Username atau Password salah!</p>";
            } else if ($_GET['pesan'] == "registrasi_sukses") {
                echo "<p style='color: #155724; text-align: center; margin-bottom: 15px; font-weight: bold; background-color: #d4edda; padding: 10px; border-radius: 5px;'>Akun berhasil dibuat! Silakan login.</p>";
            }
        }
        ?>

        <form action="../app/controller/Login.php" method="POST" class="login-form">
            <div class="input-group">
                <label for="username">Email atau Username</label>
                <input type="text" id="username" name="username" placeholder="Masukkan email / username..." required>
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password..." required>
            </div>

            <button type="submit" class="btn-login">Masuk</button>

            <div class="login-footer">
                <p>Belum punya akun? <a href="register.php">Daftar sekarang</a></p>
                <p><a href="index.php">← Kembali ke Beranda</a></p>
            </div>
            <div class="login-footer">
                <p><a href="forgot_password.php" style="color: #315739; font-weight: bold;">Lupa Password?</a></p>
                <p>Belum punya akun? <a href="register.php">Daftar sekarang</a></p>
                <p><a href="index.php">← Kembali ke Beranda</a></p>
            </div>
        </form>
    </div>

</body>

</html>