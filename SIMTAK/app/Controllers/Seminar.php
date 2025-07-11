<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SeminarModel;
use App\Models\BimbinganModel;

class Seminar extends BaseController
{
    protected $seminarModel;

    public function __construct()
    {
        $this->seminarModel = new SeminarModel();
    }

public function index()
{
    $userRole = session()->get('role');
    $layout = ($userRole === 'dosen') ? 'layoutsdosen/main' : 'layoutskaprodi/main';

    $seminars = $this->seminarModel
        ->select('seminar.*, mahasiswa.mahasiswa_id, users.nama_lengkap, seminar.nilai_presentasi, seminar.nilai_laporan, seminar.nilai_tanya_jawab')
        ->join('bimbingan', 'bimbingan.bimbingan_id = seminar.bimbingan_id')
        ->join('mahasiswa', 'mahasiswa.mahasiswa_id = bimbingan.mahasiswa_id')
        ->join('users', 'users.user_id = mahasiswa.user_id');

    // Jika dosen, hanya tampilkan seminar dari mahasiswa bimbingannya
if ($userRole === 'dosen') {
    $seminars = $seminars->where('seminar.dosen_id', session()->get('user_id'));
}

    $seminars = $seminars->findAll();

    return view('seminar/index', [
        'title'    => 'Manajemen Seminar',
        'seminars' => $seminars,
        'layout'   => $layout // ⬅️ ini yang penting!
    ]);
}


public function tambah()
{
    $db = \Config\Database::connect();

    // Ambil data mahasiswa dari bimbingan
    $builder = $db->table('bimbingan');
    $builder->select('bimbingan.bimbingan_id, mahasiswa.mahasiswa_id, users.nama_lengkap');
    $builder->join('mahasiswa', 'mahasiswa.mahasiswa_id = bimbingan.mahasiswa_id');
    $builder->join('users', 'users.user_id = mahasiswa.user_id');
    $builder->orderBy('users.nama_lengkap', 'ASC');
    $mahasiswa = $builder->get()->getResultArray();

    // 🔥 Tambahkan ini: ambil semua dosen dari tabel users
    $dosen = $db->table('users')
        ->select('user_id, nama_lengkap')
        ->where('role', 'dosen')
        ->orderBy('nama_lengkap', 'ASC')
        ->get()
        ->getResultArray();

    // DETEKSI LAYOUT BERDASARKAN ROLE
    $layout = match (session()->get('role')) {
        'dosen'    => 'layoutsdosen/main',
        'kaprodi'  => 'layoutskaprodi/main',
        default    => 'layouts/main'
    };

    return view('seminar/tambah', [
        'mahasiswa' => $mahasiswa,
        'dosen'     => $dosen,     // ⬅️ kirim ke view
        'layout'    => $layout
    ]);
}


    public function simpan()
    {
        if (!$this->validate([
            'bimbingan_id'     => 'required|numeric',
            'dosen_id'         => 'required|numeric',
            'judul_seminar'    => 'required',
            'abstrak'          => 'required',
            'tanggal_seminar'  => 'required',
            'tempat'           => 'required'
        ])) {
            return redirect()->back()->withInput()->with('error', 'Data tidak lengkap!');
        }

        $this->seminarModel->save([
            'bimbingan_id'     => $this->request->getPost('bimbingan_id'),
            'dosen_id'         => $this->request->getPost('dosen_id'),
            'judul_seminar'    => $this->request->getPost('judul_seminar'),
            'abstrak'          => $this->request->getPost('abstrak'),
            'tanggal_seminar'  => $this->request->getPost('tanggal_seminar'),
            'tempat'           => $this->request->getPost('tempat'),
            'status'           => 'diajukan'
        ]);

        return redirect()->to('/seminar')->with('success', 'Seminar berhasil diajukan.');
    }

    public function setujui($id)
    {
        $this->seminarModel->update($id, ['status' => 'disetujui']);
        return redirect()->to('/seminar')->with('success', 'Seminar telah disetujui.');
    }

    public function hapus($id)
    {
        $this->seminarModel->delete($id);
        return redirect()->to('/seminar')->with('success', 'Data seminar berhasil dihapus.');
    }

public function detailMahasiswa()
{
    $userId = session()->get('user_id');

    $seminars = $this->seminarModel
        ->select('seminar.*, mahasiswa.mahasiswa_id, mahasiswa.user_id AS mahasiswa_user_id, 
                  mahasiswa.nama AS nama_mhs, 
                  dosen.user_id AS dosen_user_id, dosen.nama_lengkap AS nama_dosen, 
                  seminar.nilai_presentasi, seminar.nilai_laporan, seminar.nilai_tanya_jawab, 
                  seminar.komentar_dosen')
        ->join('bimbingan', 'bimbingan.bimbingan_id = seminar.bimbingan_id')
        ->join('mahasiswa', 'mahasiswa.mahasiswa_id = bimbingan.mahasiswa_id')
        ->join('users AS mahasiswa_user', 'mahasiswa_user.user_id = mahasiswa.user_id')
        ->join('users AS dosen', 'dosen.user_id = bimbingan.dosen_id') // JOIN dosen pembimbing
        ->where('mahasiswa_user.user_id', $userId)
        ->findAll();

    return view('mahasiswa/seminar_detail', [
        'seminars' => $seminars
    ]);
}


    public function formNilai($id)
{
    $seminar = $this->seminarModel
        ->select('seminar.*, mahasiswa.nama, mahasiswa.mahasiswa_id')
        ->join('bimbingan', 'bimbingan.bimbingan_id = seminar.bimbingan_id')
        ->join('mahasiswa', 'mahasiswa.mahasiswa_id = bimbingan.mahasiswa_id')
        ->find($id);

    if (!$seminar) {
        return redirect()->to('/seminar')->with('error', 'Seminar tidak ditemukan.');
    }

    return view('seminar/form_nilai', ['seminar' => $seminar]);
}

public function simpanNilai($id)
{
    $this->seminarModel->update($id, [
        'nilai_presentasi'   => $this->request->getPost('nilai_presentasi'),
        'nilai_laporan'      => $this->request->getPost('nilai_laporan'),
        'nilai_tanya_jawab'  => $this->request->getPost('nilai_tanya_jawab'),
        'komentar_dosen'     => $this->request->getPost('komentar_dosen'),
        'dinilai_oleh'       => session()->get('user_id'),
        'status'             => 'selesai'
    ]);

    return redirect()->to('/seminar')->with('success', 'Nilai seminar berhasil disimpan.');
}

}
