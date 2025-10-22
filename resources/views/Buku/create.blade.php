@extends('layouts.main')

@section('title', 'Tambah Buku')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Tambah Buku</h2>
        {{-- <a href="{{ route('buku.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-400">
            ← Kembali
        </a> --}}
    </div>

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full mx-auto border border-gray-100">
        
        <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data" id="bukuForm"
            class="grid grid-cols-2 gap-8">
            @csrf

            {{-- kolom kiri --}}
            <div class="flex flex-col space-y-6">
                {{-- Kode Buku --}}
                <div class="relative">
                    <label for="kode_buku" class=" text-sm font-semibold text-gray-700 mb-1 flex items-center gap-2">
                        Kode Buku
                    </label>
                    <input type="text" name="kode_buku" id="kode_buku" maxlength="5" placeholder="Contoh: A1234"
                        value="{{ old('kode_buku') }}"
                        class="w-full px-4 py-3 bg-gradient-to-br from-gray-50 to-white border-2 border-[#D2C8AA] rounded-xl 
                        focus:outline-none focus:border-[#F67103] focus:ring-4 focus:ring-[#F67103]/10 
                        transition-all duration-300 font-medium text-gray-800
                        hover:border-[#49777B] hover:shadow-md
                        @error('kode_buku') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror"
                        required>
                    @error('kode_buku')
                        <p class="text-red-500 text-xs mt-2 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Judul Buku --}}
                <div class="relative">
                    <label for="judul_buku" class=" text-sm font-semibold text-gray-700 mb-1 flex items-center gap-2">
                        Judul Buku
                    </label>
                    <input type="text" name="judul_buku" id="judul_buku" value="{{ old('judul_buku') }}"
                        placeholder="Masukkan judul buku"
                        class="w-full px-4 py-3 bg-gradient-to-br from-gray-50 to-white border-2 border-[#D2C8AA] rounded-xl 
                        focus:outline-none focus:border-[#F67103] focus:ring-4 focus:ring-[#F67103]/10 
                        transition-all duration-300 font-medium text-gray-800
                        hover:border-[#49777B] hover:shadow-md
                        @error('judul_buku') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror"
                        required>
                    @error('judul_buku')
                        <p class="text-red-500 text-xs mt-2 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Foto --}}
                <div class="relative">
                    <label for="foto" class=" text-sm font-semibold text-gray-700 mb-1 flex items-center gap-2">
                        Foto Buku
                    </label>
                    <input type="file" name="foto" id="foto" accept="image/*"
                        class="w-full px-4 py-2 bg-gradient-to-br from-gray-50 to-white border-2 border-[#D2C8AA] rounded-xl 
                        focus:outline-none focus:border-[#F67103] focus:ring-4 focus:ring-[#F67103]/10 
                        transition-all duration-300
                        hover:border-[#49777B] hover:shadow-md
                        file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 
                        file:text-sm file:font-semibold file:bg-gradient-to-r file:from-[#49777B] file:to-[#3a6166]
                        file:text-white file:cursor-pointer 
                        hover:file:from-[#F67103] hover:file:to-[#D4800C]
                        file:transition-all file:duration-300 file:shadow-md
                        @error('foto') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror"
                        required onchange="previewFoto(event)">
                    <img id="preview-foto" src="#" alt="Preview Foto" class="absolute mt-2 h-20 rounded shadow border hidden">
                    @error('foto')
                        <p class="text-red-500 text-xs mt-2 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            {{-- kolom kanan --}}
            <div class="flex flex-col space-y-5">
                {{-- Deskripsi --}}
                <div class="relative">
                    <label for="deskripsi" class=" text-sm font-semibold text-gray-700 mb-1 flex items-center gap-2">
                        Deskripsi
                    </label>
                    <textarea name="deskripsi" id="deskripsi" rows="5" placeholder="Tuliskan deskripsi singkat tentang buku..."
                        class="w-full px-4 py-3.5 bg-gradient-to-br from-gray-50 to-white border-2 border-[#D2C8AA] rounded-xl 
                        focus:outline-none focus:border-[#F67103] focus:ring-4 focus:ring-[#F67103]/10 
                        transition-all duration-300 font-medium text-gray-800 resize-none
                        hover:border-[#49777B] hover:shadow-md
                        @error('deskripsi') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror"
                        required>{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="text-red-500 text-xs mt-2 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Stok --}}
                <div class="relative">
                    <label for="stok" class=" text-sm font-semibold text-gray-700 mb-1 flex items-center gap-2">
                        Stok
                    </label>
                    <input type="number" name="stok" id="stok" min="0" value="{{ old('stok') }}"
                        placeholder="Jumlah stok tersedia"
                        class="w-full px-4 py-3 bg-gradient-to-br from-gray-50 to-white border-2 border-[#D2C8AA] rounded-xl 
                        focus:outline-none focus:border-[#F67103] focus:ring-4 focus:ring-[#F67103]/10 
                        transition-all duration-300 font-medium text-gray-800
                        hover:border-[#49777B] hover:shadow-md
                        @error('stok') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror"
                        required>
                    @error('stok')
                        <p class="text-red-500 text-xs mt-2 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            {{-- Tombol --}}
            <div class="col-span-2 gap-4 flex justify-center mt-6">
                <a href="{{ route('buku.index') }}"
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
                    Simpan Buku
                </button>
            </div>
        </form>
    </div>

    <script>
        function previewFoto(event) {
            const input = event.target;
            const preview = document.getElementById('preview-foto');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '#';
                preview.classList.add('hidden');
            }
        }
    </script>
@endsection
