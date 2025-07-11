<?php

namespace App\Models;

use CodeIgniter\Model;

class SidangModel extends Model
{
    protected $table = 'sidang';
    protected $primaryKey = 'sidang_id';
    protected $allowedFields = ['seminar_id', 'tanggal_sidang', 'tempat', 'status', 'nilai_akhir', 'catatan_dewan'];

    public function getSidangWithSeminar()
    {
        return $this->db->table($this->table) // gunakan $this->table biar konsisten
            ->select('sidang.*, seminar.judul_seminar, mahasiswa.nama AS nama_lengkap')
            ->join('seminar', 'seminar.seminar_id = sidang.seminar_id')
            ->join('bimbingan', 'bimbingan.bimbingan_id = seminar.bimbingan_id')
            ->join('mahasiswa', 'mahasiswa.mahasiswa_id = bimbingan.mahasiswa_id')
            ->get()
            ->getResultArray();
    }
}
