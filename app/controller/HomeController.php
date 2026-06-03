<?php
require_once __DIR__ . '/../model/AlumniModel.php';

class HomeController
{
    public function index($search, $tahun, $angkatan, $jurusan, $fakultas, $page = 1)
    {
        $limit = 10; // Kita tampilkan 10 alumni per halaman
        $offset = ($page - 1) * $limit; // Rumus mencari titik awal data

        // Dapatkan total baris data yang cocok dengan filter
        $total_rows = AlumniHomeModel::getTotalRows($search, $tahun, $angkatan, $jurusan, $fakultas);

        // Hitung total halaman (dibulatkan ke atas pakai ceil)
        $total_pages = ceil($total_rows / $limit);

        // Ambil data yang sudah dipotong (di-limit)
        $data = AlumniHomeModel::getDataPaginated($search, $tahun, $angkatan, $jurusan, $fakultas, $limit, $offset);

        // Kembalikan banyak data sekaligus menggunakan array
        return [
            'data' => $data,
            'total_pages' => $total_pages,
            'current_page' => $page
        ];
    }

    public function detail($user_id)
    {
        return AlumniHomeModel::getDetail($user_id);
    }
}
