<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\model_buku;
use App\Models\model_siswa;
use App\Models\model_peminjaman;
use App\Models\model_pengembalian;


class controller_homepage extends Controller
{
    public function index() {

        $buku = model_buku::all();

        $siswa = model_siswa::all();
        $peminjaman = model_peminjaman::all();
        $pengembalian = model_pengembalian::all();
        
        return view('beranda', compact('buku', 'siswa', 'peminjaman', 'pengembalian'));
    }
}
