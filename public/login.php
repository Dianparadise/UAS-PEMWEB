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

        <a href="index.php" class="btn-back-icon" title="Kembali ke Beranda">
            <img src="../uploads/Asset/icon-back.png" alt="Kembali">
        </a>

        <div class="login-header">
            <img src="../uploads/Asset/logo1.png" alt="Logo UPN" class="logo-img">
            <h2>Masuk ke Akun</h2>
            <p>Silakan login untuk update data alumni</p>
        </div>

        <?php
        if (isset($_GET['pesan'])) {
            if ($_GET['pesan'] == "gagal") {
                echo "<p style='color: #dc143c; text-align: center; margin-bottom: 15px; font-weight: bold; background-color: #ffdce0; padding: 10px; border-radius: 5px;'>Email atau Password salah!</p>";
            } else if ($_GET['pesan'] == "registrasi_sukses") {
                echo "<p style='color: #155724; text-align: center; margin-bottom: 15px; font-weight: bold; background-color: #d4edda; padding: 10px; border-radius: 5px;'>Akun berhasil dibuat! Silakan login.</p>";
            }
        }
        ?>

        <form action="../app/controller/LoginController.php" method="POST" class="login-form">
            <div class="input-group">
                <label for="username">Email</label>
                <input type="email" id="username" name="username" placeholder="Masukkan email / username..." required>
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password..." required>

                <div style="text-align: right; margin-top: 8px;">
                    <a href="forgot_password.php"
                        style="color: #2c5e38; font-size: 0.85rem; font-weight: 600; text-decoration: none; transition: 0.3s;"
                        onmouseover="this.style.textDecoration='underline'"
                        onmouseout="this.style.textDecoration='none'">Lupa password?</a>
                </div>
            </div>

            <button type="submit" class="btn-login">Masuk</button>

            <div class="login-footer">
                <p>Belum punya akun? <a href="register.php">Daftar sekarang</a></p>
            </div>
        </form>
    </div>
</body>

</html>