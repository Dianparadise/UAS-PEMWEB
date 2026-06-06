# Sistem Informasi Jejak Alumni (SIJA)

SIJA (Sistem Informasi Jejak Alumni) adalah platform berbasis web yang dikembangkan untuk mendigitalisasi proses pendataan, pelacakan karier, dan verifikasi profil alumni di lingkungan Universitas Pembangunan Nasional "Veteran" Jawa Timur.

## 🚀 Fitur Utama
Sistem ini dibangun menggunakan arsitektur MVC (Model-View-Controller) secara *Native* (PHP murni) dengan fitur utama sebagai berikut:

*   **Autentikasi Pengguna:** Sistem *login* dan *register* dengan manajemen sesi (*session-based*) untuk membedakan hak akses Admin, Mahasiswa, dan Alumni.
*   **Katalog Alumni Publik:** Halaman katalog yang dapat diakses publik, dilengkapi dengan fitur pencarian dan filter (berdasarkan tahun kelulusan, angkatan, fakultas, dan jurusan).
*   **Manajemen Profil Alumni:** Alumni dapat mengelola biodata diri, foto profil, dan memantau status validasi akun mereka.
*   **Pengajuan Pembaruan Data (*Update Request*):** Alumni dapat mengajukan perubahan data pekerjaan dan perusahaan dengan melampirkan berkas bukti (PDF/JPG) yang kemudian akan diverifikasi oleh Admin.
*   **Panel Kontrol Admin:** Fitur bagi admin untuk mengelola *user*, validasi pengajuan data (*Approved/Rejected*), serta mengelola data master (Fakultas & Jurusan).

## 🛠 Teknologi yang Digunakan
*   **Bahasa Pemrograman:** PHP 8.x (*Native*), HTML5, CSS3, JavaScript.
*   **Basis Data:** MariaDB / MySQL.
*   **Desain Antarmuka:** CSS (dengan sentuhan *framework* CSS/Tailwind CSS).
*   **Web Server:** Laragon / Xampp (Apache).
*   **Manajemen Database:** HeidiSQL / phpMyAdmin.

## 📂 Struktur Direktori
```text
UAS-PEMWEB/
├── app/
│   ├── controller/  # Logika bisnis dan pemrosesan data
│   └── model/       # Kueri database dan interaksi data
├── asset/           # Berkas CSS dan aset desain
├── config/          # Pengaturan koneksi database
├── DB/              # Berkas SQL database (db_final.sql)
├── public/          # Halaman antarmuka (View)
└── uploads/         # Direktori penyimpanan berkas bukti & foto profil