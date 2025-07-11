<?php

namespace App\Controllers;

use App\Models\UsersModel;
use CodeIgniter\Controller;

class Users extends Controller
{
    public function listMahasiswa()
    {
        $usersModel = new UsersModel();
        $mahasiswa = $usersModel->where('role', 'Mahasiswa')->findAll();

        return view('users/mahasiswa', [
            'title' => 'Daftar Mahasiswa',
            'users' => $mahasiswa
        ]);
    }

    public function listDosen()
    {
        $usersModel = new UsersModel();
        $dosen = $usersModel->where('role', 'Dosen')->findAll();

        return view('users/dosen', [
            'title' => 'Daftar Dosen',
            'users' => $dosen
        ]);
    }

    public function reset_password()
    {
        return view('users/reset_password_form');
    }

    public function process_reset()
    {
        $email = $this->request->getPost('email');

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->to('/users/reset-password')->with('error', 'Email tidak valid!');
        }

        $usersModel = new UsersModel();
        $user = $usersModel->where('email', $email)->first();

        if (!$user) {
            return redirect()->to('/users/reset-password')->with('error', 'Email tidak ditemukan!');
        }

        // Simulasi token
        $token = bin2hex(random_bytes(32));

        // Simpan user_id ke session sementara untuk pencatatan log
        session()->set('user_id', $user['user_id']);
        $this->logAktivitas('Mengajukan reset password');

        return redirect()->to('/users/reset-password')->with('success', 'Link reset telah dikirim ke email Anda!');
    }

public function log()
{
    $db = \Config\Database::connect();
    $builder = $db->table('log_aktivitas');
    $builder->select('log_aktivitas.*, users.nama_lengkap');
    $builder->join('users', 'users.user_id = log_aktivitas.user_id', 'left');
    $builder->orderBy('waktu_login', 'DESC'); // ✅ benar

    $query = $builder->get();

    $data['title'] = 'Log Aktivitas';
    $data['log'] = $query->getResultArray();

    return view('users/log', $data);
}


    public function profile()
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return redirect()->to('/login');
        }

        $usersModel = new UsersModel();
        $user = $usersModel->find($userId);

        if (!$user) {
            return redirect()->to('/login');
        }

        return view('users/profile', ['user' => $user, 'title' => 'Profil Saya']);
    }

    public function setting()
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return redirect()->to('/login');
        }

        $usersModel = new \App\Models\UsersModel();
        $user = $usersModel->find($userId);

        return view('users/setting', [
            'title' => 'Pengaturan Akun',
            'user'  => $user
        ]);
    }

    public function updateSetting()
    {
        $userModel = new \App\Models\UsersModel();
        $userId = session()->get('user_id');

        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'email'        => $this->request->getPost('email'),
        ];

        $passwordBaru = $this->request->getPost('password_baru');
        $konfirmasi   = $this->request->getPost('konfirmasi_password');

        if (!empty($passwordBaru)) {
            if ($passwordBaru !== $konfirmasi) {
                return redirect()->back()->with('error', 'Password baru dan konfirmasi tidak cocok.');
            }
            $data['password'] = password_hash($passwordBaru, PASSWORD_DEFAULT);
        }

        $userModel->update($userId, $data);
        $this->logAktivitas('Memperbarui pengaturan akun');

        return redirect()->to('/setting')->with('success', 'Pengaturan berhasil diperbarui.');
    }

    public function register()
    {
        $usersModel = new UsersModel();
        $mahasiswaModel = new \App\Models\MahasiswaModel();

        $nama       = $this->request->getPost('nama_lengkap');
        $username   = $this->request->getPost('username');
        $email      = $this->request->getPost('email');
        $role       = strtolower($this->request->getPost('role'));
        $tglLahir   = $this->request->getPost('tanggal_lahir');

        if ($usersModel->where('username', $username)->first()) {
            return redirect()->back()->withInput()->with('error', 'Username/NIM sudah digunakan.');
        }

        $passwordRaw  = date('dmY', strtotime($tglLahir));
        $passwordHash = password_hash($passwordRaw, PASSWORD_DEFAULT);

        $user_id = $usersModel->insert([
            'nama_lengkap' => $nama,
            'username'     => $username,
            'password'     => $passwordHash,
            'email'        => $email,
            'role'         => $role,
            'is_active'    => 1,
            'created_at'   => date('Y-m-d H:i:s'),
        ]);

        if ($role === 'mahasiswa') {
            $mahasiswaModel->insert([
                'user_id' => $user_id,
                'nim'     => $username,
                'nama'    => $nama,
                'email'   => $email,
                'jurusan' => 'Teknik Informatika',
                'angkatan'=> date('Y')
            ]);
        }

        session()->set('user_id', $user_id); // untuk log
        $this->logAktivitas('Registrasi akun baru');

        return redirect()->back()->with('success', 'Akun berhasil didaftarkan!');
    }

    // 📝 Fungsi untuk mencatat log aktivitas
private function logAktivitas($aktivitas)
{
    $logModel = new \App\Models\LogModel();

    $logModel->insert([
        'user_id'   => session()->get('user_id') ?? 0,
        'aktivitas' => $aktivitas,
        'waktu'     => date('Y-m-d H:i:s')
    ]);
}

}
