<?php

namespace App\Http\Controllers;

use App\Models\model_buku;
use Illuminate\Http\Request;
use App\Models\model_pengembalian;
use App\Models\model_peminjaman;
use App\Models\model_detail_pinjam;
use App\Models\model_detail_pengembalian;

class controller_pengembalian extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $data_pengembalian = model_pengembalian::with('peminjaman.siswa', 'detail_pengembalian.buku')
            ->when($search, function ($query, $search) {
                $query->WhereHas('peminjaman.siswa', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                })->orWhere('id_pengembalian', 'like', "%{$search}%");
            })
            ->get();

        return view('pengembalian.index', compact('data_pengembalian', 'search'));
    }



    public function show($id)
    {
        $pengembalian = model_pengembalian::with('peminjaman.siswa', 'detail_pengembalian.buku')->findOrFail($id);

        return view('pengembalian.show', compact('pengembalian'));
    }

    public function create()
    {
        $peminjaman = model_peminjaman::where('status', 'dipinjam')->get(); // hanya yang belum selesai
        return view('pengembalian.create', compact('peminjaman'));
    }

    public function getBukuByPeminjaman($id)
    {
        $detail = model_detail_pinjam::with(['buku', 'peminjaman'])
            ->where('id_peminjaman', $id)
            ->where(function ($q) {
                $q->where('status_pinjam', 'dipinjam')
                    ->orWhereNull('status_pinjam'); // 🔹 biar yang belum punya status juga ikut tampil
            })
            ->get();

        return response()->json($detail);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_peminjaman' => 'required|exists:peminjaman,id_peminjaman',
            'tanggal_dikembalikan' => 'required|date',
            'buku' => 'required|array',
        ]);

        // Simpan data utama pengembalian (sementara denda = 0)
        $pengembalian = model_pengembalian::create([
            'id_peminjaman' => $request->id_peminjaman,
            'tanggal_dikembalikan' => $request->tanggal_dikembalikan,
            'denda' => 0,
        ]);

        $totalDenda = 0;

        // Loop buku yang dicentang
        foreach ($request->buku as $id_detail_pinjam => $buku) {
            if (!isset($buku['kembalikan'])) continue;

            $detailPinjam = model_detail_pinjam::with('peminjaman')->find($id_detail_pinjam);
            $tanggalKembali = $detailPinjam->peminjaman->tanggal_kembali;

            // Hitung selisih hari
            $hariTerlambat = 0;
            if ($tanggalKembali) {
                $hariTerlambat = max(0, floor(
                    (strtotime($request->tanggal_dikembalikan) - strtotime($tanggalKembali)) / 86400
                ));
            }

            $dendaBuku = $hariTerlambat * 1000;

            // Simpan detail pengembalian
            model_detail_pengembalian::create([
                'id_pengembalian' => $pengembalian->id_pengembalian,
                'id_detail_pinjam' => $id_detail_pinjam,
                'id_buku' => $buku['id_buku'],
                'jumlah_kembali' => $buku['jumlah_kembali'],
                'denda_buku' => $dendaBuku,
            ]);

            // Tambahkan total
            $totalDenda += $dendaBuku;

            // Update status pinjam & stok buku
            $detailPinjam->update(['status_pinjam' => 'dikembalikan']);
            model_buku::where('id_buku', $buku['id_buku'])->increment('stok', $buku['jumlah_kembali']);
        }

        // Update total denda di tabel pengembalian
        $pengembalian->update(['denda' => $totalDenda]);

        // Cek apakah semua buku sudah dikembalikan
        $semuaDikembalikan = model_detail_pinjam::where('id_peminjaman', $request->id_peminjaman)
            ->where('status_pinjam', '!=', 'dikembalikan')
            ->doesntExist();

        if ($semuaDikembalikan) {
            model_peminjaman::where('id_peminjaman', $request->id_peminjaman)
                ->update(['status' => 'selesai']);
        }

        return redirect()->route('pengembalian.index')->with('success', 'Pengembalian berhasil disimpan.');
    }

    public function destroy($id)
    {
        $pengembalian = model_pengembalian::with([
            'detail_pengembalian.buku',
            'peminjaman'
        ])->findOrFail($id);

        $idPeminjaman = $pengembalian->id_peminjaman;

        // 1) Kembalikan stok & revert hanya detail yang ada di pengembalian ini
        foreach ($pengembalian->detail_pengembalian as $detail) {
            // kurangi stok karena sebelumnya saat pengembalian dibuat stok ditambah
            $buku = $detail->buku;
            $buku->stok -= $detail->jumlah_kembali;
            $buku->save();

            // revert status detail_pinjam yang spesifik
            $detailPinjam = model_detail_pinjam::find($detail->id_detail_pinjam);
            if ($detailPinjam) {
                $detailPinjam->status_pinjam = 'dipinjam';
                $detailPinjam->save();
            }
        }

        // Hapus detail pengembalian dan pengembalian utama
        $pengembalian->detail_pengembalian()->delete();
        $pengembalian->delete();

        // 2) Recalculate status peminjaman utama:
        // Jika ada detail_pinjam yg belum "dikembalikan" => peminjaman = dipinjam
        // Jika semua sudah "dikembalikan" => peminjaman = selesai
        $anyNotReturned = model_detail_pinjam::where('id_peminjaman', $idPeminjaman)
            ->where('status_pinjam', '!=', 'dikembalikan')
            ->exists();

        model_peminjaman::where('id_peminjaman', $idPeminjaman)
            ->update(['status' => $anyNotReturned ? 'dipinjam' : 'selesai']);

        return redirect()->route('pengembalian.index')
            ->with('success', 'Pengembalian berhasil dibatalkan. Status peminjaman diperbarui.');
    }


    public function deleteSelected(Request $request)
    {
        $ids = $request->ids;

        if (empty($ids)) {
            return redirect()->back()->with('error', 'Tidak ada pengembalian yang dipilih.');
        }

        $pengembalians = model_pengembalian::with([
            'detail_pengembalian.buku',
            'peminjaman'
        ])->whereIn('id_pengembalian', $ids)->get();

        foreach ($pengembalians as $pengembalian) {
            $idPeminjaman = $pengembalian->id_peminjaman;

            foreach ($pengembalian->detail_pengembalian as $detail) {
                // rollback stok
                $buku = $detail->buku;
                $buku->stok -= $detail->jumlah_kembali;
                $buku->save();

                // revert detail_pinjam yang spesifik
                $detailPinjam = model_detail_pinjam::find($detail->id_detail_pinjam);
                if ($detailPinjam) {
                    $detailPinjam->status_pinjam = 'dipinjam';
                    $detailPinjam->save();
                }
            }

            // hapus detail & pengembalian
            $pengembalian->detail_pengembalian()->delete();
            $pengembalian->delete();

            // update status peminjaman sesuai sisa detail_pinjam
            $anyNotReturned = model_detail_pinjam::where('id_peminjaman', $idPeminjaman)
                ->where('status_pinjam', '!=', 'dikembalikan')
                ->exists();

            model_peminjaman::where('id_peminjaman', $idPeminjaman)
                ->update(['status' => $anyNotReturned ? 'dipinjam' : 'selesai']);
        }

        return redirect()->back()->with('success', 'Pengembalian terpilih berhasil dibatalkan.');
    }
}
