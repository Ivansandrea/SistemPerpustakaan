@extends('layouts.main')

@section('title', 'Data Peminjaman')

@section('content')
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-2xl font-bold text-[#49777B]">Daftar Peminjaman</h2>
            <p class="text-gray-600 text-sm mt-1">Kelola semua koleksi buku perpustakaan</p>
        </div>
        <a href="{{ route('peminjaman.create') }}"
            class="flex items-center gap-2 bg-gradient-to-r from-[#F67103] to-[#D4800C] text-white px-6 py-3 rounded-xl hover:from-[#D4800C] hover:to-[#F67103] hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300 font-semibold">
            <i class='bxr  bx-plus text-xl'></i>
            Tambah Peminjaman
        </a>
    </div>

    <div class="relative">
        <div class="mb-6 flex gap-4">
            <div class="flex-1 ml-16">
                <div class="relative">
                    <form action="{{ route('peminjaman.index') }}" method="GET" class="relative gap-2">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari Nama atau Id Peminjaman..."
                            class="w-full pl-3 pr-10 py-3 bg-gradient-to-br from-gray-50 to-white border-2 border-[#D2C8AA] rounded-xl focus:outline-none focus:border-[#F67103] focus:ring-4 focus:ring-[#F67103]/10 transition-all duration-300">
                        <button type="submit"
                            class="absolute right-0 top-1.5 text-[#3a6166] px-4 py-2 rounded-lg transition-all"><i
                                class='bxr  bx-search text-2xl'></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="mb-2 flex justify-between items-center text-sm text-gray-600">
            <p>Menampilkan <span class="font-semibold text-[#49777B]">{{ count($data_peminjaman) }}</span> Peminjaman</p>
        </div>

        <form action="{{ route('peminjaman.deleteSelected') }}" method="POST" id="formdeleteSelected">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="absolute top-0 flex items-center justify-center text-2xl text-[#3a6166] border-2 border-[#49777B] rounded-xl hover:bg-red-100 px-3 py-3">
                <i class='bxr bx-trash'></i>
            </button>

            <div
                class="bg-gradient-to-br from-white to-gray-50 rounded-xl shadow-lg overflow-hidden border border-[#D2C8AA]/30">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gradient-to-r from-[#49777B] to-[#3a6166]">
                                <th class="px-6 py-4 text-center text-white font-semibold uppercase tracking-wider text-sm">
                                    <input type="checkbox" id="selectAll" class="w-5 h-5">
                                </th>
                                <th class="px-6 py-4 text-center text-white font-semibold uppercase tracking-wider text-sm">
                                    Id Peminjaman
                                </th>
                                <th class="px-6 py-4 text-left text-white font-semibold uppercase tracking-wider text-sm">
                                    Nama
                                </th>
                                <th class="px-6 py-4 text-left text-white font-semibold uppercase tracking-wider text-sm">
                                    Tanggal Pinjam
                                </th>
                                <th class="px-6 py-4 text-left text-white font-semibold uppercase tracking-wider text-sm">
                                    Tanggal Kembali
                                </th>
                                <th class="px-6 py-4 text-center text-white font-semibold uppercase tracking-wider text-sm">
                                    Status
                                </th>
                                <th class="py-4 text-center text-white font-semibold uppercase tracking-wider text-sm">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#D2C8AA]/20">
                            @forelse ($data_peminjaman as $index => $peminjaman)
                                @php
                                    $jumlahDipinjam = $peminjaman->detail_pinjam
                                        ->where('status_pinjam', 'dipinjam')
                                        ->count();
                                    $jumlahDikembalikan = $peminjaman->detail_pinjam
                                        ->where('status_pinjam', 'dikembalikan')
                                        ->count();
                                    $totalBuku = $peminjaman->detail_pinjam->count();

                                    // Bisa hapus jika semua masih dipinjam ATAU semua sudah dikembalikan
                                    $bisaHapus = $jumlahDipinjam === 0 || $jumlahDikembalikan === 0;
                                @endphp

                                <tr
                                    class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-50/50' }} hover:bg-[#F67103]/5 transition-all">
                                    <td class="px-6 py-4 text-center">
                                        <input type="checkbox" name="ids[]" value="{{ $peminjaman->id_peminjaman }}"
                                            class="checkbox-item w-5 h-5" {{ $bisaHapus ? '' : 'disabled' }}>

                                    </td>
                                    <td class="px-6 py-4 text-center font-semibold text-gray-800">
                                        {{ $peminjaman->id_peminjaman }}</td>
                                    <td class="px-6 py-4 font-semibold text-gray-800">{{ $peminjaman->siswa->nama }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $peminjaman->tanggal_pinjam }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $peminjaman->tanggal_kembali }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <span
                                            class="px-3 py-1 rounded-full text-sm font-medium
                                            {{ $peminjaman->status === 'dipinjam' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700' }}">
                                            {{ ucfirst($peminjaman->status) }}
                                        </span>
                                    </td>
                                    <td class="py-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('peminjaman.show', $peminjaman->id_peminjaman) }}"
                                                class="group relative flex p-2 border-2 border-[#49777B] rounded-full hover:bg-blue-100 hover:shadow-lg transition-all duration-200 w-9 h-9 justify-center items-center overflow-hidden">
                                                <i
                                                    class="bx bx-eye absolute opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-lg"></i>
                                                <i
                                                    class="bx bx-eye-closed absolute opacity-100 group-hover:opacity-0 transition-opacity duration-300 text-lg"></i>
                                            </a>
                                            @if ($peminjaman->status === 'dipinjam')
                                                <a href="{{ route('peminjaman.edit', $peminjaman->id_peminjaman) }}"
                                                    class="group relative flex p-2 border-2 border-[#49777B] rounded-full hover:bg-green-100 hover:shadow-lg transition-all duration-200 w-9 h-9 justify-center items-center overflow-hidden">
                                                    <i
                                                        class='bx bx-pencil-sparkles absolute opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-lg'></i>
                                                    <i
                                                        class='bxr bx-pencil absolute opacity-100 group-hover:opacity-0 transition-opacity duration-300 text-lg'></i>
                                                </a>
                                            @endif
                                            @if ($bisaHapus)
                                                <button type="button"
                                                    onclick="if(confirm('Yakin hapus peminjaman ini?')) document.getElementById('delete-form-{{ $peminjaman->id_peminjaman }}').submit();"
                                                    class="group relative flex p-2 border-2 border-[#49777B] rounded-full hover:bg-red-100 hover:shadow-lg transition-all duration-200 w-9 h-9 justify-center items-center overflow-hidden">
                                                    <i
                                                        class='bxr bx-trash absolute opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-lg'></i>
                                                    <i
                                                        class='bxr bx-trash-alt absolute opacity-100 group-hover:opacity-0 transition-opacity duration-300 text-lg'></i>
                                                </button>
                                            @else
                                                {{-- tidak bisa hapus --}}
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center text-gray-500 font-semibold">Belum ada
                                        data Peminjaman</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </form>

        @foreach ($data_peminjaman as $peminjaman)
            <form id="delete-form-{{ $peminjaman->id_peminjaman }}"
                action="{{ route('peminjaman.delete', $peminjaman->id_peminjaman) }}" method="POST" style="display:none;">
                @csrf
                @method('DELETE')
            </form>
        @endforeach
    </div>

    <script>
        document.getElementById('selectAll').addEventListener('change', function() {
            const items = document.querySelectorAll('.checkbox-item');
            items.forEach(cb => {
                if (!cb.disabled) cb.checked = this.checked;
            });
        });

        document.getElementById('formdeleteSelected').addEventListener('submit', function(e) {
            const checked = document.querySelectorAll('.checkbox-item:checked');
            if (checked.length === 0) {
                e.preventDefault();
                alert('Pilih minimal satu peminjaman yang bisa dihapus.');
            } else if (!confirm('Yakin ingin menghapus peminjaman terpilih?')) {
                e.preventDefault();
            }
        });
    </script>
@endsection
