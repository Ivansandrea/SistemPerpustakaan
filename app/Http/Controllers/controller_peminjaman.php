<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\model_peminjaman;
use App\Models\model_detail_pinjam;
use App\Models\model_buku;
use App\Models\model_siswa;

class controller_peminjaman extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search'); // ambil keyword dari input search

        $data_peminjaman = model_peminjaman::with('detail_pinjam', 'siswa')
            ->when($search, function ($query, $search) {
                // cari berdasarkan nama siswa atau ID peminjaman
                $query->whereHas('siswa', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                })->orWhere('id_peminjaman', 'like', "%{$search}%");
            })
            ->get();

        $siswa = model_siswa::all();
        $buku = model_buku::all();

        return view('peminjaman.index', compact('data_peminjaman', 'siswa', 'buku', 'search'));
    }


    public function show($id)
    {
        $peminjaman = model_peminjaman::with('siswa', 'buku', 'detail_pinjam')->findOrFail($id);
        $detail_pinjam = model_detail_pinjam::where('id_peminjaman', $id)->get();

        return view('peminjaman.show', compact('peminjaman', 'detail_pinjam'));
    }

    public function create()
    {
        $siswa = model_siswa::all(); // ambil semua data siswa
        $buku = model_buku::all(); // ambil semua data siswa
        return view('peminjaman.create', compact('siswa', 'buku'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_siswa' => 'required|exists:siswa,id_siswa',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'buku.*.id_buku' => 'required|exists:buku,id_buku',
            'buku.*.jumlah_pinjam' => 'required|integer|min:1',
        ]);

        foreach ($request->buku as $item) {
            $buku = model_buku::find($item['id_buku']);
            if ($item['jumlah_pinjam'] > $buku->stok) {
                return back()->withInput()->with('error', "Stok buku '{$buku->judul}' tidak mencukupi! (tersedia: {$buku->stok})");
            }
        }

        // Simpan ke tabel peminjaman
        $data_peminjaman = model_peminjaman::create([
            'id_siswa' => $request->id_siswa,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'dipinjam'
        ]);

        // Simpan ke tabel detail_pinjam
        foreach ($request->buku as $buku) {
            model_detail_pinjam::create([
                'id_peminjaman' => $data_peminjaman->id_peminjaman,
                'id_buku' => $buku['id_buku'],
                'jumlah_pinjam' => $buku['jumlah_pinjam'],
                'status_pinjam' => 'dipinjam'
            ]);
        }

        return redirect()->route('peminjaman.index')->withInput()->with('success', 'Data peminjaman berhasil disimpan.');
    }

    public function cekStok($id_buku)
    {
        $buku = \App\Models\model_buku::find($id_buku);

        if (!$buku) {
            return response()->json(['error' => 'Buku tidak ditemukan'], 404);
        }

        return response()->json(['stok' => $buku->stok]);
    }


    public function edit($id)
    {
        $data_peminjaman = model_peminjaman::with('detail_pinjam', 'siswa')->findOrFail($id);
        $siswa = model_siswa::all();
        $buku = model_buku::all();
        return view('peminjaman.edit', compact('data_peminjaman', 'siswa', 'buku'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        // ✅ Temukan data peminjaman
        $data_peminjaman = model_peminjaman::findOrFail($id);

        // ✅ Update hanya tanggal
        $data_peminjaman->update([
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $peminjaman = model_peminjaman::findOrFail($id);
        $peminjaman->detail_pinjam()->delete(); // Hapus detail pinjam terkait
        $peminjaman->delete(); // Hapus peminjaman
        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil dihapus.');
    }

    public function deleteSelected(Request $request)
    {
        $ids = $request->ids;

        if (!$ids) {
            return redirect()->back()->with('error', 'Tidak ada peminjaman yang dipilih.');
        }

        $peminjamans = model_peminjaman::with('detail_pinjam')->whereIn('id_peminjaman', $ids)->get();

        foreach ($peminjamans as $peminjaman) {
            // Hapus detail pinjam → stok otomatis di trigger
            $peminjaman->detail_pinjam()->delete();
            
            // Hapus peminjaman utama
            $peminjaman->delete();
        }

        return redirect()->back()
            ->with('success', 'Peminjaman terpilih berhasil dihapus.');
    }
}
