<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UsersModel;

class Dashboard extends Controller
{
    public function index()
    {
        $usersModel = new UsersModel();

        // Contoh hitung jumlah
        $data['jumlahMahasiswa'] = $usersModel->where('role', 'Mahasiswa')->countAllResults();
        $data['jumlahDosen'] = $usersModel->where('role', 'Dosen')->countAllResults();

        return view('dashboard/index', $data);
    }
}
