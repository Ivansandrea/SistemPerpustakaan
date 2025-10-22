@extends('layouts.main')

@section('title', 'Edit Peminjaman')

@section('content')
    <div class="flex items-center mb-4">
        <h2 class="text-xl font-semibold mr-2">Edit Peminjaman : </h2>

            <h1 class="px-2 py-1 bg-green-100 text-green-700 font-bold rounded-xl"> {{ $data_peminjaman->siswa->nama }}</h1>
    </div>

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full mx-auto border border-gray-100">
        <form action="{{ route('peminjaman.update', $data_peminjaman->id_peminjaman) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-2 gap-8">
            @csrf
            @method('PUT')


            {{-- kolom kiri --}}
            <div class="flex flex-col space-y-6">
                {{-- Tanggal Pinjam --}}
                <div class="relative">
                    <label for="tanggal_pinjam" class=" text-sm font-semibold text-gray-700 mb-1 flex items-center gap-2">
                        Tanggal Pinjam
                    </label>
                    <input type="date" name="tanggal_pinjam" id="tanggal_pinjam"
                        value="{{ $data_peminjaman->tanggal_pinjam }}"
                        class="w-full px-4 py-3 bg-gradient-to-br from-gray-50 to-white border-2 border-[#D2C8AA] rounded-xl 
                        focus:outline-none focus:border-[#F67103] focus:ring-4 focus:ring-[#F67103]/10 
                        transition-all duration-300 font-medium text-gray-800
                        hover:border-[#49777B] hover:shadow-md
                        @error('tanggal_pinjam') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror"
                        required>
                </div>
            </div>

            {{-- kolom kanan --}}
            <div class="flex flex-col space-y-5">
                <div class="relative">
                    <label for="tanggal_kembali" class=" text-sm font-semibold text-gray-700 mb-1 flex items-center gap-2">
                        Tanggal Kembali
                    </label>
                    <input type="date" name="tanggal_kembali" id="tanggal_kembali"
                        value="{{ $data_peminjaman->tanggal_kembali }}"
                        class="w-full px-4 py-3 bg-gradient-to-br from-gray-50 to-white border-2 border-[#D2C8AA] rounded-xl 
                        focus:outline-none focus:border-[#F67103] focus:ring-4 focus:ring-[#F67103]/10 
                        transition-all duration-300 font-medium text-gray-800
                        hover:border-[#49777B] hover:shadow-md
                        @error('tanggal_kembali') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror"
                        required>
                </div>
            </div>
    </div>

    {{-- Tombol --}}
    <div class="col-span-2 gap-4 flex justify-center mt-6">
        <a href="{{ route('peminjaman.index') }}"
            class="px-8 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl
                    hover:bg-gray-200 hover:shadow-lg transition-all duration-300 
                    border-2 border-gray-200 hover:border-gray-300 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            Batal
        </a>
        <button type="submit"
            class="px-8 py-3 bg-gradient-to-r from-[#F67103] to-[#D4800C] text-white font-semibold rounded-xl
                    hover:from-[#D4800C] hover:to-[#F67103] hover:shadow-xl hover:-translate-y-0.5
                    transition-all duration-300 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            Simpan Peminjaman
        </button>
    </div>
    </form>
    </div>
@endsection
