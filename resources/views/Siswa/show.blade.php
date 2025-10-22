@extends('layouts.main')

@section('title', 'Detail Siswa')

@section('content')
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-2xl font-bold text-[#49777B]">Detail Informasi Siswa</h2>
            <p class="text-gray-600 text-sm mt-1">Informasi lengkap tentang siswa yang dipilih</p>
        </div>
        <a href="{{ route('siswa.index') }}"  
            class="flex items-center bg-gray-100 text-gray-700 px-6 py-3 rounded-xl hover:bg-gray-200 hover:shadow-lg transition-all duration-300 font-semibold border-2 border-gray-200">
            <i class='bxr  bx-arrow-left-stroke text-2xl'  ></i> 
            Kembali
        </a>
    </div>

    <!-- Content Card -->
    <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl overflow-hidden border border-[#D2C8AA]/30">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 p-8">
            
            <!-- Profile Section -->
            <div class="lg:col-span-1">
                <div class="sticky top-6">
                    <div class="bg-white rounded-2xl shadow-lg p-6 border-2 border-[#D2C8AA]">
                        <!-- Avatar -->
                        <div class="relative group mb-6">
                            <div class="w-full aspect-square bg-gradient-to-br from-[#49777B] to-[#3a6166] rounded-2xl flex items-center justify-center shadow-xl">
                                <img src="{{ asset('images_siswa/' . $siswa->foto_siswa) }}" 
                                 alt="{{ $siswa->foto_siswa }}" 
                                 class="w-full h-96 object-cover rounded-xl shadow-md group-hover:shadow-2xl transition-all duration-300">
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 rounded-2xl flex items-end p-4">
                                <p class="text-white text-sm font-semibold">{{ $siswa->nama }}</p>
                            </div>
                        </div>
                        
                        <!-- Nama & NISN -->
                        <div class="text-center mb-6">
                            <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $siswa->nama }}</h3>
                            <p class="text-sm text-gray-500 font-medium mb-4">NISN: {{ $siswa->nisn }}</p>
                            
                            <!-- Badge Kelas & Jurusan -->
                            <div class="flex flex-col gap-2">
                                <div class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl font-bold bg-gradient-to-r from-[#49777B] to-[#3a6166] text-white shadow-md">
                                   <i class='bxr  bx-buildings text-xl'  ></i> 
                                    Kelas {{ $siswa->kelas }}
                                </div>
                                <div class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl font-bold bg-gradient-to-r from-[#F67103] to-[#D4800C] text-white shadow-md">
                                    <i class='bxr  bx-backpack text-xl'  ></i> 
                                    {{ $siswa->jurusan }}
                                </div>
                            </div>
                        </div>

                        <!-- Quick Stats -->
                        <div class="grid grid-cols-2 gap-3">
                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-3 text-center border border-blue-200">
                                <p class="text-xs text-blue-600 font-medium mb-1">Status</p>
                                <p class="text-lg font-bold text-blue-700">Aktif</p>
                            </div>
                            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-3 text-center border border-green-200">
                                <p class="text-xs text-green-600 font-medium mb-1">Pinjaman</p>
                                <p class="text-lg font-bold text-green-700">0 Buku</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Detail Section -->
            <div class="lg:col-span-2">
                <div class="space-y-6">
                    
                    <!-- Informasi Pribadi -->
                    <div class="bg-white rounded-2xl shadow-md p-6 border border-[#D2C8AA]/30">
                        <div class="flex items-center gap-2 mb-6">
                            <div class="w-10 h-10 bg-gradient-to-br from-[#49777B]/20 to-[#3a6166]/20 rounded-lg flex items-center justify-center">
                                <i class='bxr  bx-user text-xl text-[#49777B]'  ></i> 
                            </div>
                            <h3 class="text-xl font-bold text-[#49777B]">Informasi Pribadi</h3>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Nama Lengkap -->
                            <div class="bg-gradient-to-br from-gray-50 to-white rounded-xl p-4 border border-[#D2C8AA]/20">
                                <div class="flex items-start gap-3">
                                    <div class="w-10 h-10 bg-[#49777B]/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i class='bxr  bx-user text-lg text-[#49777B]'  ></i> 
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs text-gray-500 font-medium mb-1">Nama Lengkap</p>
                                        <p class="text-base font-bold text-gray-800 break-words">{{ $siswa->nama }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- NISN -->
                            <div class="bg-gradient-to-br from-gray-50 to-white rounded-xl p-4 border border-[#D2C8AA]/20">
                                <div class="flex items-start gap-3">
                                    <div class="w-10 h-10 bg-[#F67103]/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i class='bxr  bx-hashtag text-lg text-[#F67103]'  ></i> 
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs text-gray-500 font-medium mb-1">NISN</p>
                                        <p class="text-base font-bold text-gray-800">{{ $siswa->nisn }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Akademik -->
                    <div class="bg-white rounded-2xl shadow-md p-6 border border-[#D2C8AA]/30">
                        <div class="flex items-center gap-2 mb-6">
                            <div class="w-10 h-10 bg-gradient-to-br from-[#F67103]/20 to-[#D4800C]/20 rounded-lg flex items-center justify-center">
                                <i class='bxr  bx-book-open text-xl text-[#F67103]'  ></i> 
                            </div>
                            <h3 class="text-xl font-bold text-[#49777B]">Informasi Akademik</h3>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Kelas -->
                            <div class="bg-gradient-to-br from-gray-50 to-white rounded-xl p-4 border border-[#D2C8AA]/20">
                                <div class="flex items-start gap-3">
                                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i class='bxr  bx-buildings text-lg text-blue-600'  ></i> 
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs text-gray-500 font-medium mb-1">Kelas</p>
                                        <p class="text-base font-bold text-gray-800">{{ $siswa->kelas }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Jurusan -->
                            <div class="bg-gradient-to-br from-gray-50 to-white rounded-xl p-4 border border-[#D2C8AA]/20">
                                <div class="flex items-start gap-3">
                                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i class='bxr  bx-briefcase text-lg text-purple-600'  ></i> 
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs text-gray-500 font-medium mb-1">Jurusan</p>
                                        <p class="text-base font-bold text-gray-800">{{ $siswa->jurusan }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Riwayat Peminjaman -->
                    <div class="bg-white rounded-2xl shadow-md p-6 border border-[#D2C8AA]/30">
                        <div class="flex items-center gap-2 mb-6">
                            <div class="w-10 h-10 bg-gradient-to-br from-green-100 to-green-50 rounded-lg flex items-center justify-center">
                                <i class='bxr  bx-clipboard-detail text-xl text-green-600'  ></i> 
                            </div>
                            <h3 class="text-xl font-bold text-[#49777B]">Riwayat Peminjaman</h3>
                        </div>
                        
                        <div class="bg-gradient-to-br from-gray-50 to-white rounded-xl p-6 border border-[#D2C8AA]/20 text-center">
                            <i class='bxr  bx-book-open text-6xl text-gray-400'  ></i> 
                            <p class="text-gray-500 font-semibold mb-1">Belum ada riwayat peminjaman</p>
                            <p class="text-gray-400 text-sm">Siswa ini belum pernah meminjam buku</p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-4">
                        <a href="{{ route('siswa.edit', $siswa->id_siswa) }}" 
                            class="flex-1 flex items-center justify-center gap-2 bg-gradient-to-r from-[#F67103] to-[#D4800C] text-white px-6 py-4 rounded-xl hover:from-[#D4800C] hover:to-[#F67103] hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300 font-semibold text-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit Data Siswa
                        </a>
                        <form action="{{ route('siswa.delete', $siswa->id_siswa) }}" method="POST" 
                            onsubmit="return confirm('Yakin ingin menghapus data siswa ini?')"
                            class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-red-500 to-red-600 text-white px-6 py-4 rounded-xl hover:from-red-600 hover:to-red-700 hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300 font-semibold text-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Hapus Siswa
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection