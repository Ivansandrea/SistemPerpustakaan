<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\model_siswa;

class controller_siswa extends Controller
{
    public function index(Request $request)
    {
        $query = model_siswa::query();

        // Jika ada input pencarian
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where('nama', 'like', "%{$search}%")
                ->orWhere('nisn', 'like', "%{$search}%");
        }

        $data_siswa = $query->get();

        return view('siswa.index', compact('data_siswa'));
    }


    public function show($id_siswa)
    {
        $siswa = model_siswa::findOrFail($id_siswa);
        return view('siswa.show', compact('siswa'));
    }
    

    public function create()
    {
        return view('siswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'kelas' => 'required|string|max:255',
            'nisn' => 'required|unique:siswa,nisn|digits:10',
            'jurusan' => 'required|string|max:255',
            'foto_siswa' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $imageName = time() . '.' . $request->foto_siswa->extension();
        $request->foto_siswa->move(public_path('images_siswa'), $imageName);

        model_siswa::create([
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'nisn' => $request->nisn,
            'jurusan' => $request->jurusan,
            'foto_siswa' => $imageName,
        ]);

        return redirect()->route('siswa.index')->with('success', 'siswa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data_siswa = model_siswa::findOrFail($id);
        return view('siswa.edit', compact('data_siswa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'kelas' => 'required|string|max:255',
            'nisn' => 'required|digits:10|unique:siswa,nisn,' . $id . ',id_siswa',
            'jurusan' => 'required|string|max:255',
            'foto_siswa' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $data_siswa = model_siswa::findOrFail($id); 

        if ($request->hasFile('foto_siswa')) {
            $imageName = time() . '.' . $request->foto_siswa->extension();
            $request->foto_siswa->move(public_path('images_siswa'), $imageName);
            $data_siswa->foto_siswa = $imageName;
        }

        $data_siswa->nama = $request->nama;
        $data_siswa->kelas = $request->kelas;
        $data_siswa->nisn = $request->nisn;
        $data_siswa->jurusan = $request->jurusan;
        $data_siswa->save();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $siswa = model_siswa::findOrFail($id);
        $siswa->delete();
        return redirect()->route('siswa.index')->with('success', 'siswa berhasil dihapus.');
    }

    public function deleteSelected(Request $request)
    {
        $ids = $request->ids;

        if ($ids) {
            model_siswa::whereIn('id_siswa', $ids)->delete();
            return redirect()->back()->with('success', 'siswa terpilih berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Tidak ada siswa yang dipilih.');
    }
}
