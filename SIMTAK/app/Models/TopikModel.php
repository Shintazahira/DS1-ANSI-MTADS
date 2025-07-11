<?php

namespace App\Models;

use CodeIgniter\Model;

class TopikModel extends Model
{
    protected $table = 'topik';
    protected $primaryKey = 'topik_id';
    protected $allowedFields = ['judul', 'deskripsi', 'mahasiswa_id', 'status', 'created_at'];
    protected $useTimestamps = true;
}
