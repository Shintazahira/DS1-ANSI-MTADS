<?php

namespace App\Models;

use CodeIgniter\Model;

class BimbinganModel extends Model
{
    protected $table = 'bimbingan';
    protected $primaryKey = 'bimbingan_id';
    protected $allowedFields = [
        'mahasiswa_id',
        'dosen_id',
        'topik_id',
        'status',
        'tanggal_mulai',
        'tanggal_selesai',
        'catatan',
        'nama_mahasiswa',
        'jurusan' // ✅ Tambahkan ini agar kolom jurusan dikenali dan bisa dipakai
    ];
}
