<?php

namespace App\Models;

use CodeIgniter\Model;

class PengajuanTopikModel extends Model
{
    protected $table = 'pengajuan'; // ganti dengan nama tabel kamu
    protected $primaryKey = 'id';
    protected $allowedFields = ['mahasiswa_id', 'judul', 'status', 'tanggal_pengajuan', 'catatan'];
}
