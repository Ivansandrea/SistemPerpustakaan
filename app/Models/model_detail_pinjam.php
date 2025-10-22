<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\model_buku;
use App\Models\model_peminjaman;

class model_detail_pinjam extends Model
{
    protected $table = 'detail_pinjam';
    protected $primaryKey = 'id_detail_pinjam';
    
    protected $fillable = [
        'id_peminjaman',
        'id_buku',
        'jumlah_pinjam',
        'status_pinjam'
    ];

    public $timestamps = false;

    public function buku()
    {
        return $this->belongsTo(model_buku::class, 'id_buku', 'id_buku');
    }

    public function peminjaman()
    {
        return $this->belongsTo(model_peminjaman::class, 'id_peminjaman', 'id_peminjaman');
    }
    public function detail_pengembalian()
{
    return $this->hasOne(model_detail_pengembalian::class, 'id_detail_pinjam', 'id_detail_pinjam');
}

}
