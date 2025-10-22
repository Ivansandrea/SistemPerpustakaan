<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\model_detail_pinjam;
use App\Models\model_peminjaman;
use App\Models\model_buku;

class controller_detail_pinjam extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');

        $data_detail_pinjam = model_detail_pinjam::with('buku', 'peminjaman.siswa')
            ->when($search, function ($query, $search) {
                $query->WhereHas('peminjaman.siswa', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                })->orWhere('id_detail_pinjam', 'like', "%{$search}%");;
            })
            ->get();

        return view('detail_pinjam.index', compact('data_detail_pinjam', 'search'));
    }


    public function show($id_detail_pinjam)
    {
        $detail_pinjam = model_detail_pinjam::with(['buku', 'peminjaman'])->findOrFail($id_detail_pinjam);

        return view('detail_pinjam.show', compact('detail_pinjam'));
    }


    public function edit($id)
    {
        $detail_pinjam = model_detail_pinjam::findOrFail($id);
        $buku = model_buku::all();

        return view('detail_pinjam.edit', compact('detail_pinjam', 'buku'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_buku' => 'required|exists:buku,id_buku',
            'jumlah_pinjam' => 'required|integer|min:1',
        ]);

        $detail_pinjam = model_detail_pinjam::findOrFail($id);

        // Cegah update jika status sudah dikembalikan (opsional tapi disarankan)
        if ($detail_pinjam->status_pinjam === 'dikembalikan') {
            return redirect()->route('detail_pinjam.index')
                ->with('error', 'Data tidak dapat diubah karena buku sudah dikembalikan.');
        }

        // Update data
        $detail_pinjam->id_buku = $request->id_buku;
        $detail_pinjam->jumlah_pinjam = $request->jumlah_pinjam;
        $detail_pinjam->save();

        return redirect()->route('detail_pinjam.index')
            ->with('success', 'Detail Peminjaman berhasil diperbarui.');
    }


    public function deleteSelected(Request $request)
    {
        $ids = $request->ids;

        if ($ids) {
            model_detail_pinjam::whereIn('id_detail_pinjam', $ids)->delete();
            return redirect()->back()->with('success', 'Detail Pinjam terpilih berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Tidak ada Detail Pinjam yang dipilih.');
    }

    public function destroy($id)
    {
        $detail_pinjam = model_detail_pinjam::findOrFail($id);
        $detail_pinjam->delete();
        return redirect()->route('detail_pinjam.index')->with('success', 'Detail Pinjam berhasil dihapus.');
    }
}
