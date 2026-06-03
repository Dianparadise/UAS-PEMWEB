<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - SIJA</title>
    <link rel="stylesheet" href="../asset/css/style.css">
</head>

<body class="login-body">

    <div class="login-container">

        <a href="login.php" class="btn-back-icon" title="Kembali ke Login">
            <img src="../uploads/Asset/icon-back.png" alt="Kembali">
        </a>

        <div class="login-header">
            <img src="../uploads/Asset/logo1.png" alt="Logo UPN" class="logo-img">
            <h2>Lupa Password</h2>
            <p>Masukkan email Anda untuk memvalidasi akun</p>
        </div>

        <?php
        if (isset($_GET['pesan'])) {
            if ($_GET['pesan'] == "not_found") {
                echo "<p style='color: #dc143c; text-align: center; margin-bottom: 15px; font-weight: bold; background-color: #ffdce0; padding: 10px; border-radius: 5px;'>Email tidak terdaftar di sistem!</p>";
            }
        }
        ?>

        <form action="../app/controller/ForgotPasswordController.php" method="POST" class="login-form">
            <div class="input-group">
                <label for="email">Email Akun</label>
                <input type="email" id="email" name="email" placeholder="Masukkan email terdaftar..." required>
            </div>

            <button type="submit" class="btn-login">Cek Email</button>
        </form>
    </div>

</body>

</html>