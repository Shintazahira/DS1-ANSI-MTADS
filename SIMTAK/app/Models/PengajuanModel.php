<?php

namespace App\Models;

use CodeIgniter\Model;

class PengajuanModel extends Model
{
    protected $table = 'pengajuan';
    protected $primaryKey = 'id'; // ✅ GANTI dari 'pengajuan_id' ke 'id'
    protected $allowedFields = [
        'mahasiswa_id',
        'judul',
        'deskripsi',
        'file_proposal',
        'status',
        'alasan_penolakan',
        'created_at'
    ];
}

