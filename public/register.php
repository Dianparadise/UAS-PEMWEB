<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Alumni IPB Pedia</title>
    <link rel="stylesheet" href="../asset/css/style.css">
</head>

<body class="login-body">

    <div class="login-container" style="margin: 40px 0;">
        <div class="login-header">
            <!-- Menyamakan jalur logo dengan halaman login -->
            <img src="../uploads/logo1.png" alt="Logo UPN" class="logo-img">
            <h2>Daftar Akun Baru</h2>
            <p>Isi data di bawah ini untuk membuat akun</p>
        </div>

        <?php
        // Memasukkan SEMUA kondisi ke dalam pelindung isset() agar tidak error
        if (isset($_GET['pesan'])) {
            if ($_GET['pesan'] == "password_beda") {
                echo "<p style='color: #dc143c; text-align: center; margin-bottom: 15px; font-weight: bold; background-color: #ffdce0; padding: 10px; border-radius: 5px;'>Password dan Konfirmasi tidak cocok!</p>";
            } else if ($_GET['pesan'] == "email_kembar") {
                echo "<p style='color: #dc143c; text-align: center; margin-bottom: 15px; font-weight: bold; background-color: #ffdce0; padding: 10px; border-radius: 5px;'>Email sudah terdaftar!</p>";
            } else if ($_GET['pesan'] == "angkatan_kosong") {
                echo "<p style='color: #dc143c; text-align: center; margin-bottom: 15px; font-weight: bold; background-color: #ffdce0; padding: 10px; border-radius: 5px;'>Tahun Angkatan wajib diisi!</p>";
            } else if ($_GET['pesan'] == "gagal") {
                echo "<p style='color: #dc143c; text-align: center; margin-bottom: 15px; font-weight: bold; background-color: #ffdce0; padding: 10px; border-radius: 5px;'>Terjadi kesalahan, coba lagi.</p>";
            }
        }
        ?>
        <form action="../app/controller/RegisterController.php" method="POST" class="login-form">
            <div class="input-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap..." required>
            </div>

            <div class="input-group">
                <label for="email">Alamat Email</label>
                <input type="email" id="email" name="email" placeholder="Contoh: budi@gmail.com" required>
            </div>

            <div class="input-group">
                <label for="role">Status Anda</label>
                <select id="role" name="role" onchange="cekRole()"
                    style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 5px; font-size: 0.95rem; outline: none; background: white;"
                    required>
                    <option value="" disabled selected>-- Pilih Status --</option>
                    <option value="alumni">Alumni</option>
                    <option value="mahasiswa">Mahasiswa</option>
                </select>
            </div>

            <div class="input-group" id="kotak_angkatan" style="display: none;">
                <label for="angkatan">Tahun Angkatan <span style="color:red">*</span></label>
                <input type="number" id="angkatan" name="angkatan" placeholder="Contoh: 2021">
            </div>

            <div class="input-group" id="kotak_lulus" style="display: none;">
                <label for="tahun_kelulusan">Tahun Kelulusan <span style="color:red">*</span></label>
                <input type="number" id="tahun_kelulusan" name="tahun_kelulusan" placeholder="Contoh: 2025">
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Buat password..." required>
            </div>

            <div class="input-group">
                <label for="konfirmasi_password">Konfirmasi Password</label>
                <input type="password" id="konfirmasi_password" name="konfirmasi_password"
                    placeholder="Ulangi password..." required>
            </div>

            <button type="submit" class="btn-login">Daftar Sekarang</button>

            <div class="login-footer">
                <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
            </div>
        </form>
    </div>

    <script>
        function cekRole() {
            var role = document.getElementById("role").value;
            var kotakAngkatan = document.getElementById("kotak_angkatan");
            var inputAngkatan = document.getElementById("angkatan");
            var kotakLulus = document.getElementById("kotak_lulus");
            var inputLulus = document.getElementById("tahun_kelulusan");

            if (role === "mahasiswa") {
                // MAHASISWA: Munculkan Angkatan, Sembunyikan Lulus
                kotakAngkatan.style.display = "block";
                inputAngkatan.required = true;

                kotakLulus.style.display = "none";
                inputLulus.required = false;
                inputLulus.value = ""; // Bersihkan data kalau tadi sempat diisi
            } else if (role === "alumni") {
                // ALUMNI: Munculkan Angkatan & Munculkan Lulus
                kotakAngkatan.style.display = "block";
                inputAngkatan.required = true;

                kotakLulus.style.display = "block";
                inputLulus.required = true;
            } else {
                // DEFAULT (Belum milih): Sembunyikan semuanya
                kotakAngkatan.style.display = "none";
                inputAngkatan.required = false;

                kotakLulus.style.display = "none";
                inputLulus.required = false;
            }
        }

        window.onload = cekRole;
    </script>

</body>

</html>