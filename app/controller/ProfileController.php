<?php

require_once __DIR__ . '/../model/UserModel.php';
require_once __DIR__ . '/../model/AlumniModel.php';
require_once __DIR__ . '/../model/UpdateRequestModel.php';

class ProfileController {

    public function index($email) {

        // Ambil data user login
        $data_user = UserModel::getByEmail($email);

        // Ambil id user
        $user_id = $data_user['id'];

        // Ambil biodata alumni
        $data_profil = AlumniProfileModel::getByUserId($user_id);

        // Cek apakah profil ada
        $profil_id = $data_profil['id'] ?? 0;

        // Ambil riwayat pengajuan
        $queryRequest = UpdateRequestModel::getByAlumniId($profil_id);

        // Kirim semua data
        return [
            'user' => $data_user,
            'profil' => $data_profil,
            'request' => $queryRequest
        ];
    }
}