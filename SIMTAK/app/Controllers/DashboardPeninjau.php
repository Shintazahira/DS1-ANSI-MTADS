<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class DashboardPeninjau extends BaseController
{
    public function index()
    {
        return view('dashboard/peninjau'); // View ini akan ditampilkan
    }
}
