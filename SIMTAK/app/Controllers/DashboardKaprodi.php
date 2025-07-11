<?php

namespace App\Controllers;

use App\Models\BimbinganModel;
use App\Models\PengajuanModel;

class DashboardKaprodi extends BaseController
{
    public function index()
    {
        $jurusan = session()->get('jurusan');

        if (!$jurusan) {
            return redirect()->to('/login')->with('error', 'Jurusan belum diatur di session.');
        }

        $bimbinganModel = new BimbinganModel();

        $jumlahBimbingan = $bimbinganModel
            ->join('mahasiswa', 'mahasiswa.mahasiswa_id = bimbingan.mahasiswa_id')
            ->where('mahasiswa.jurusan', $jurusan)
            ->where('bimbingan.status', 'aktif')
            ->countAllResults();

        // Statistik skripsi berdasarkan status
        $pengajuanModel = new PengajuanModel();
        $statusCounts = $pengajuanModel
            ->select('pengajuan.status, COUNT(*) as jumlah')
            ->join('mahasiswa', 'mahasiswa.mahasiswa_id = pengajuan.mahasiswa_id')
            ->where('mahasiswa.jurusan', $jurusan)
            ->groupBy('pengajuan.status')
            ->findAll();

        $chartLabels = [];
        $chartData   = [];

        foreach ($statusCounts as $row) {
            $chartLabels[] = ucfirst($row['status'] ?? 'Tidak Diketahui');
            $chartData[]   = (int) $row['jumlah'];
        }

        return view('dashboard/kaprodi', [
            'jumlahBimbingan' => $jumlahBimbingan,
            'jumlahSeminar'   => 0,
            'chartLabels'     => json_encode($chartLabels),
            'chartData'       => json_encode($chartData),
        ]);
    }
}
