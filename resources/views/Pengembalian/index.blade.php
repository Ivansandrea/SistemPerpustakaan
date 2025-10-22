@extends('layouts.main')

@section('title', 'Data Pengembalian')

@section('content')
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-2xl font-bold text-[#49777B]">Daftar Pengembalian</h2>
            <p class="text-gray-600 text-sm mt-1">Kelola semua koleksi buku perpustakaan</p>
        </div>
        <a href="{{ route('pengembalian.create') }}"
            class="flex items-center gap-2 bg-gradient-to-r from-[#F67103] to-[#D4800C] text-white px-6 py-3 rounded-xl hover:from-[#D4800C] hover:to-[#F67103] hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300 font-semibold">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Pengembalian
        </a>
    </div>

    <div class="relative">
        <!-- Search & Filter Section (Optional) -->
        <div class="mb-6 flex gap-4">
            <div class="flex-1 ml-16">
                <div class="relative">
                    <form action="{{ route('pengembalian.index') }}" method="GET" class="relative gap-2">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari Nama atau Id Pengembalian..."
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
            <p>Menampilkan <span class="font-semibold text-[#49777B]">{{ count($data_pengembalian) }}</span> Pengembalian</p>
            <div class="flex gap-2">
                <!-- Tambahkan pagination links jika diperlukan -->
            </div>
        </div>

        <!-- Table Section -->
        <form action="{{ route('pengembalian.deleteSelected') }}" method="POST" id="formdeleteSelected">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="absolute top-0 flex items-center justify-center text-2xl text-[#3a6166] border-2 border-[#49777B] rounded-xl hover:bg-red-100 px-3 py-3">
                <i class='bxr  bx-trash'></i>
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
                                <th class="px-6 py-4 text-center text-white font-semibold uppercase tracking-wider text-sm">
                                    Id pengembalian
                                </th>
                                <th class="px-6 py-4 text-left text-white font-semibold uppercase tracking-wider text-sm">
                                    Nama
                                </th>
                                <th class="px-6 py-4 text-left text-white font-semibold uppercase tracking-wider text-sm">
                                    Tanggal Dikembalikan
                                </th>
                                <th class="px-6 py-4 text-left text-white font-semibold uppercase tracking-wider text-sm">
                                    Total Denda
                                </th>
                                <th class="py-4 px-6 text-center text-white font-semibold uppercase tracking-wider text-sm">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-[#D2C8AA]/20">
                            @forelse ($data_pengembalian as $index => $pengembalian)
                                <tr
                                    class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-50/50' }} hover:bg-[#F67103]/5 transition-all">
                                    {{-- Checkbox select all --}}
                                    <td class="px-6 py-4 text-center">
                                        <input type="checkbox" name="ids[]" value="{{ $pengembalian->id_pengembalian }}"
                                            class="checkbox-item w-5 h-5">
                                    </td>
                                    <td class="px-6 py-4 text-center font-semibold text-gray-800">{{ $pengembalian->id_pengembalian }}</td>
                                    <td class="px-6 py-4">{{ $pengembalian->peminjaman->siswa->nama }}</td>
                                    <td class="px-6 py-4">{{ $pengembalian->tanggal_dikembalikan }}</td>
                                    <td class="px-6 py-4">Rp. {{ $pengembalian->denda }}</td>
                                    <td class=" py-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('pengembalian.show', $pengembalian->id_pengembalian) }}"
                                                class="group relative flex p-2 border-2 border-[#49777B] rounded-full hover:bg-blue-100 hover:shadow-lg transition-all duration-200 w-9 h-9 justify-center items-center overflow-hidden">
                                                <i
                                                    class="bx bx-eye absolute opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-lg"></i>
                                                <i
                                                    class="bx bx-eye-closed absolute opacity-100 group-hover:opacity-0 transition-opacity duration-300 text-lg"></i>
                                            </a>

                                            {{-- <a href="{{ route('pengembalian.edit', $pengembalian->id_pengembalian) }}"
                                                class="group relative flex p-2 border-2 border-[#49777B] rounded-full hover:bg-green-100 hover:shadow-lg transition-all duration-200 w-9 h-9 justify-center items-center overflow-hidden">
                                                <i
                                                    class='bx bx-pencil-sparkles absolute opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-lg'></i>
                                                <i
                                                    class='bxr bx-pencil absolute opacity-100 group-hover:opacity-0 transition-opacity duration-300 text-lg'></i>
                                            </a> --}}
                                            <button type="button"
                                                onclick="if(confirm('Yakin hapus pengembalian ini?')) document.getElementById('delete-form-{{ $pengembalian->id_pengembalian }}').submit();"
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
                                        pengembalian</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
        @foreach ($data_pengembalian as $pengembalian)
            <form id="delete-form-{{ $pengembalian->id_pengembalian }}" action="{{ route('pengembalian.delete', $pengembalian->id_pengembalian) }}"
                method="POST" style="display:none;">
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
                alert('Pilih minimal satu pengembalian untuk dihapus.');
            } else if (!confirm('Yakin ingin menghapus pengembalian terpilih?')) {
                e.preventDefault();
            }
        });
    </script>

@endsection


