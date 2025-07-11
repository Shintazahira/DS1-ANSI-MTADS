<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SeminarModel;

class DashboardMahasiswa extends BaseController
{
    public function index()
{
    $userId = session()->get('user_id');
    $db = \Config\Database::connect();

    // Ambil data seminar mahasiswa
    $seminarModel = new SeminarModel();
    $seminar = $seminarModel
        ->join('bimbingan', 'seminar.bimbingan_id = bimbingan.bimbingan_id')
        ->where('bimbingan.mahasiswa_id', $userId)
        ->orderBy('seminar.tanggal_seminar', 'DESC')
        ->first();

    // Ambil data sidang mahasiswa
    $builder = $db->table('sidang');
    $builder->select('sidang.status');
    $builder->join('seminar', 'seminar.seminar_id = sidang.seminar_id');
    $builder->join('bimbingan', 'bimbingan.bimbingan_id = seminar.bimbingan_id');
    $builder->join('mahasiswa', 'mahasiswa.mahasiswa_id = bimbingan.mahasiswa_id');
    $builder->where('mahasiswa.user_id', $userId);
    $sidang = $builder->get()->getRowArray();

    $data = [
        'seminar' => $seminar,
        'sidang' => $sidang,
    ];

    return view('dashboard/mahasiswa', $data);
}


public function seminar()
{
    $userId = session()->get('user_id');
    $seminarModel = new SeminarModel();

    $seminars = $seminarModel
        ->join('bimbingan', 'seminar.bimbingan_id = bimbingan.bimbingan_id')
        ->where('bimbingan.mahasiswa_id', $userId)
        ->orderBy('seminar.tanggal_seminar', 'DESC')
        ->findAll(); // <-- AMBIL SEMUA, bukan hanya first()

    return view('mahasiswa/seminar_detail', ['seminars' => $seminars]);
}


}
