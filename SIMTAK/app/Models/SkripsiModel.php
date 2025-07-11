<?php

namespace App\Models;

use CodeIgniter\Model;

class SkripsiModel extends Model
{
    protected $table = 'skripsi';
    protected $primaryKey = 'skripsi_id';
    protected $allowedFields = ['mahasiswa_id', 'judul', 'status', 'tanggal_pengajuan', 'catatan'];
}
