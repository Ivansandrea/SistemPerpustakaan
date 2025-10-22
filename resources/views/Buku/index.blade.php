@extends('layouts.main')

@section('title', 'Data Buku')

@section('content')
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-2xl font-bold text-[#49777B]">Daftar Koleksi Buku</h2>
            <p class="text-gray-600 text-sm mt-1">Kelola semua koleksi buku perpustakaan</p>
        </div>
        <a href="{{ route('buku.create') }}"
            class="flex items-center gap-2 bg-gradient-to-r from-[#F67103] to-[#D4800C] text-white px-6 py-3 rounded-xl hover:from-[#D4800C] hover:to-[#F67103] hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300 font-semibold">
            <i class='bxr  bx-plus text-xl'></i>
            Tambah Buku
        </a>
    </div>

    <div class="relative">
        <!-- Search & Filter Section (Optional) -->
        <div class="mb-6 flex gap-4">
            <div class="flex-1 ml-16">
                <div class="relative">
                    <form action="{{ route('buku.index') }}" method="GET" class="relative gap-2">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari judul atau penulis..."
                            class="w-full pl-3 pr-10 py-3 bg-gradient-to-br from-gray-50 to-white border-2 border-[#D2C8AA] rounded-xl focus:outline-none focus:border-[#F67103] focus:ring-4 focus:ring-[#F67103]/10 transition-all duration-300">
                        <button type="submit"
                            class="absolute right-0 top-1.5 text-[#3a6166] px-4 py-2 rounded-lg transition-all"><i
                                class='bxr  bx-search text-2xl'></i>
                        </button>
                    </form>
                </div>
            </div>

        </div>

        <!-- Pagination Info -->
        <div class="mb-2 flex justify-between items-center text-sm text-gray-600">
            <p>Menampilkan <span class="font-semibold text-[#49777B]">{{ count($data_buku) }}</span> Buku</p>
            <div class="flex gap-2">
                <!-- Tambahkan pagination links jika diperlukan -->
            </div>
        </div>

        <!-- Table Section -->
        <form action="{{ route('buku.deleteSelected') }}" method="POST" id="formdeleteSelected">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="absolute top-0 flex items-center justify-center text-2xl text-[#3a6166] border-2 border-[#49777B] rounded-xl hover:bg-red-100 px-3 py-3">
                <i class='bxr  bx-trash '></i>
            </button>
            <div
                class="bg-gradient-to-br from-white to-gray-50 rounded-xl shadow-lg overflow-hidden border border-[#D2C8AA]/30">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gradient-to-r from-[#49777B] to-[#3a6166]">
                                {{-- Checkbox select all --}}
                                <th class="px-6 py-4 text-center text-white font-semibold uppercase tracking-wider text-sm">
                                    <input type="checkbox" id="selectAll" class="w-5 h-5">
                                </th>
                                <th class="px-6 py-4 text-left text-white font-semibold uppercase tracking-wider text-sm">
                                    Kode
                                    Buku</th>
                                <th class="px-6 py-4 text-left text-white font-semibold uppercase tracking-wider text-sm">
                                    Judul
                                    Buku</th>
                                <th class="px-6 py-4 text-center text-white font-semibold uppercase tracking-wider text-sm">
                                    Foto
                                </th>
                                <th class="px-6 py-4 text-left text-white font-semibold uppercase tracking-wider text-sm">
                                    Deskripsi</th>
                                <th class="px-6 py-4 text-center text-white font-semibold uppercase tracking-wider text-sm">
                                    Stok
                                </th>
                                <th class="px-6 py-4 text-center text-white font-semibold uppercase tracking-wider text-sm">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-[#D2C8AA]/20">
                            @forelse ($data_buku as $index => $buku)
                                <tr
                                    class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-50/50' }} hover:bg-[#F67103]/5 transition-all">
                                    {{-- Checkbox select all --}}
                                    <td class="px-6 py-4 text-center">
                                        <input type="checkbox" name="ids[]" value="{{ $buku->id_buku }}"
                                            class="checkbox-item w-5 h-5">
                                    </td>
                                    <td class="px-6 py-4 font-semibold text-gray-800">{{ $buku->kode_buku }}</td>
                                    <td class="px-6 py-4">{{ $buku->judul_buku }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <img src="{{ asset('images/' . $buku->foto) }}"
                                            class="w-16 h-20 object-cover rounded-lg shadow-md mx-auto">
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 max-w-md">
                                        <div class="relative group">
                                            <p class="line-clamp-2 cursor-help">{{ $buku->deskripsi }}</p>
                                            {{-- Tooltip --}}
                                            <div
                                                class="absolute z-50 top-full left-1/2 -translate-x-1/2 mt-2 w-64 bg-gray-800 text-white text-xs rounded-lg px-3 py-2 opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 transition-all duration-300 shadow-lg pointer-events-none">
                                                {{ $buku->deskripsi }}
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 text-center">{{ $buku->stok }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('buku.show', $buku->id_buku) }}"
                                                class="group relative flex p-2 border-2 border-[#49777B] rounded-full hover:bg-blue-100 hover:shadow-lg transition-all duration-200 w-9 h-9 justify-center items-center overflow-hidden">
                                                <i
                                                    class="bx bx-eye absolute opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-lg"></i>
                                                <i
                                                    class="bx bx-eye-closed absolute opacity-100 group-hover:opacity-0 transition-opacity duration-300 text-lg"></i>
                                            </a>

                                            <a href="{{ route('buku.edit', $buku->id_buku) }}"
                                                class="group relative flex p-2 border-2 border-[#49777B] rounded-full hover:bg-green-100 hover:shadow-lg transition-all duration-200 w-9 h-9 justify-center items-center overflow-hidden">
                                                <i
                                                    class='bx bx-pencil-sparkles absolute opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-lg'></i>
                                                <i
                                                    class='bxr bx-pencil absolute opacity-100 group-hover:opacity-0 transition-opacity duration-300 text-lg'></i>
                                            </a>
                                            <button type="button"
                                                onclick="if(confirm('Yakin hapus buku ini?')) document.getElementById('delete-form-{{ $buku->id_buku }}').submit();"
                                                class="group relative flex p-2 border-2 border-[#49777B] rounded-full hover:bg-red-100 hover:shadow-lg transition-all duration-200 w-9 h-9 justify-center items-center overflow-hidden">
                                                <i
                                                    class='bxr  bx-trash absolute opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-lg'></i>
                                                <i
                                                    class='bxr  bx-trash-alt absolute opacity-100 group-hover:opacity-0 transition-opacity duration-300 text-lg'></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center text-gray-500 font-semibold">Belum ada
                                        data
                                        buku</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
        <!-- Setelah form hapus semua, letakkan form hapus satu baris di luar tabel -->
        @foreach ($data_buku as $buku)
            <form id="delete-form-{{ $buku->id_buku }}" action="{{ route('buku.delete', $buku->id_buku) }}" method="POST"
                style="display:none;">
                @csrf
                @method('DELETE')
            </form>
        @endforeach
    </div>


    <script>
        document.getElementById('selectAll').addEventListener('change', function() {
            const items = document.querySelectorAll('.checkbox-item');
            items.forEach(cb => cb.checked = this.checked);
        });

        document.getElementById('formdeleteSelected').addEventListener('submit', function(e) {
            const checked = document.querySelectorAll('.checkbox-item:checked');
            if (checked.length === 0) {
                e.preventDefault();
                alert('Pilih minimal satu buku untuk dihapus.');
            } else if (!confirm('Yakin ingin menghapus buku terpilih?')) {
                e.preventDefault();
            }
        });
    </script>

@endsection
