<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\model_peminjaman;
use App\Models\model_detail_pengembalian;

class model_pengembalian extends Model
{
    protected $table = 'pengembalian';
    protected $primaryKey = 'id_pengembalian';
    public $timestamps = false;

    protected $fillable = [
        'id_peminjaman',
        'tanggal_dikembalikan',
        'denda',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(model_peminjaman::class, 'id_peminjaman', 'id_peminjaman');
    }

    public function detail_pengembalian()
    {
        return $this->hasMany(model_detail_pengembalian::class, 'id_pengembalian', 'id_pengembalian');
    }
}
