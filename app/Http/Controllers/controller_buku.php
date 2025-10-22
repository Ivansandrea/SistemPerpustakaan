<?php

namespace App\Http\Controllers;

use App\Models\model_buku;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class controller_buku extends Controller
{
    public function index(Request $request)
    {
        $query = model_buku::query();

        // Jika ada input pencarian
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where('judul_buku', 'like', "%{$search}%")
                ->orWhere('kode_buku', 'like', "%{$search}%");
        }

        $data_buku = $query->get();

        return view('buku.index', compact('data_buku'));
    }



    public function show($id_buku)
    {
        $buku = model_buku::findOrFail($id_buku);
        return view('buku.show', compact('buku'));
    }


    public function create()
    {
        return view('buku.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_buku' => 'required|unique:buku,kode_buku|string|max:5',
            'judul_buku' => 'required|string|max:100',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deskripsi' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
        ]);

        $imageName = time() . '.' . $request->foto->extension();
        $request->foto->move(public_path('images'), $imageName);

        model_buku::create([
            'kode_buku' => $request->kode_buku,
            'judul_buku' => $request->judul_buku,
            'foto' => $imageName,
            'deskripsi' => $request->deskripsi,
            'stok' => $request->stok,
        ]);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function cekStok($id_buku)
    {
        $buku = model_buku::find($id_buku);
        return response()->json(['stok' => $buku ? $buku->stok : 0]);
    }


    public function edit($id)
    {
        $data_buku = model_buku::findOrFail($id);
        return view('buku.edit', compact('data_buku'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_buku' => 'required|unique:buku,kode_buku,' . $id . ',id_buku',
            'judul_buku' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deskripsi' => 'required',
            'stok' => 'required|integer|min:0',
        ]);

        $data_buku = model_buku::findOrFail($id);

        if ($request->hasFile('foto')) {
            $imageName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('images'), $imageName);
            $data_buku->foto = $imageName;
        }

        $data_buku->kode_buku = $request->kode_buku;
        $data_buku->judul_buku = $request->judul_buku;
        $data_buku->deskripsi = $request->deskripsi;
        $data_buku->stok = $request->stok;
        $data_buku->save();

        return redirect()->route('buku.index')->with('success', 'Data buku berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $buku = model_buku::findOrFail($id);
        $buku->delete();
        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus.');
    }

    public function deleteSelected(Request $request)
    {
        $ids = $request->ids;

        if ($ids) {
            model_buku::whereIn('id_buku', $ids)->delete();
            return redirect()->back()->with('success', 'Buku terpilih berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Tidak ada buku yang dipilih.');
    }
}
