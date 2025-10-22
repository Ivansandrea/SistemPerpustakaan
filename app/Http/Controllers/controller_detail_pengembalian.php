<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\model_detail_pengembalian;
use App\Models\model_pengembalian;
use App\Models\model_buku;

class controller_detail_pengembalian extends Controller
{

    public function index(Request $request)
{
    $search = $request->input('search');

    $data_detail_pengembalian = model_detail_pengembalian::with('pengembalian', 'buku', 'detail_pinjam')
        ->when($search, function ($query, $search) {
            $query->WhereHas('pengembalian.peminjaman.siswa', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%");
            })->orWhere('id_detail_pengembalian', 'like', "%{$search}%");;
        })
        ->get();

    return view('detail_pengembalian.index', compact('data_detail_pengembalian', 'search'));
}

    public function show($id)
    {
        $detail_pengembalian = model_detail_pengembalian::with('pengembalian', 'buku', 'detail_pinjam')->findOrFail($id);

        return view('detail_pengembalian.show', compact('detail_pengembalian'));
    }

    public function edit($id)
    {
        $detail_pengembalian = model_detail_pengembalian::findOrFail($id);
        return view('detail_pengembalian.edit', compact('detail_pengembalian'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_pengembalian' => 'required|exists:pengembalian,id_pengembalian',
            'id_detail_pinjam' => 'required|exists:detail_pinjam,id_detail_pinjam',
            'id_buku' => 'required|exists:buku,id_buku',
            'jumlah_kembali' => 'required|integer|min:1',
            'denda_buku' => 'nullable|numeric|min:0',
        ]);

        $detail_pengembalian = model_detail_pengembalian::findOrFail($id);
        $detail_pengembalian->update($request->all());

        return redirect()->route('detail_pengembalian.index')->with('success', 'Detail Pengembalian berhasil diperbarui.');
    }

    public function deleteSelected(Request $request)
    {
        $ids = $request->input('ids');
        if ($ids) {
            model_detail_pengembalian::whereIn('id_detail_pengembalian', $ids)->delete();
            return redirect()->route('detail_pengembalian.index')->with('success', 'Detail Pengembalian terpilih berhasil dihapus.');
        }
    }
}
