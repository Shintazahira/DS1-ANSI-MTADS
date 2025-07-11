<?php

namespace App\Controllers;

use App\Models\SidangModel;
use App\Models\SeminarModel;
use CodeIgniter\Controller;

class Sidang extends BaseController
{
    protected $sidangModel;

    public function __construct()
    {
        $this->sidangModel = new SidangModel();
    }

    // ===============================
    // KAPRODI SECTION (Full CRUD)
    // ===============================

    public function indexKaprodi()
    {
        if (session()->get('role') !== 'kaprodi') return redirect()->back();
        $data['sidang'] = $this->sidangModel->getSidangWithSeminar();
        return view('sidang/kaprodi_index', $data);
    }

public function create()
{
    if (session()->get('role') !== 'kaprodi') return redirect()->back();

    $seminarModel = new SeminarModel();

    $data['seminar'] = $seminarModel
        ->select('seminar.*, users.nama_lengkap')
        ->join('bimbingan', 'bimbingan.bimbingan_id = seminar.bimbingan_id')
        ->join('mahasiswa', 'mahasiswa.mahasiswa_id = bimbingan.mahasiswa_id')
        ->join('users', 'users.user_id = mahasiswa.user_id')
        ->findAll();

    return view('sidang/create', $data);
}


    public function store()
    {
        if (session()->get('role') !== 'kaprodi') return redirect()->back();

        $this->sidangModel->save($this->request->getPost());
        return redirect()->to('/sidang/kaprodi')->with('success', 'Sidang berhasil ditambahkan.');
    }

    public function edit($id)
    {
        if (session()->get('role') !== 'kaprodi') return redirect()->back();

        $data['sidang'] = $this->sidangModel->find($id);
        return view('sidang/edit', $data);
    }

    public function update($id)
    {
        if (session()->get('role') !== 'kaprodi') return redirect()->back();

        $this->sidangModel->update($id, $this->request->getPost());
        return redirect()->to('/sidang/kaprodi')->with('success', 'Sidang berhasil diperbarui.');
    }

    // ===============================
    // MAHASISWA SECTION (View Only)
    // ===============================

public function viewMahasiswa()
{
    $userId = session()->get('user_id');
    $db = \Config\Database::connect();

    $builder = $db->table('sidang');
    $builder->select('sidang.*, seminar.judul_seminar, users.nama_lengkap');
    $builder->join('seminar', 'seminar.seminar_id = sidang.seminar_id');
    $builder->join('bimbingan', 'bimbingan.bimbingan_id = seminar.bimbingan_id');
    $builder->join('mahasiswa', 'mahasiswa.mahasiswa_id = bimbingan.mahasiswa_id');
    $builder->join('users', 'users.user_id = mahasiswa.user_id');
    $builder->where('users.user_id', $userId);

    $data['sidang'] = $builder->get()->getRowArray();

    return view('sidang/mahasiswa_view', $data);
}


    // ===============================
    // DOSEN SECTION (View Only)
    // ===============================

    public function viewDosen()
    {
        $data['sidang'] = $this->sidangModel->getSidangWithSeminar();
        return view('sidang/dosen_view', $data);
    }
}
