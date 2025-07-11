<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'user_id';

    protected $allowedFields = [
        'username', 'password', 'email', 'role', 'nama_lengkap', 'foto_profil', 'is_active', 'created_at', 'updated_at'
    ];

    protected $useTimestamps = true; // otomatis isi created_at dan updated_at
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $returnType    = 'array'; // bisa juga 'object'
}
