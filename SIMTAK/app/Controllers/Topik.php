<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TopikModel;

class Topik extends BaseController
{
    public function index()
    {
        $topikModel = new TopikModel();

        $data = [
            'title' => 'Daftar Topik Skripsi',
            'topik' => $topikModel->findAll()
        ];

        return view('topik/index', $data);
    }
}
