<?php

class AuthController
{
    // Variabel untuk menyimpan jalur ke database
    private $koneksi;

    // Method  saat Controller dipanggil
    public function __construct($db_koneksi)
    {
        $this->koneksi = $db_koneksi;
    }

    // Method  mengecek login
    public function login($username, $password)
    {
        // Keamanan dasar: mencegah SQL Injection
        $username = mysqli_real_escape_string($this->koneksi, $username);
        $password = mysqli_real_escape_string($this->koneksi, $password);

    
        $query = mysqli_query($this->koneksi, "SELECT * FROM users WHERE email='$username' AND password='$password'");

    
        if (mysqli_num_rows($query) > 0) {
            
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