<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Login extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }

    public function processLogin()
    {
        $usersModel = new UsersModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $usersModel
            ->select('users.*, kaprodi.jurusan')
            ->join('kaprodi', 'kaprodi.user_id = users.user_id', 'left')
            ->where('users.username', $username)
            ->first();

        if ($user && password_verify($password, $user['password'])) {
            // Set session
            session()->set([
                'user_id'      => $user['user_id'],
                'username'     => $user['username'],
                'role'         => $user['role'],
                'nama_lengkap' => $user['nama_lengkap'],
                'isLoggedIn'   => true,
                'jurusan'      => $user['jurusan'] ?? null,
            ]);

            // ✅ Log aktivitas login
            $this->logAktivitas('Login sebagai ' . ucfirst($user['role']));

            // Redirect sesuai role
            switch ($user['role']) {
                case 'mahasiswa':
                    return redirect()->to('/mahasiswa/dashboard');
                case 'dosen':
                    return redirect()->to('/dashboard/dosen');
                case 'kaprodi':
                    return redirect()->to('/dashboard/kaprodi');
                case 'tim_peninjau':
                    return redirect()->to('/peninjau/dashboard');
                default:
                    return redirect()->to('/login')->with('error', 'Role tidak dikenal.');
            }
        }

        return redirect()->to('/login')->with('error', 'Username atau password salah.');
    }

    public function logout()
    {
        // ✅ Log aktivitas logout
        $this->logAktivitasLogout();

        session()->destroy();
        return redirect()->to('/login');
    }
}
