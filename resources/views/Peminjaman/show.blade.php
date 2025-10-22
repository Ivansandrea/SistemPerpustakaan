@extends('layouts.main')

@section('title', 'Detail Peminjaman')

@section('content')
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-2xl font-bold text-[#49777B]">Detail Informasi Peminjaman</h2>
            <p class="text-gray-600 text-sm mt-1">Informasi lengkap tentang peminjaman buku</p>
        </div>
        <a href="{{ route('peminjaman.index') }}"
            class="flex items-center bg-gray-100 text-gray-700 px-6 py-3 rounded-xl hover:bg-gray-200 hover:shadow-lg transition-all duration-300 font-semibold border-2 border-gray-200">
            <i class='bxr  bx-arrow-left-stroke text-2xl'></i>
            Kembali
        </a>
    </div>

    <!-- Content Card -->
    <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl overflow-hidden border border-[#D2C8AA]/30">
        <div class="p-8">

            <!-- Information Grid -->
            <div class="space-y-2">

                <!-- Data Peminjam & Status - Grid 2 Kolom (Satu Baris) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">

                    <!-- Informasi Peminjam -->
                    <div class="bg-white rounded-2xl shadow-md p-3 border border-[#D2C8AA]/30">
                        <div class="flex items-center gap-2 mb-2">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-[#49777B]/20 to-[#3a6166]/20 rounded-lg flex items-center justify-center">
                                <i class='bxr  bx-user text-[#49777B] text-xl'></i>
                            </div>
                            <h3 class="text-xl font-bold text-[#49777B]">Data Peminjam</h3>
                        </div>

                        <div class="bg-gradient-to-br from-gray-50 to-white rounded-xl p-4 border border-[#D2C8AA]/20">
                            <p class="text-xs text-gray-500 font-medium">Nama Siswa</p>
                            <p class="text-lg font-bold text-gray-800">{{ $peminjaman->siswa->nama }}</p>
                            <p class="text-xs text-gray-500 font-medium">Id Peminjaman <span
                                    class="text-sm text-white rounded-full px-1 bg-[#49777B]">#{{ $peminjaman->id_peminjaman }}</span>
                            </p>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="bg-white rounded-2xl shadow-md p-3 border border-[#D2C8AA]/30">
                        <div class="flex items-center gap-2 mb-2">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-[#F67103]/20 to-[#D4800C]/20 rounded-lg flex items-center justify-center">
                                <i class='bxr  bx-clipboard-detail text-[#F67103] text-xl'></i>
                            </div>
                            <h3 class="text-xl font-bold text-[#49777B]">Status</h3>
                        </div>

                        <div class="bg-gradient-to-br from-gray-50 to-white rounded-xl p-4 border border-[#D2C8AA]/20">
                            <p class="text-xs text-gray-500 font-medium mb-2">Status Saat Ini</p>
                            <span
                                class="inline-flex items-center px-4 py-2 rounded-lg font-bold text-lg
                                {{ $peminjaman->status == 'dipinjam'
                                    ? 'bg-yellow-100 text-yellow-700 border-2 border-yellow-200'
                                    : ($peminjaman->status == 'selesai'
                                        ? 'bg-green-100 text-green-700 border-2 border-green-200'
                                        : 'bg-red-100 text-red-700 border-2 border-red-200') }}">
                                {{ $peminjaman->status }}
                            </span>
                        </div>
                    </div>

                </div>

                <!-- Tanggal Pinjam & Kembali - Grid 2 Kolom (Satu Baris) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">

                    <!-- Tanggal Pinjam -->
                    <div class="bg-white rounded-2xl shadow-md p-3 border border-[#D2C8AA]/30">
                        <div class="flex items-center gap-2 mb-2">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-blue-100 to-blue-50 rounded-lg flex items-center justify-center">
                                <i class='bxr  bx-calendar-alt text-blue-600 text-xl'></i>
                            </div>
                            <h3 class="text-xl font-bold text-[#49777B]">Tanggal Pinjam</h3>
                        </div>

                        <div class="bg-gradient-to-br from-gray-50 to-white rounded-xl p-4 border border-[#D2C8AA]/20">
                            <p class="text-xs text-gray-500 font-medium mb-2">Tanggal Pinjam</p>
                            <p class="text-lg font-bold text-gray-800">{{ $peminjaman->tanggal_pinjam }}</p>
                        </div>
                    </div>

                    <!-- Tanggal Kembali -->
                    <div class="bg-white rounded-2xl shadow-md p-3 border border-[#D2C8AA]/30">
                        <div class="flex items-center gap-2 mb-2">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-green-100 to-green-50 rounded-lg flex items-center justify-center">
                                <i class='bxr  bx-check-circle text-green-600 text-xl'></i>
                            </div>
                            <h3 class="text-xl font-bold text-[#49777B]">Tanggal Kembali</h3>
                        </div>

                        <div class="bg-gradient-to-br from-gray-50 to-white rounded-xl p-4 border border-[#D2C8AA]/20">
                            <p class="text-xs text-gray-500 font-medium mb-2">Tanggal Kembali</p>
                            <p class="text-lg font-bold text-gray-800">{{ $peminjaman->tanggal_kembali }}</p>
                        </div>
                    </div>

                </div>

            </div>


            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-xl shadow-md p-6 border border-[#D2C8AA]/30">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-blue-100 to-blue-50 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium mb-1">Total Buku</p>
                            <p class="text-2xl font-bold text-gray-800">{{ count($detail_pinjam) }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 border border-[#D2C8AA]/30">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-green-100 to-green-50 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium mb-1">Total Jumlah</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $detail_pinjam->sum('jumlah_pinjam') }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 border border-[#D2C8AA]/30">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-[#F67103]/20 to-[#D4800C]/20 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#F67103]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium mb-1">Status Peminjaman</p>
                            <p class="text-lg font-bold text-gray-800">Aktif</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">Daftar Buku ({{ count($detail_pinjam) }} Item)</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($detail_pinjam as $detail)
                        <div
                            class="bg-white rounded-xl shadow-xl hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-200">
                            <div class="p-3">

                                <div class="flex gap-2 items-start mb-4 pb-4 border-b border-gray-100">
                                    <div
                                        class="flex-shrink-0 w-20 h-28 bg-gray-100 rounded-lg overflow-hidden shadow-lg border border-gray-300">
                                        <img src="{{ asset('images/' . $detail->buku->foto) }}"
                                            alt="Cover Buku Placeholder" class="w-full h-full object-cover">
                                    </div>

                                    <div class="flex-grow">
                                        <h4 class="text-md font-bold text-[#49777B] mb-1"
                                            title="{{ $detail->buku->judul_buku }}">
                                            {{ $detail->buku->judul_buku }}
                                        </h4>

                                        <p class="text-sm text-gray-500">
                                            ID Detail:
                                            <span
                                                class="font-semibold text-[#3a6166]">#{{ $detail->id_detail_pinjam }}</span>
                                        </p>
                                    </div>
                                </div>

                                <div class="flex justify-between items-center mb-4">
                                    <div class="flex flex-col items-center">
                                        <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah
                                            Pinjam</span>
                                        <span class="text-2xl font-extrabold text-blue-700 mt-1">
                                            {{ $detail->jumlah_pinjam }}
                                        </span>
                                    </div>

                                    <div class="flex flex-col items-center">
                                        <span
                                            class="text-xs font-medium text-gray-500 uppercase tracking-wider">Status</span>
                                        <span
                                            class="mt-1 px-3 py-1 rounded-full text-sm font-semibold {{ $detail->status_pinjam == 'dipinjam' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                            {{ ucfirst($detail->status_pinjam) }}
                                        </span>


                                    </div>

                                </div>
                            </div>
                        </div>
                    @empty
                        <div
                            class="lg:col-span-3 col-span-1 bg-white rounded-2xl shadow-xl overflow-hidden border border-[#D2C8AA]/30">
                            <div class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div
                                        class="w-24 h-24 bg-gradient-to-br from-[#D2C8AA]/30 to-[#49777B]/20 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                    <p class="text-gray-500 text-lg font-semibold mb-2">Belum ada buku yang dipinjam</p>
                                    <p class="text-gray-400 text-sm">Tidak ada data detail peminjaman</p>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- <a href="{{ route('detail_pinjam.showByPeminjaman', $peminjaman->id_peminjaman) }}"
                    class=" flex items-center justify-center gap-2 bg-gradient-to-r from-[#04c43a] to-[#11a23a] text-white px-6 py-4 rounded-full hover:from-[#04af34] hover:to-[#109636] hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300 font-semibold text-lg">
                    <i class='bxr  bx-file-detail text-2xl'></i>
                    Lihat Detail Peminjaman
                </a> --}}
                <a href="{{ route('peminjaman.edit', $peminjaman->id_peminjaman) }}"
                    class=" flex items-center justify-center gap-2 bg-gradient-to-r from-[#F67103] to-[#D4800C] text-white px-6 py-4 rounded-full hover:from-[#D4800C] hover:to-[#F67103] hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300 font-semibold text-lg">
                    <i class='bxr  bx-edit text-2xl'></i>
                    Edit Peminjaman
                </a>
                <form action="{{ route('peminjaman.delete', $peminjaman->id_peminjaman) }}" method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus data peminjaman ini?')" class="">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-red-500 to-red-600 text-white px-6 py-4 rounded-full hover:from-red-600 hover:to-red-700 hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300 font-semibold text-lg">
                        <i class='bxr  bx-trash text-2xl'></i>
                        Hapus Peminjaman
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
