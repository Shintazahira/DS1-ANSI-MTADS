<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BimbinganModel;

class DashboardDosen extends BaseController
{
    public function index()
    {
        $bimbinganModel = new BimbinganModel();
        $userId = session()->get('user_id'); // pastikan ini diset saat login

        $data = [
            'title' => 'Dashboard Dosen',
            'jumlahBimbingan' => $bimbinganModel->where('dosen_id', $userId)->countAllResults(),
            // kamu bisa tambahkan statistik lainnya di sini nanti
        ];

        return view('dashboard/dosen', $data);
    }

    
}
