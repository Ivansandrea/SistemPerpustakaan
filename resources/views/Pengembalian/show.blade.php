@extends('layouts.main')

@section('title', 'Detail Pengembalian')

@section('content')
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-2xl font-bold text-[#49777B]">Detail Informasi Pengembalian</h2>
            <p class="text-gray-600 text-sm mt-1">Informasi lengkap tentang pengembalian buku</p>
        </div>
        <a href="{{ route('pengembalian.index') }}"
            class="flex items-center gap-2 bg-gray-100 text-gray-700 px-6 py-3 rounded-xl hover:bg-gray-200 hover:shadow-lg transition-all duration-300 font-semibold border-2 border-gray-200">
            <i class='bxr  bx-arrow-left-stroke text-2xl'></i>
            Kembali
        </a>
    </div>

    <!-- Content Card -->
    <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl overflow-hidden border border-[#D2C8AA]/30">
        <div class="p-8">

            <!-- Information Grid -->
            <div class="space-y-6">

                <!-- Baris 1: Info Peminjam & Tanggal Dikembalikan -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Info Peminjam -->
                    <div class="bg-white rounded-2xl shadow-md p-6 border border-[#D2C8AA]/30">
                        <div class="flex items-center gap-2 mb-6">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-[#49777B]/20 to-[#3a6166]/20 rounded-lg flex items-center justify-center">
                                <i class='bxr  bx-user text-[#49777B] text-xl'></i>
                            </div>
                            <h3 class="text-xl font-bold text-[#49777B]">Informasi Peminjam</h3>
                        </div>

                        <div class="bg-gradient-to-br from-gray-50 to-white rounded-xl p-4 border border-[#D2C8AA]/20">
                            <div class="flex items-start gap-3">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-[#49777B] to-[#3a6166] rounded-full flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs text-gray-500 font-medium mb-1">Nama Peminjam</p>
                                    <p class="text-lg font-bold text-gray-800">{{ $pengembalian->peminjaman->siswa->nama }}
                                    </p>
                                    <p class="text-sm text-gray-500 mt-1">ID Peminjaman:
                                        #{{ str_pad($pengembalian->id_peminjaman, 5, '0', STR_PAD_LEFT) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tanggal Dikembalikan -->
                    <div class="bg-white rounded-2xl shadow-md p-6 border border-[#D2C8AA]/30">
                        <div class="flex items-center gap-2 mb-6">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-green-100 to-green-50 rounded-lg flex items-center justify-center">
                                <i class='bxr  bx-calendar-alt text-green-600 text-xl'  ></i> 
                            </div>
                            <h3 class="text-xl font-bold text-[#49777B]">Tanggal Dikembalikan</h3>
                        </div>

                        <div class="bg-gradient-to-br from-gray-50 to-white rounded-xl p-4 border border-[#D2C8AA]/20">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class='bxr  bx-check-circle text-green-600 text-2xl'  ></i> 
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs text-gray-500 font-medium mb-1">Tanggal Pengembalian</p>
                                    <p class="text-lg font-bold text-gray-800">
                                        {{ \Carbon\Carbon::parse($pengembalian->tanggal_dikembalikan)->format('d F Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Detail ID Card -->
                <div class="bg-gradient-to-r from-[#49777B] to-[#3a6166] rounded-2xl p-6 shadow-xl">
                    <div class="flex items-center justify-between text-white">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                                <i class='bxr  bx-hashtag text-4xl'  ></i> 
                            </div>
                            <div>
                                <p class="text-sm text-white/80 font-medium mb-1">ID Pengembalian</p>
                                <p class="text-2xl font-bold">
                                    #{{ str_pad($pengembalian->id_pengembalian, 5, '0', STR_PAD_LEFT) }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-center text-white/80 font-medium mb-1">Status</p>
                            <span
                                class="inline-flex items-center px-4 py-2 rounded-xl bg-green-500 text-white font-bold text-lg shadow-md">
                                Selesai
                            </span>
                        </div>
                    </div>
                </div>
                
                <!-- Baris 3: Total Denda -->
                <div class="bg-gradient-to-r from-red-50 to-orange-50 rounded-2xl shadow-md p-6 border-2 border-red-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-red-500 to-orange-500 rounded-full flex items-center justify-center shadow-lg">
                                <i class='bxr  bx-dollar-circle text-3xl text-white'  ></i>  
                            </div>
                            <div>
                                <p class="text-sm text-red-600 font-medium mb-1">Total Denda</p>
                                <p class="text-4xl font-bold text-red-700">Rp
                                    {{ number_format($pengembalian->denda, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Daftar Buku yang Dikembalikan -->
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-6">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-[#F67103]/20 to-[#D4800C]/20 rounded-lg flex items-center justify-center">
                            <i class='bxr  bx-book text-[#F67103] text-xl'  ></i> 
                        </div>
                        <h3 class="text-xl font-bold text-[#49777B]">Buku yang Dikembalikan</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @forelse ($pengembalian->detail_pengembalian as $detail)
                            <div
                                class="flex flex-col md:flex-row bg-white rounded-2xl p-5 border border-[#D2C8AA]/40 shadow-md hover:shadow-lg transition-all duration-300">
                                <!-- Foto Buku -->
                                <img src="{{ asset('images/' . $detail->buku->foto) }}"
                                    alt="{{ $detail->buku->judul_buku }}"
                                    class="w-36 h-48 object-cover rounded-xl border-2 border-[#D2C8AA] shadow-sm mb-4 md:mb-0 md:mr-5">

                                <!-- Info Buku -->
                                <div class="flex-1 flex flex-col justify-between">
                                    <div>
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-gradient-to-r from-[#49777B] to-[#3a6166] text-white shadow-md mb-2">
                                            {{ $detail->buku->kode_buku }}
                                        </span>
                                        <h4 class="text-lg font-bold text-gray-800 mb-1">
                                            {{ $detail->buku->judul_buku }}
                                        </h4>
                                        <div class="relative group">
                                            <p class="text-sm text-gray-600 line-clamp-2 mb-3 cursor-help">
                                                {{ $detail->buku->deskripsi }}
                                            </p>

                                            <!-- Tooltip -->
                                            <div
                                                class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 w-64 bg-gray-800 text-white text-xs rounded-lg px-3 py-2 opacity-0 group-hover:opacity-100 group-hover:translate-y-[-4px] transition-all duration-300 z-10 shadow-lg pointer-events-none">
                                                {{ $detail->buku->deskripsi }}
                                            </div>
                                        </div>

                                    </div>

                                    <!-- Info Jumlah & Denda -->
                                    <div class="grid grid-cols-2 gap-3 mt-2">
                                        <div class="bg-green-50 rounded-lg p-3 border border-green-200 shadow-sm">
                                            <div class="flex items-center gap-2 mb-1">
                                                <i class='bxr  bx-check text-green-600 text-lg' ></i> 
                                                <p class="text-xs font-semibold text-gray-700 uppercase">Jumlah</p>
                                            </div>
                                            <p class="text-xl font-bold text-green-700">{{ $detail->jumlah_kembali }} Buku
                                            </p>
                                        </div>

                                        <div
                                            class="bg-red-50 rounded-lg p-3 border border-red-300  {{ $detail->denda_buku }} shadow-sm">
                                            <div class="flex items-center gap-2 mb-1">
                                                <i class='bxr  bx-dollar-circle text-red-600 text-lg'  ></i> 
                                                <p class="text-xs font-semibold text-gray-700 uppercase">Denda</p>
                                            </div>
                                            <p
                                                class="text-xl font-bold text-red-700 {{ $detail->denda_buku }}">
                                                Rp {{ number_format($detail->denda_buku, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div
                                class="bg-gradient-to-br from-gray-50 to-white rounded-xl p-12 text-center border border-[#D2C8AA]/20">
                                <div
                                    class="w-24 h-24 bg-gradient-to-br from-[#D2C8AA]/30 to-[#49777B]/20 rounded-full flex items-center justify-center mb-4 mx-auto">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <p class="text-gray-500 text-lg font-semibold mb-2">Tidak ada buku yang dikembalikan</p>
                                <p class="text-gray-400 text-sm">Belum ada data buku untuk pengembalian ini</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
