<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Models\DosenModel;

class Dosen extends BaseController
{
    public function index()
    {
        $dosenModel = new DosenModel();
        $data['title'] = 'Daftar Profil Dosen';
        $data['dosen'] = $dosenModel
    ->select('dosen.*, COALESCE(users.nama_lengkap, dosen.nama_lengkap) AS nama_lengkap')
    ->join('users', 'users.user_id = dosen.user_id', 'left') // <-- ubah ke LEFT JOIN
    ->findAll();

        return view('dosen/index', $data);
    }

public function tambah()
{
    // Cek role user yang login
    $role = session()->get('role');
    if (!in_array($role, ['admin', 'kaprodi'])) {
        return redirect()->back()->with('error', 'Akses ditolak');
    }

    $usersModel = new UsersModel();
    $data['title'] = 'Tambah Profil Dosen';
    $data['dosen_users'] = $usersModel
        ->where('role', 'dosen')
        ->whereNotIn('user_id', function($builder) {
            return $builder->select('user_id')->from('dosen');
        })->findAll();

    return view('dosen/tambah', $data);
}


    public function simpan()
    {
        $dosenModel = new DosenModel();

$dosenModel->insert([
    'nama_lengkap' => $this->request->getPost('nama_lengkap'), // ✅ wajib ada
    'user_id' => $this->request->getPost('user_id'), // optional, boleh NULL
    'nidn' => $this->request->getPost('nidn'),
    'jabatan_akademik' => $this->request->getPost('jabatan_akademik'),
    'bidang_keahlian' => $this->request->getPost('bidang_keahlian'),
]);


        return redirect()->to('/dosen')->with('success', 'Profil dosen berhasil ditambahkan.');
    }
}
