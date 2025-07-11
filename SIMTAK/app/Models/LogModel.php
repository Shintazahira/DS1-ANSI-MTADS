<?php

namespace App\Models;

use CodeIgniter\Model;

class LogModel extends Model
{
    protected $table      = 'log_aktivitas'; // <-- ini yang diubah
    protected $primaryKey = 'id';

    protected $allowedFields = ['user_id', 'aktivitas', 'waktu_login', 'waktu_logout'];
    protected $useTimestamps = false; // tidak perlu created_at, updated_at
}

