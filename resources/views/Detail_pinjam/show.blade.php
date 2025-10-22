@extends('layouts.main')

@section('title', 'Detail Peminjaman')

@section('content')
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-2xl font-bold text-[#49777B]">Detail Peminjaman Buku</h2>
            <p class="text-gray-600 text-sm mt-1">Informasi detail peminjaman buku</p>
        </div>
        <a href="{{ route('detail_pinjam.index') }}"
            class="flex items-center bg-gray-100 text-gray-700 px-6 py-3 rounded-xl hover:bg-gray-200 hover:shadow-lg transition-all duration-300 font-semibold border-2 border-gray-200">
            <i class='bxr  bx-arrow-left-stroke text-2xl'  ></i> 
            Kembali
        </a>
    </div>

    <!-- Content Card -->
    <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl overflow-hidden border border-[#D2C8AA]/30">
        <div class="    p-8">

            <!-- Information Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Foto Buku Section -->
                <div class="lg:col-span-1">
                    <div class="sticky top-6">
                        <div class="bg-white rounded-2xl shadow-lg p-6 border-2 border-[#D2C8AA]">
                            <div class="relative group mb-4">
                                <img src="{{ asset('images/' . $detail_pinjam->buku->foto) }}"
                                    alt="{{ $detail_pinjam->buku->judul_buku }}"
                                    class="w-full h-96 object-cover rounded-xl shadow-md group-hover:shadow-2xl transition-all duration-300">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 rounded-xl flex items-end p-4">
                                    <p class="text-white text-sm font-semibold">{{ $detail_pinjam->buku->judul_buku }}</p>
                                </div>
                            </div>

                            <!-- Info Buku -->
                            <div class="space-y-3">
                                <div
                                    class="bg-gradient-to-br from-gray-50 to-white rounded-xl p-3 border border-[#D2C8AA]/20">
                                    <p class="text-xs text-gray-500 font-medium mb-1">Kode Buku</p>
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-bold bg-gradient-to-r from-[#49777B] to-[#3a6166] text-white shadow-md">
                                        {{ $detail_pinjam->buku->kode_buku }}
                                    </span>
                                </div>
                                <div
                                    class="bg-gradient-to-br from-gray-50 to-white rounded-xl p-3 border border-[#D2C8AA]/20">
                                    <p class="text-xs text-gray-500 font-medium mb-1">Judul Buku</p>
                                    <p class="text-base font-bold text-gray-800">{{ $detail_pinjam->buku->judul_buku }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Detail Section -->
                <div class="lg:col-span-2">
                    <div class="space-y-5">
                        <!-- Detail ID Card -->
                        <div class="bg-gradient-to-r from-[#49777B] to-[#3a6166] rounded-2xl p-6 shadow-xl">
                            <div class="flex items-center justify-between text-white">
                                <div class="flex items-center gap-4">
                                    <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                                        <i class='bxr  bx-hashtag text-3xl'  ></i> 
                                    </div>
                                    <div>
                                        <p class="text-sm text-white/80 font-medium mb-1">ID Detail Peminjaman</p>
                                        <p class="text-2xl font-bold">
                                            #{{ str_pad($detail_pinjam->id_detail_pinjam, 5, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-white/80 font-medium mb-1">ID Buku</p>
                                    <p class="text-xl font-bold">{{ $detail_pinjam->id_buku }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- Baris 1: Info Peminjam -->
                        <div class="bg-white rounded-2xl shadow-md p-6 border border-[#D2C8AA]/30">
                            <div class="flex items-center gap-2 mb-6">
                                <div
                                    class="w-10 h-10 bg-gradient-to-br from-[#49777B]/20 to-[#3a6166]/20 rounded-lg flex items-center justify-center">
                                    <i class='bxr  bx-user text-[#49777B] text-xl'  ></i> 
                                </div>
                                <h3 class="text-xl font-bold text-[#49777B]">Informasi Peminjam</h3>
                            </div>

                            <div class="bg-gradient-to-br from-gray-50 to-white rounded-xl p-4 border border-[#D2C8AA]/20">
                                <div class="flex items-start gap-3">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-br from-[#49777B] to-[#3a6166] rounded-full flex items-center justify-center flex-shrink-0">
                                        <i class='bxr  bx-user text-white text-xl'  ></i> 
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-xs text-gray-500 font-medium mb-1">Nama Peminjam</p>
                                        <p class="text-lg font-bold text-gray-800">
                                            {{ $detail_pinjam->peminjaman->siswa->nama }}</p>
                                        <p class="text-sm text-gray-500 mt-1">ID Peminjaman:
                                            #{{ str_pad($detail_pinjam->id_peminjaman, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Baris 2: Jumlah & Status -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <!-- Jumlah Pinjam -->
                            <div class="bg-white rounded-2xl shadow-md p-6 border border-[#D2C8AA]/30">
                                <div class="flex items-center gap-2 mb-6">
                                    <div
                                        class="w-10 h-10 bg-gradient-to-br from-blue-100 to-blue-50 rounded-lg flex items-center justify-center">
                                        <i class='bxr  bx-layers-down-right text-xl text-blue-600'></i>
                                    </div>
                                    <h3 class="text-xl font-bold text-[#49777B]">Jumlah Pinjam</h3>
                                </div>

                                <div
                                    class="bg-gradient-to-br from-gray-50 to-white rounded-xl p-4 border border-[#D2C8AA]/20">
                                    <p class="text-xs text-gray-500 font-medium mb-2">Jumlah Buku yang Dipinjam</p>
                                    <div class="flex items-center gap-3">
                                        <span
                                            class="inline-flex items-center justify-center p-2 rounded-xl font-bold text-3xl bg-gradient-to-r from-blue-100 to-blue-50 text-blue-700 border-2 border-blue-200 shadow-md">
                                            {{ $detail_pinjam->jumlah_pinjam }}
                                        </span>
                                        <span class="text-lg text-gray-600">Eksemplar</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Status Pinjam -->
                            <div class="bg-white rounded-2xl shadow-md p-6 border border-[#D2C8AA]/30">
                                <div class="flex items-center gap-2 mb-6">
                                    <div
                                        class="w-10 h-10 bg-gradient-to-br from-green-100 to-green-50 rounded-lg flex items-center justify-center">
                                        <i class='bxr  bx-clipboard-plus text-green-600 text-xl'></i>
                                    </div>
                                    <h3 class="text-xl font-bold text-[#49777B]">Status Peminjaman</h3>
                                </div>

                                <div
                                    class="bg-gradient-to-br from-gray-50 to-white rounded-xl p-4 border border-[#D2C8AA]/20">
                                    <p class="text-xs text-gray-500 font-medium mb-2">Status Saat Ini</p>
                                    <span
                                        class="inline-flex items-center px-6 py-3 rounded-xl font-bold text-xl shadow-md
                                        {{ strtolower($detail_pinjam->status_pinjam) == 'dipinjam'
                                            ? 'bg-gradient-to-r from-yellow-100 to-yellow-50 text-yellow-700 border-2 border-yellow-200'
                                            : (strtolower($detail_pinjam->status_pinjam) == 'dikembalikan'
                                                ? 'bg-gradient-to-r from-green-100 to-green-50 text-green-700 border-2 border-green-200'
                                                : 'bg-gradient-to-r from-gray-100 to-gray-50 text-gray-700 border-2 border-gray-200') }}">
                                        {{ ucfirst($detail_pinjam->status_pinjam) }}
                                    </span>
                                </div>
                            </div>

                        </div>



                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex flex-col sm:flex-row gap-4">
                @if ($detail_pinjam->status_pinjam === 'dipinjam')
                    <a href="{{ route('detail_pinjam.edit', $detail_pinjam->id_detail_pinjam) }}"
                        class="flex-1 flex items-center justify-center gap-2 bg-gradient-to-r from-[#F67103] to-[#D4800C] text-white px-6 py-3 rounded-xl hover:from-[#D4800C] hover:to-[#F67103] hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300 font-semibold">
                        <i class='bxr  bx-edit text-xl'  ></i> 
                        Edit Detail
                    </a>
                    <form action="{{ route('detail_pinjam.delete', $detail_pinjam->id_detail_pinjam) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus detail peminjaman ini?')" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-red-500 to-red-600 text-white px-6 py-3 rounded-xl hover:from-red-600 hover:to-red-700 hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300 font-semibold">
                            <i class='bxr  bx-trash text-xl '  ></i> 
                            Hapus Detail
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
