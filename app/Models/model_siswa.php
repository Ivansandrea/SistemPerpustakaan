<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\model_peminjaman;

class model_siswa extends Model
{
    protected $table = 'siswa';
    protected $primaryKey = 'id_siswa';
    protected $fillable = [
        'nama',
        'kelas',
        'nisn',
        'jurusan',
        'foto_siswa'
    ];

    public $timestamps = false;

    // Relasi ke tabel peminjaman (One to Many)
    public function peminjaman()
    {
        return $this->hasMany(model_peminjaman::class, 'id_siswa', 'id_siswa');
    }   
}
