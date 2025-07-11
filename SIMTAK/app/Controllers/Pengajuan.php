<?php
namespace App\Controllers;

use App\Models\PengajuanModel;
use CodeIgniter\Controller;
use App\Models\DosenModel;
use App\Models\BimbinganModel;
use Config\Database; 

class Pengajuan extends Controller
{
    public function index()
{
    $userId = session()->get('user_id');

    $mahasiswa = (new \App\Models\MahasiswaModel())
        ->where('user_id', $userId)
        ->first();

    if (!$mahasiswa) {
        return redirect()->to('/login')->with('error', 'Mahasiswa tidak ditemukan.');
    }

    $pengajuan = (new \App\Models\PengajuanModel())
        ->where('mahasiswa_id', $mahasiswa['mahasiswa_id'])
        ->orderBy('created_at', 'DESC')
        ->findAll();

    return view('pengajuan/index', ['pengajuan' => $pengajuan]);
}



public function create()
{
    $userId = session()->get('user_id');

    $mahasiswa = (new \App\Models\MahasiswaModel())
        ->where('user_id', $userId)
        ->first();

    if (!$mahasiswa) {
        return redirect()->to('/login')->with('error', 'Mahasiswa tidak ditemukan.');
    }

    $pengajuan = (new \App\Models\PengajuanModel())
        ->where('mahasiswa_id', $mahasiswa['mahasiswa_id'])
        ->orderBy('created_at', 'DESC')
        ->first();

    return view('pengajuan/create', [
        'pengajuan' => $pengajuan
    ]);
}


    public function store()
{
    $file = $this->request->getFile('file_proposal');
    $filename = null;

    if ($file && $file->isValid()) {
        $filename = $file->getRandomName();
        $file->move('uploads/proposal', $filename);
    }

    // Ambil user_id dari session
    $userId = session()->get('user_id');

    // Cari mahasiswa_id berdasarkan user_id
    $mahasiswa = (new \App\Models\MahasiswaModel())->where('user_id', $userId)->first();

    if (!$mahasiswa) {
        return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
    }

    // Simpan pengajuan
    (new PengajuanModel())->insert([
        'mahasiswa_id' => $mahasiswa['mahasiswa_id'],
        'judul' => $this->request->getPost('judul'),
        'deskripsi' => $this->request->getPost('deskripsi'),
        'file_proposal' => $filename
    ]);

    return redirect()->to('/pengajuan')->with('success', 'Pengajuan berhasil dikirim.');
}


    public function kelola()
{
    if (session()->get('role') !== 'kaprodi') {
        return redirect()->to('/dashboard');
    }

    $model = new \App\Models\PengajuanModel();
    $pengajuan = $model
        ->join('mahasiswa', 'mahasiswa.mahasiswa_id = pengajuan.mahasiswa_id') // ✅
        ->select('pengajuan.*, mahasiswa.nama AS nama_mahasiswa')
        ->orderBy('pengajuan.created_at', 'DESC')
        ->findAll();

    return view('pengajuan/kelola', ['pengajuan' => $pengajuan]);
}


public function setuju($id)
{
    $model = new PengajuanModel();
    $pengajuan = $model->asArray()->find($id);

    if (!$pengajuan || !isset($pengajuan['id'])) {
        return redirect()->to('/pengajuan/kelola')->with('error', 'Data pengajuan tidak ditemukan.');
    }

    // JOIN ke tabel users untuk ambil nama dosen
    $db = Database::connect();
    $dosen = $db->table('dosen')
        ->join('users', 'users.user_id = dosen.user_id')
        ->select('dosen.dosen_id, users.nama_lengkap')
        ->get()->getResultArray();

    $data = [
        'pengajuan' => $pengajuan,
        'dosen'     => $dosen
    ];

    return view('pengajuan/setuju', $data);
}


public function simpanSetuju()
{
    $pengajuan_id = $this->request->getPost('pengajuan_id');
    $dosen_id = $this->request->getPost('dosen_id');

    $pengajuan = (new PengajuanModel())->find($pengajuan_id);

    // update pengajuan status
    (new PengajuanModel())->update($pengajuan_id, ['status' => 'disetujui']);

    // insert ke tabel bimbingan
    (new BimbinganModel())->insert([
        'mahasiswa_id' => $pengajuan['mahasiswa_id'],
        'dosen_id' => $dosen_id,
        'topik_id' => null,
        'tanggal_mulai' => date('Y-m-d'),
        'status' => 'aktif',
    ]);

    return redirect()->to('/pengajuan/kelola')->with('success', 'Pengajuan disetujui & dosen ditetapkan');
}

public function tolak($id)
{
    return view('pengajuan/tolak', ['id' => $id]);
}

public function simpanTolak()
{
    $id = $this->request->getPost('pengajuan_id');
    $alasan = $this->request->getPost('alasan_penolakan');

    (new PengajuanModel())->update($id, [
        'status' => 'ditolak',
        'alasan_penolakan' => $alasan
    ]);

    return redirect()->to('/pengajuan/kelola')->with('success', 'Pengajuan ditolak.');
}

}
