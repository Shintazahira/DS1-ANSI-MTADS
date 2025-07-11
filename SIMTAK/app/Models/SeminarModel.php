<?php

namespace App\Models;

use CodeIgniter\Model;

class SeminarModel extends Model
{
    protected $table = 'seminar';
    protected $primaryKey = 'seminar_id';
protected $allowedFields = [
    'bimbingan_id',
    'dosen_id',
    'judul_seminar',
    'abstrak',
    'tanggal_seminar',
    'tempat',
    'status',
    'nilai',
    'catatan_penguji',
    'nilai_presentasi',
    'nilai_laporan',
    'nilai_tanya_jawab',
    'komentar_dosen',
    'dinilai_oleh'
];

}
