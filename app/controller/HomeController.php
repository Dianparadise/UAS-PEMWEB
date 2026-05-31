<?php

require_once __DIR__ . '/../model/AlumniModel.php';

class HomeController {

    public function index() {

        $queryTerbaru = AlumniHomeModel::getTerbaru();

        return $queryTerbaru;
    }
}