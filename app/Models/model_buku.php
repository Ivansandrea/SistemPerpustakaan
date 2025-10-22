<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\model_detail_pinjam;

class model_buku extends Model
{
    protected $table = 'buku';
    protected $primaryKey = 'id_buku';
    protected $fillable = [
        'kode_buku',
        'judul_buku',
        'foto',
        'deskripsi', 
        'stok'
    ];

    public $timestamps = false;

    public function detail_pinjam()
    {
        return $this->hasMany(model_detail_pinjam::class, 'id_buku', 'id_buku');
    }

    public function detail_pengembalian()
    {
        return $this->hasMany(model_detail_pengembalian::class, 'id_buku', 'id_buku');
    }
}
