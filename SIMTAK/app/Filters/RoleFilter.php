<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $userRole = strtolower($session->get('role')); // ✅ pastikan lowercase

        // Buat semua role yang diminta juga lowercase
        $allowedRoles = array_map('strtolower', (array) $arguments);

        // Jika belum login atau role tidak sesuai
        if (!$userRole || ($allowedRoles && !in_array($userRole, $allowedRoles))) {
            return redirect()->to('/login')->with('error', 'Akses ditolak');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak diperlukan
    }

    
}
