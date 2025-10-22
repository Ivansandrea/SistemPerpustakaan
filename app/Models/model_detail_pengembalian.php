<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class model_detail_pengembalian extends Model
{
    protected $table = 'detail_pengembalian';
    protected $primaryKey = 'id_detail_pengembalian';
    
    protected $fillable = [
        'id_pengembalian',
        'id_detail_pinjam',
        'id_buku',
        'jumlah_kembali',
        'denda_buku'
    ];

    public $timestamps = false;

    public function pengembalian()
    {
        return $this->belongsTo(model_pengembalian::class, 'id_pengembalian', 'id_pengembalian');
    }

    public function buku()
    {
        return $this->belongsTo(model_buku::class, 'id_buku', 'id_buku');
    }
    public function detail_pinjam()
{
    return $this->belongsTo(model_detail_pinjam::class, 'id_detail_pinjam', 'id_detail_pinjam');
}

}
