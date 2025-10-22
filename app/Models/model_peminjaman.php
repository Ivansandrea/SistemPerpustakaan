<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\model_siswa;
use App\Models\model_buku;
use App\Models\model_detail_pinjam;
use App\Models\model_pengembalian;

class model_peminjaman extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'id_peminjaman';

    protected $fillable = [
        'id_siswa',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status'
    ];

    public $timestamps = false;

    public function siswa()
    {
        return $this->belongsTo(model_siswa::class, 'id_siswa', 'id_siswa');
    }

    public function detail_pinjam()
    {
        return $this->hasMany(model_detail_pinjam::class, 'id_peminjaman', 'id_peminjaman');
    }

    public function buku()
    {
        return $this->belongsToMany(model_buku::class, 'detail_pinjam', 'id_peminjaman', 'id_buku')
            ->withPivot('jumlah_pinjam', 'status_pinjam');
    }

    public function pengembalian()
    {
        return $this->hasManyThrough(model_pengembalian::class, model_detail_pinjam::class, 'id_peminjaman', 'id_detail_pinjam', 'id_peminjaman', 'id_detail_pinjam');
    }
}
