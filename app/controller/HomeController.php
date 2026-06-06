<?php
require_once __DIR__ . '/../model/AlumniModel.php';

class HomeController
{
    public function index($search, $tahun, $angkatan, $jurusan, $fakultas, $page = 1)
    {
        $limit = 10; 
        $offset = ($page - 1) * $limit; 

        $total_rows = AlumniHomeModel::getTotalRows($search, $tahun, $angkatan, $jurusan, $fakultas);

        $total_pages = ceil($total_rows / $limit);
        $data = AlumniHomeModel::getDataPaginated($search, $tahun, $angkatan, $jurusan, $fakultas, $limit, $offset);

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
