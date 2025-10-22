@extends('layouts.main')

@section('title', 'Data Detail Pengembalian')

@section('content')
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-2xl font-bold text-[#49777B]">Daftar Detail Pengembalian</h2>
            <p class="text-gray-600 text-sm mt-1">Kelola semua koleksi buku perpustakaan</p>
        </div>
    </div>

    <div class="relative">
        <!-- Search & Filter Section -->
        <div class="mb-6 flex gap-4">
            <div class="flex-1">
                <div class="relative">
                    <form action="{{ route('detail_pengembalian.index') }}" method="GET" class="relative gap-2">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari Nama atau Id Detail Pengembalian..."
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
            <p>Menampilkan <span class="font-semibold text-[#49777B]">{{ count($data_detail_pengembalian) }}</span> Detail
                Pengembalian</p>
        </div>

        <!-- Table Section -->
        {{-- <form action="{{ route('pengembalian.deleteSelected') }}" method="POST" id="formdeleteSelected">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="absolute top-0 flex items-center justify-center text-2xl text-[#3a6166] border-2 border-[#49777B] rounded-xl hover:bg-red-100 px-3 py-3">
                <i class='bx bx-trash'></i>
            </button> --}}

        <div
            class="bg-gradient-to-br from-white to-gray-50 rounded-xl shadow-lg overflow-hidden border border-[#D2C8AA]/30">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-[#49777B] to-[#3a6166]">
                            {{-- <th class="px-6 py-4 text-center text-white font-semibold uppercase tracking-wider text-sm">
                                <input type="checkbox" id="selectAll" class="w-5 h-5">
                            </th> --}}
                            <th class="px-6 py-4 text-center text-white font-semibold uppercase text-sm">
                                Id Detail Pengembalian
                            </th>
                            <th class="px-6 py-4 text-center text-white font-semibold uppercase text-sm">
                                Nama Siswa
                            </th>
                            <th class="px-6 py-4 text-center text-white font-semibold uppercase text-sm">
                                Id Detail Pinjam
                            </th>
                            <th class="px-6 py-4 text-center text-white font-semibold uppercase text-sm">
                                Judul Buku
                            </th>
                            <th class="px-6 py-4 text-center text-white font-semibold uppercase text-sm">
                                Jumlah Kembali
                            </th>
                            <th class="px-6 py-4 text-center text-white font-semibold uppercase text-sm">
                                Denda Buku
                            </th>
                            <th class="py-4 px-6 text-center text-white font-semibold uppercase tracking-wider text-sm">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-[#D2C8AA]/20">
                        @forelse ($data_detail_pengembalian as $index => $detail_pengembalian)
                            @php
                                $bisaHapus = $detail_pengembalian->status_pinjam === 'dipinjam';
                            @endphp

                            <tr
                                class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-50/50' }} hover:bg-[#F67103]/5 transition-all">
                                {{-- <td class="px-6 py-4 text-center">
                                    <input type="checkbox" name="ids[]"
                                        value="{{ $detail_pengembalian->id_detail_pengembalian }}"
                                        class="checkbox-item w-5 h-5" {{ $bisaHapus ? '' : 'disabled' }}>
                                </td> --}}
                                <td class="text-center px-6 py-4">{{ $detail_pengembalian->id_detail_pengembalian }}
                                </td>
                                <td class="text-center px-6 py-4">{{ $detail_pengembalian->pengembalian->peminjaman->siswa->nama }}</td>
                                <td class="text-center px-6 py-4 text-gray-600">
                                    {{ $detail_pengembalian->id_detail_pinjam }}</td>
                                <td class="text-center px-6 py-4">{{ $detail_pengembalian->buku->judul_buku }}</td>
                                <td class="text-center px-6 py-4">{{ $detail_pengembalian->jumlah_kembali }}</td>
                                <td class="text-center px-6 py-4">Rp. {{ $detail_pengembalian->denda_buku }}</td>

                                <td class="py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('detail_pengembalian.show', $detail_pengembalian->id_detail_pengembalian) }}"
                                            class="group relative flex p-2 border-2 border-[#49777B] rounded-full hover:bg-blue-100 hover:shadow-lg transition-all duration-200 w-9 h-9 justify-center items-center overflow-hidden">
                                            <i
                                                class="bx bx-eye absolute opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-lg"></i>
                                            <i
                                                class="bx bx-eye-closed absolute opacity-100 group-hover:opacity-0 transition-opacity duration-300 text-lg"></i>
                                        </a>

                                        {{-- <a href="{{ route('detail_pengembalian.edit', $detail_pengembalian->id_detail_pengembalian) }}"
                                                class="group relative flex p-2 border-2 border-[#49777B] rounded-full hover:bg-green-100 hover:shadow-lg transition-all duration-200 w-9 h-9 justify-center items-center overflow-hidden">
                                                <i class='bx bx-pencil-sparkles absolute opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-lg'></i>
                                                <i class='bx bx-pencil absolute opacity-100 group-hover:opacity-0 transition-opacity duration-300 text-lg'></i>
                                            </a>

                                            @if ($bisaHapus)
                                                <button type="button"
                                                    onclick="if(confirm('Yakin hapus detail pinjam ini?')) document.getElementById('delete-form-{{ $detail_pengembalian->id_detail_pengembalian }}').submit();"
                                                    class="group relative flex p-2 border-2 border-[#49777B] rounded-full hover:bg-red-100 hover:shadow-lg transition-all duration-200 w-9 h-9 justify-center items-center overflow-hidden">
                                                    <i class='bx bx-trash absolute opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-lg'></i>
                                                    <i class='bx bx-trash-alt absolute opacity-100 group-hover:opacity-0 transition-opacity duration-300 text-lg'></i>
                                                </button>
                                            @else
                                                <span class="text-gray-400 text-xs italic">Tidak bisa hapus</span>
                                            @endif --}}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-gray-500 font-semibold">
                                    Belum ada data detail pinjam
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        {{-- </form> --}}

        @foreach ($data_detail_pengembalian as $detail_pengembalian)
            <form id="delete-form-{{ $detail_pengembalian->id_detail_pengembalian }}"
                action="{{ route('detail_pengembalian.delete', $detail_pengembalian->id_detail_pengembalian) }}"
                method="POST" style="display:none;">
                @csrf
                @method('DELETE')
            </form>
        @endforeach
    </div>

    {{-- <script>
        document.getElementById('selectAll').addEventListener('change', function() {
            const items = document.querySelectorAll('.checkbox-item:not(:disabled)');
            items.forEach(cb => cb.checked = this.checked);
        });

        document.getElementById('formdeleteSelected').addEventListener('submit', function(e) {
            const checked = document.querySelectorAll('.checkbox-item:checked');
            if (checked.length === 0) {
                e.preventDefault();
                alert('Pilih minimal satu Detail Pinjam untuk dihapus.');
            } else if (!confirm('Yakin ingin menghapus Detail Pinjam terpilih?')) {
                e.preventDefault();
            }
        });
    </script> --}}
@endsection

