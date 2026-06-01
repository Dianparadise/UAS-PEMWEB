<?php

require_once __DIR__ . '/../model/AlumniModel.php';

class HomeController
{

    public function index(
    $search,
    $tahun,
    $angkatan,
    $jurusan,
    $fakultas
) {

    // Kalau semua kosong
    if (
        trim($search) == '' &&
        trim($tahun) == '' &&
        trim($angkatan) == '' &&
        trim($jurusan) == '' &&
        trim($fakultas) == ''
    ) {

        return AlumniHomeModel::getTerbaru();
    }

    // Kalau ada filter/search
    return AlumniHomeModel::filter(
        $search,
        $tahun,
        $angkatan,
        $jurusan,
        $fakultas
    );
}
public function detail($user_id)
    {

        return AlumniHomeModel::getDetail($user_id);
    }
}
