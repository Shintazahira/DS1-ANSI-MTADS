<?php
namespace App\Models;

use CodeIgniter\Model;

class KaprodiModel extends Model
{
    protected $table = 'kaprodi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'nama_lengkap', 'jurusan'];
}
