<?php

require_once __DIR__ . '/../model/AlumniModel.php';

class HomeController
{

    public function index()
    {

        $queryTerbaru = AlumniHomeModel::getTerbaru();

        return $queryTerbaru;
    }

    public function detail($user_id)
    {

        $queryDetail = AlumniHomeModel::getDetail($user_id);

        return $queryDetail;
    }
}
