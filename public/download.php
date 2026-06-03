<?php
session_start();

// Pastikan hanya admin yang bisa melihat dokumen
if (!isset($_SESSION['status']) || $_SESSION['role'] !== 'admin') {
    die("Akses ditolak.");
}

if (isset($_GET['file'])) {
    // basename() untuk mencegah user jahat membuka file di luar folder uploads (Directory Traversal)
    $file = basename($_GET['file']);
    $path = '../uploads/Bukti/' . $file;

    // Periksa apakah fail fisik benar-benar ada di folder uploads
    if (file_exists($path)) {
        // Ambil ekstensi file
        $ekstensi = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        // Tentukan tipe konten (MIME Type) agar dikenali browser
        switch ($ekstensi) {
            case 'pdf':
                $tipe_konten = 'application/pdf';
                break;
            case 'png':
                $tipe_konten = 'image/png';
                break;
            case 'jpg':
            case 'jpeg':
                $tipe_konten = 'image/jpeg';
                break;
            default:
                $tipe_konten = 'application/octet-stream'; // Default jika format tidak dikenali
        }

        // KUNCI: Bersihkan output buffer (mencegah file korup jika ada spasi tak terlihat di file PHP)
        if (ob_get_level()) {
            ob_end_clean();
        }

        // Beritahu browser tipe filenya, dan minta untuk "inline" (tampilkan di tab), bukan "attachment" (download)
        header('Content-Type: ' . $tipe_konten);
        header('Content-Disposition: inline; filename="' . $file . '"');
        header('Content-Length: ' . filesize($path));
        header('Accept-Ranges: bytes');

        // Baca dan tampilkan file
        readfile($path);
        exit;
    } else {
        echo "<script>alert('File bukti tidak ditemukan di server.'); window.location='admin_validasi.php';</script>";
    }
}
