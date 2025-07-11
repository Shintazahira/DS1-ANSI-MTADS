<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Models\BimbinganModel;
use App\Models\MahasiswaModel;
use App\Models\TopikModel;
use App\Models\DosenModel;

class Bimbingan extends BaseController
{
public function index()
{
    $bimbinganModel = new BimbinganModel();
    $mahasiswaModel = new MahasiswaModel();
    $userModel = new UsersModel();
    $dosenModel = new DosenModel();

    $data['title'] = 'Mahasiswa Bimbingan';
    $data['bimbingan'] = $bimbinganModel
        ->select('bimbingan.*, u1.nama_lengkap as nama_mahasiswa, u2.nama_lengkap as nama_dosen')
        ->join('mahasiswa', 'mahasiswa.mahasiswa_id = bimbingan.mahasiswa_id')
        ->join('users u1', 'u1.user_id = mahasiswa.user_id')

        ->join('dosen', 'dosen.dosen_id = bimbingan.dosen_id')
        ->join('users u2', 'u2.user_id = dosen.user_id')
        ->findAll();

    // Ambil daftar mahasiswa dan dosen
    $data['mahasiswa'] = $mahasiswaModel
        ->select('mahasiswa.mahasiswa_id, users.nama_lengkap')
        ->join('users', 'users.user_id = mahasiswa.user_id')
        ->findAll();

    $data['dosen'] = $dosenModel
        ->select('dosen.dosen_id, users.nama_lengkap')
        ->join('users', 'users.user_id = dosen.user_id')
        ->findAll();

    return view('bimbingan/index', $data);
}


    public function tambah()
    {
        $mahasiswaModel = new MahasiswaModel();
        $userModel = new UsersModel();
        $topikModel = new TopikModel();

        $data = [
            'title' => 'Tambah Bimbingan',
            'mahasiswa' => $mahasiswaModel
                ->select('mahasiswa.*, users.nama_lengkap')
                ->join('users', 'users.user_id = mahasiswa.user_id')
                ->findAll(),
            'dosen' => $userModel->where('role', 'dosen')->findAll(),
            'topik' => $topikModel->findAll(),
        ];

        return view('bimbingan/tambah', $data);
    }

public function simpan()
{
    $bimbinganModel = new \App\Models\BimbinganModel();

    $data = [
        'mahasiswa_id'   => $this->request->getPost('mahasiswa_id'),
        'dosen_id'       => $this->request->getPost('dosen_id'),
        'tanggal_mulai'  => $this->request->getPost('tanggal_mulai'),
        'status'         => 'aktif'
    ];

    // Validasi minimal
    if (empty($data['mahasiswa_id']) || empty($data['dosen_id']) || empty($data['tanggal_mulai'])) {
        return redirect()->back()->withInput()->with('error', 'Semua field wajib diisi.');
    }

    $bimbinganModel->insert($data);
    return redirect()->to('/bimbingan')->with('success', 'Mahasiswa berhasil ditambahkan ke daftar bimbingan.');
}


    public function bimbinganDosen()
    {

        $bimbinganModel = new BimbinganModel();
        $userId = session()->get('user_id');

        $dosen = (new DosenModel())->where('user_id', $userId)->first();

        if (!$dosen) {
            session()->destroy();
            return redirect()->to('/login')->with('error', 'Dosen tidak ditemukan.');
        }

        $data['title'] = 'Mahasiswa Bimbingan Saya';
        $data['bimbingan'] = $bimbinganModel
            ->select('bimbingan.*, u1.nama_lengkap as nama_mahasiswa, topik.judul_topik as topik')
            ->join('users u1', 'u1.user_id = bimbingan.mahasiswa_id')
            ->join('topik', 'topik.topik_id = bimbingan.topik_id', 'left')
            ->where('bimbingan.dosen_id', $dosen['dosen_id'])
            ->findAll();

        return view('bimbingan/dosen_list', $data);
    }

    public function indexMahasiswa()
    {
        $bimbinganModel = new BimbinganModel();
        $userId = session()->get('user_id');

        $data['title'] = 'Jadwal Bimbingan Saya';
        $data['bimbingan'] = $bimbinganModel
            ->select('bimbingan.*, u2.nama_lengkap as nama_dosen, topik.judul_topik as topik')
            ->join('dosen', 'dosen.dosen_id = bimbingan.dosen_id')
            ->join('users u2', 'u2.user_id = dosen.user_id')
            ->join('topik', 'topik.topik_id = bimbingan.topik_id', 'left')
            ->where('bimbingan.mahasiswa_id', $userId)
            ->findAll();

        return view('bimbingan/mahasiswa', $data);
    }

    public function edit($id)
    {
        $bimbinganModel = new BimbinganModel();
        $mahasiswaModel = new MahasiswaModel();
        $userModel = new UsersModel();
        $topikModel = new TopikModel();

        $data['bimbingan'] = $bimbinganModel->find($id);
        $data['mahasiswa'] = $mahasiswaModel
            ->select('mahasiswa.*, users.nama_lengkap')
            ->join('users', 'users.user_id = mahasiswa.user_id')
            ->findAll();
        $data['dosen'] = $userModel->where('role', 'dosen')->findAll();
        $data['topik'] = $topikModel->findAll();

        return view('bimbingan/edit', $data);
    }

    public function update($id)
    {
        $bimbinganModel = new BimbinganModel();
        $dosenModel = new DosenModel();

        $userDosenId = $this->request->getPost('dosen_id');
        $dosen = $dosenModel->where('user_id', $userDosenId)->first();

        if (!$dosen) {
            return redirect()->back()->with('error', 'Dosen tidak ditemukan di tabel dosen.');
        }

        $data = [
            'mahasiswa_id'   => $this->request->getPost('mahasiswa_id'),
            'dosen_id'       => $dosen['dosen_id'],
            'topik_id'       => $this->request->getPost('topik_id'),
            'tanggal_mulai'  => $this->request->getPost('tanggal_mulai'),
            'status'         => $this->request->getPost('status'),
            'catatan'        => $this->request->getPost('catatan')
        ];

        $bimbinganModel->update($id, $data);
        return redirect()->to('/bimbingan')->with('success', 'Data bimbingan berhasil diperbarui');
    }
}
