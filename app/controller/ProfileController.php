<?php

require_once __DIR__ . '/../model/UserModel.php';
require_once __DIR__ . '/../model/AlumniModel.php';
require_once __DIR__ . '/../model/UpdateRequestModel.php';

class ProfileController {

    public function index($email) {

       
        $data_user = UserModel::getByEmail($email);

        $user_id = $data_user['id'];

        $data_profil = AlumniProfileModel::getByUserId($user_id);
       
        $profil_id = $data_profil['id'] ?? 0;

        $queryRequest = UpdateRequestModel::getByAlumniId($profil_id);

        return [
            'user' => $data_user,
            'profil' => $data_profil,
            'request' => $queryRequest
        ];
    }
}