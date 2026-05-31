<?php

class AuthController
{
    // Variabel untuk menyimpan jalur ke database
    private $koneksi;

    // Method ini akan otomatis jalan pertama kali saat Controller dipanggil
    public function __construct($db_koneksi)
    {
        $this->koneksi = $db_koneksi;
    }

    // Method khusus untuk mengecek login
    public function login($username, $password)
    {
        // Keamanan dasar: mencegah SQL Injection
        $username = mysqli_real_escape_string($this->koneksi, $username);
        $password = mysqli_real_escape_string($this->koneksi, $password);

        // Cari data di database (ubah username= menjadi email=)
        $query = mysqli_query($this->koneksi, "SELECT * FROM users WHERE email='$username' AND password='$password'");

        // Jika datanya ketemu (lebih dari 0 baris)
        if (mysqli_num_rows($query) > 0) {
            // Ambil datanya
            $data_user = mysqli_fetch_assoc($query);

            // Mulai sesi dan catat siapa yang sedang login
            session_start();

            // Kita simpan nama dan emailnya dari database agar bisa dipakai nanti
            $_SESSION['nama'] = $data_user['nama'];
            $_SESSION['email'] = $data_user['email'];
            $_SESSION['role'] = $data_user['role'];
            $_SESSION['status'] = "login";

            return true; // Beri sinyal SUKSES
        }
    }
}
?>