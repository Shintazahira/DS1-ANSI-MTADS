<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\LogModel; // ⬅️ INI HARUS ADA!

abstract class BaseController extends Controller
{
    protected $request;

    protected $helpers = [];

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
    }

    // ✅ Catat Login
    protected function logAktivitas(string $aktivitas)
    {
        $logModel = new LogModel();

        $logModel->insert([
            'user_id'      => session()->get('user_id'),
            'aktivitas'    => $aktivitas,
            'waktu_login'  => date('Y-m-d H:i:s'),
            'waktu_logout' => null
        ]);
    }

    // ✅ Catat Logout
    protected function logAktivitasLogout()
    {
        $logModel = new LogModel();

        $lastLog = $logModel
            ->where('user_id', session()->get('user_id'))
            ->where('waktu_logout', null)
            ->orderBy('waktu_login', 'DESC')
            ->first();

        if ($lastLog) {
            $logModel->update($lastLog['id'], [
                'waktu_logout' => date('Y-m-d H:i:s')
            ]);
        }
    }
}
