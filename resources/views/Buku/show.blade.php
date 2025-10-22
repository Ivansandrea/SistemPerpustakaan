@extends('layouts.main')

@section('title', 'Detail Buku')

@section('content')
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-2xl font-bold text-[#49777B]">Detail Informasi Buku</h2>
            <p class="text-gray-600 text-sm mt-1">Informasi lengkap tentang buku yang dipilih</p>
        </div>
        <a href="{{ route('buku.index') }}"
            class="flex items-center bg-gray-100 text-gray-700 px-6 py-3 rounded-xl hover:bg-gray-200 hover:shadow-lg transition-all duration-300 font-semibold border-2 border-gray-200">
            <i class='bxr  bx-arrow-left-stroke text-2xl'></i> 
            Kembali
        </a>
    </div>

    <!-- Content Card -->
    <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl overflow-hidden border border-[#D2C8AA]/30">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 p-8">

            <!-- Foto Buku Section -->
            <div class="lg:col-span-1">
                <div class="sticky top-6">
                    <div class="bg-white rounded-2xl shadow-lg p-6 border-2 border-[#D2C8AA]">
                        <div class="relative group">
                            <img src="{{ asset('images/' . $buku->foto) }}" alt="{{ $buku->judul_buku }}"
                                class="w-full h-96 object-cover rounded-xl shadow-md group-hover:shadow-2xl transition-all duration-300">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 rounded-xl flex items-end p-4">
                                <p class="text-white text-sm font-semibold">{{ $buku->judul_buku }}</p>
                            </div>
                        </div>

                        <!-- Status Stok Badge -->
                        <div class="mt-4 text-center">
                            <div
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl font-bold text-lg shadow-md
                                {{ $buku->stok > 5
                                    ? 'bg-gradient-to-r from-green-100 to-green-50 text-green-700 border-2 border-green-200'
                                    : ($buku->stok > 0
                                        ? 'bg-gradient-to-r from-yellow-100 to-yellow-50 text-yellow-700 border-2 border-yellow-200'
                                        : 'bg-gradient-to-r from-red-100 to-red-50 text-red-700 border-2 border-red-200') }}">
                                <i class='bxr  bx-cube text-2xl'></i>
                                {{ $buku->stok }} Unit Tersedia
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Detail Section -->
            <div class="lg:col-span-2">
                <div class="space-y-6">

                    <!-- Kode & Judul -->
                    <div class="bg-white rounded-2xl shadow-md p-6 border border-[#D2C8AA]/30">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-3">
                                    <span
                                        class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-bold bg-gradient-to-r from-[#49777B] to-[#3a6166] text-white shadow-md">
                                        <i class='bxr  bx-hashtag text-xl text-white mr-2'></i>
                                        {{ $buku->kode_buku }}
                                    </span>
                                </div>
                                <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $buku->judul_buku }}</h1>
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="bg-white rounded-2xl shadow-md p-6 border border-[#D2C8AA]/30">
                        <div class="flex items-center gap-2 mb-4">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-[#F67103]/20 to-[#D4800C]/20 rounded-lg flex items-center justify-center">
                                <i class='bxr  bx-file-detail text-xl text-[#F67103]'></i>
                            </div>
                            <h3 class="text-xl font-bold text-[#49777B]">Deskripsi Buku</h3>
                        </div>
                        <div class="bg-gradient-to-br from-gray-50 to-white rounded-xl p-4 border border-[#D2C8AA]/20">
                            <p class="text-gray-700 leading-relaxed">{{ $buku->deskripsi }}</p>
                        </div>
                    </div>

                    <!-- Informasi Tambahan -->
                    <div class="bg-white rounded-2xl shadow-md p-6 border border-[#D2C8AA]/30">
                        <div class="flex items-center gap-2 mb-4">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-[#49777B]/20 to-[#3a6166]/20 rounded-lg flex items-center justify-center">
                                <i class='bxr  bx-info-square text-xl text-[#49777B]'></i>
                            </div>
                            <h3 class="text-xl font-bold text-[#49777B]">Informasi Detail</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Kode Buku -->
                            <div class="bg-gradient-to-br from-gray-50 to-white rounded-xl p-4 border border-[#D2C8AA]/20">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-[#49777B]/10 rounded-lg flex items-center justify-center">
                                        <i class='bxr  bx-hashtag text-xl text-[#49777B]'></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 font-medium">Kode Buku</p>
                                        <p class="text-lg font-bold text-gray-800">{{ $buku->kode_buku }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Stok -->
                            <div class="bg-gradient-to-br from-gray-50 to-white rounded-xl p-4 border border-[#D2C8AA]/20">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-[#F67103]/10 rounded-lg flex items-center justify-center">
                                        <i class='bxr  bx-cube text-xl text-[#F67103]'></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 font-medium">Jumlah Stok</p>
                                        <p class="text-lg font-bold text-gray-800">{{ $buku->stok }} Unit</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Status Ketersediaan -->
                            <div class="bg-gradient-to-br from-gray-50 to-white rounded-xl p-4 border border-[#D2C8AA]/20">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                        <i class='bxr  bx-check-circle text-xl text-green-600'></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 font-medium">Status</p>
                                        <p
                                            class="text-lg font-bold {{ $buku->stok > 0 ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $buku->stok > 0 ? 'Tersedia' : 'Stok Habis' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-4">
                        <a href="{{ route('buku.edit', $buku->id_buku) }}"
                            class="flex-1 flex items-center justify-center gap-2 bg-gradient-to-r from-[#F67103] to-[#D4800C] text-white px-6 py-4 rounded-xl hover:from-[#D4800C] hover:to-[#F67103] hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300 font-semibold text-lg">
                            <i class='bxr  bx-edit text-2xl'></i>
                            Edit Buku
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
