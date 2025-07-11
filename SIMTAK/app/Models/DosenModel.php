<?php

namespace App\Models;

use CodeIgniter\Model;

class DosenModel extends Model
{
    protected $table = 'dosen';
    protected $primaryKey = 'dosen_id';
    protected $allowedFields = [
        'nama_lengkap',       // ✅ tambahkan ini
        'user_id',
        'nidn',
        'jabatan_akademik',
        'bidang_keahlian'
    ];
}
