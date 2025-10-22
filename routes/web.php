<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\controller_buku;
use App\Http\Controllers\controller_siswa;
use App\Http\Controllers\controller_peminjaman;
use App\Http\Controllers\controller_detail_pinjam;
use App\Http\Controllers\controller_pengembalian;
use App\Http\Controllers\controller_detail_pengembalian;

Route::get('/syarat-ketentuan', function () {
    return view('syarat_ketentuan');
})->name('syarat.ketentuan');

Route::get('/', [controller_buku::class, 'index'])->name('index');

// Buku
Route::get('/buku', [controller_buku::class, 'index'])->name('buku.index');
Route::get('/buku/create', [controller_buku::class, 'create'])->name('buku.create');
Route::get('/buku/{id_buku}', [controller_buku::class, 'show'])->name('buku.show');
Route::post('/buku', [controller_buku::class, 'store'])->name('buku.store');
Route::get('/buku/{id}/edit', [controller_buku::class, 'edit'])->name('buku.edit');
Route::put('/buku/{id}', [controller_buku::class, 'update'])->name('buku.update');
Route::delete('/buku/delete-selected', [controller_buku::class, 'deleteSelected'])->name('buku.deleteSelected');
Route::delete('/buku/{id}', [controller_buku::class, 'destroy'])->name('buku.delete');


// Siswa
Route::get('/siswa', [controller_siswa::class, 'index'])->name('siswa.index');
Route::get('/siswa/create', [controller_siswa::class, 'create'])->name('siswa.create');
Route::get('/siswa/{id_siswa}', [controller_siswa::class, 'show'])->name('siswa.show');
Route::post('/siswa', [controller_siswa::class, 'store'])->name('siswa.store');
Route::get('/siswa/{id}/edit', [controller_siswa::class, 'edit'])->name('siswa.edit');
Route::put('/siswa/{id}', [controller_siswa::class, 'update'])->name('siswa.update');
Route::delete('/siswa/delete-selected', [controller_siswa::class, 'deleteSelected'])->name('siswa.deleteSelected');
Route::delete('/siswa/{id}', [controller_siswa::class, 'destroy'])->name('siswa.delete');


// Peminjaman
Route::get('/peminjaman', [controller_peminjaman::class, 'index'])->name('peminjaman.index');
Route::get('/peminjaman/create', [controller_peminjaman::class, 'create'])->name('peminjaman.create');
Route::get('/peminjaman/{id_peminjaman}', [controller_peminjaman::class, 'show'])->name('peminjaman.show');
Route::post('/peminjaman', [controller_peminjaman::class, 'store'])->name('peminjaman.store');
Route::get('/peminjaman/{id}/edit', [controller_peminjaman::class, 'edit'])->name('peminjaman.edit');
Route::put('/peminjaman/{id}', [controller_peminjaman::class, 'update'])->name('peminjaman.update');
Route::delete('/peminjaman/delete-selected', [controller_peminjaman::class, 'deleteSelected'])->name('peminjaman.deleteSelected');
Route::delete('/peminjaman/{id}', [controller_peminjaman::class, 'destroy'])->name('peminjaman.delete');

Route::get('/cek-stok/{id_buku}', [controller_peminjaman::class, 'cekStok']);



// Detail Pinjam
Route::get('/detail_pinjam', [controller_detail_pinjam::class, 'index'])->name('detail_pinjam.index');
Route::get('/detail_pinjam/create', [controller_detail_pinjam::class, 'create'])->name('detail_pinjam.create');
Route::get('/detail_pinjam/{id_detail_pinjam}', [controller_detail_pinjam::class, 'show'])->name('detail_pinjam.show');
// Route::get('/detail_pinjam/peminjaman/{id_peminjaman}', [controller_detail_pinjam::class, 'showByPeminjaman'])->name('detail_pinjam.showByPeminjaman');
Route::post('/detail_pinjam', [controller_detail_pinjam::class, 'store'])->name('detail_pinjam.store');
Route::get('/detail_pinjam/{id}/edit', [controller_detail_pinjam::class, 'edit'])->name('detail_pinjam.edit');
Route::put('/detail_pinjam/{id}', [controller_detail_pinjam::class, 'update'])->name('detail_pinjam.update');
Route::delete('/detail_pinjam/delete-selected', [controller_detail_pinjam::class, 'deleteSelected'])->name('detail_pinjam.deleteSelected');
Route::delete('/detail_pinjam/{id}', [controller_detail_pinjam::class, 'destroy'])->name('detail_pinjam.delete');


// Pengembalian
Route::get('/pengembalian', [controller_pengembalian::class, 'index'])->name('pengembalian.index');
Route::get('/pengembalian/create', [controller_pengembalian::class, 'create'])->name('pengembalian.create');
Route::get('/pengembalian/{id_pengembalian}', [controller_pengembalian::class, 'show'])->name('pengembalian.show');
Route::post('/pengembalian', [controller_pengembalian::class, 'store'])->name('pengembalian.store');
Route::get('/pengembalian/{id}/edit', [controller_pengembalian::class, 'edit'])->name('pengembalian.edit');
Route::put('/pengembalian/{id}', [controller_pengembalian::class, 'update'])->name('pengembalian.update');
Route::delete('/pengembalian/delete-selected', [controller_pengembalian::class, 'deleteSelected'])->name('pengembalian.deleteSelected');
Route::delete('/pengembalian/{id}', [controller_pengembalian::class, 'destroy'])->name('pengembalian.delete');

Route::get('/pengembalian/get-buku/{id}', [controller_pengembalian::class, 'getBukuByPeminjaman']);

// Route::delete('/detail_pengembalian/{id}', [controller_detail_pengembalian::class, 'destroy'])->name('dextail_pengembalian.delete');

// Detail Pengembalian
Route::get('/detail_pengembalian', [controller_detail_pengembalian::class, 'index'])->name('detail_pengembalian.index');
Route::get('/detail_pengembalian/{id_detail_pengembalian}', [controller_detail_pengembalian::class, 'show'])->name('detail_pengembalian.show');
Route::get('/detail_pengembalian/{id}/edit', [controller_detail_pengembalian::class, 'edit'])->name('detail_pengembalian.edit');
Route::put('/detail_pengembalian/{id}', [controller_detail_pengembalian::class, 'update'])->name('detail_pengembalian.update');
Route::delete('/detail_pengembalian/delete-selected', [controller_detail_pengembalian::class, 'deleteSelected'])->name('detail_pengembalian.deleteSelected');
Route::delete('/detail_pengembalian/{id}', [controller_detail_pengembalian::class, 'destroy'])->name('detail_pengembalian.delete');
