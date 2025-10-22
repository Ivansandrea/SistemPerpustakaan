@extends('layouts.main')

@section('title', 'Tambah Siswa')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Edit Siswa</h2>
        {{-- <a href="{{ route('siswa.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-400">
            ← Kembali
        </a> --}}
    </div>

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full mx-auto border border-gray-100">
        <form action="{{ route('siswa.update', $data_siswa->id_siswa) }}" method="POST" enctype="multipart/form-data"
            id="siswaForm" class="grid grid-cols-2 gap-8">
            @csrf
            @method('PUT')

            {{-- kolom kiri --}}
            <div class="flex flex-col space-y-6">
                {{-- Kode siswa --}}
                <div class="relative">
                    <label for="nama" class=" text-sm font-semibold text-gray-700 mb-1 flex items-center gap-2">
                        Nama
                    </label>
                    <input type="text" name="nama" id="nama" placeholder="Contoh: A1234"
                        value="{{ $data_siswa->nama }}"
                        class="w-full px-4 py-3 bg-gradient-to-br from-gray-50 to-white border-2 border-[#D2C8AA] rounded-xl 
                        focus:outline-none focus:border-[#F67103] focus:ring-4 focus:ring-[#F67103]/10 
                        transition-all duration-300 font-medium text-gray-800
                        hover:border-[#49777B] hover:shadow-md
                        @error('nama') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror"
                        required>
                </div>

                {{-- Kelas --}}
                <div class="relative">
                    <label for="kelas" class="text-sm font-semibold text-gray-700 mb-1 flex items-center gap-2">
                         Kelas
                    </label>
                    <select name="kelas" id="kelas"
                        class="w-full px-4 py-3 bg-gradient-to-br from-gray-50 to-white border-2 border-[#D2C8AA] rounded-xl
                                focus:outline-none focus:border-[#F67103] focus:ring-4 focus:ring-[#F67103]/10
                                transition-all duration-300 font-medium text-gray-800
                                hover:border-[#49777B] hover:shadow-md
                                @error('kelas') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror"
                        required>
                        <option value="" disabled>Pilih Kelas</option>

                        <option value="X-1" {{ old('kelas', $data_siswa->kelas) == 'X-2' ? 'selected' : '' }}>X-1</option>
                        <option value="X-2" {{ old('kelas', $data_siswa->kelas) == 'X-2' ? 'selected' : '' }}>X-2</option>
                        <option value="X-3" {{ old('kelas', $data_siswa->kelas) == 'X-2' ? 'selected' : '' }}>X-3</option>
                        <option value="XI-1" {{ old('kelas', $data_siswa->kelas) == 'X-2' ? 'selected' : '' }}>XI-1</option>
                        <option value="XI-2" {{ old('kelas', $data_siswa->kelas) == 'X-2' ? 'selected' : '' }}>XI-2</option>
                        <option value="XI-3" {{ old('kelas', $data_siswa->kelas) == 'X-2' ? 'selected' : '' }}>XI-3</option>
                        <option value="XII-1" {{ old('kelas', $data_siswa->kelas) == 'X-2' ? 'selected' : '' }}>XII-1</option>
                        <option value="XII-2" {{ old('kelas', $data_siswa->kelas) == 'X-2' ? 'selected' : '' }}>XII-2</option>
                        <option value="XII-3" {{ old('kelas', $data_siswa->kelas) == 'X-2' ? 'selected' : '' }}>XII-3</option>
                    </select>
                </div>


                {{-- Foto --}}
                <div class="relative">
                    <label for="foto_siswa" class=" text-sm font-semibold text-gray-700 mb-1 flex items-center gap-2">
                        Foto Siswa
                    </label>
                    <input type="file" name="foto_siswa" id="foto_siswa" accept="image/*"
                        class="w-full px-4 py-2 bg-gradient-to-br from-gray-50 to-white border-2 border-[#D2C8AA] rounded-xl 
                        focus:outline-none focus:border-[#F67103] focus:ring-4 focus:ring-[#F67103]/10 
                        transition-all duration-300
                        hover:border-[#49777B] hover:shadow-md
                        file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 
                        file:text-sm file:font-semibold file:bg-gradient-to-r file:from-[#49777B] file:to-[#3a6166]
                        file:text-white file:cursor-pointer 
                        hover:file:from-[#F67103] hover:file:to-[#D4800C]
                        file:transition-all file:duration-300 file:shadow-md
                        @error('foto_siswa') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror"
                        required onchange="previewfoto_siswa(event)">
                    <img id="preview-foto_siswa" src="#" alt="Preview foto_siswa"
                        class="absolute mt-2 h-20 rounded shadow border hidden">
                </div>
            </div>

            {{-- kolom kanan --}}
            <div class="flex flex-col space-y-5">
                {{-- Deskripsi --}}
                <div class="relative">
                    <label for="nisn" class=" text-sm font-semibold text-gray-700 mb-1 flex items-center gap-2">
                        NISN
                    </label>
                    <input type="number" name="nisn" id="nisn" maxlength="10" placeholder="Contoh: 1234567890"
                        value="{{ $data_siswa->nama }}"
                        class="w-full px-4 py-3 bg-gradient-to-br from-gray-50 to-white border-2 border-[#D2C8AA] rounded-xl 
                        focus:outline-none focus:border-[#F67103] focus:ring-4 focus:ring-[#F67103]/10 
                        transition-all duration-300 font-medium text-gray-800
                        hover:border-[#49777B] hover:shadow-md
                        @error('nisn') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror"
                        required>
                </div>


                {{-- Stok --}}
                <div class="relative">
                    <label for="jurusan" class="text-sm font-semibold text-gray-700 mb-1 flex items-center gap-2">
                        Jurusan
                    </label>
                    <select name="jurusan" id="jurusan"
                        class="w-full px-4 py-3 bg-gradient-to-br from-gray-50 to-white border-2 border-[#D2C8AA] rounded-xl
                                focus:outline-none focus:border-[#F67103] focus:ring-4 focus:ring-[#F67103]/10
                                transition-all duration-300 font-medium text-gray-800
                                hover:border-[#49777B] hover:shadow-md
                                @error('jurusan') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror"
                        required>
                        <option value="" disabled selected>Pilih jurusan</option>
                        <option value="DKV" {{ old('jurusan', $data_siswa->jurusan) == 'DKV' ? 'selected' : '' }}>DKV</option>
                        <option value="RPL" {{ old('jurusan', $data_siswa->jurusan) == 'RPL' ? 'selected' : '' }}>RPL</option>
                        <option value="TKJ" {{ old('jurusan', $data_siswa->jurusan) == 'TKJ' ? 'selected' : '' }}>TKJ</option>
                        <option value="TJKT" {{ old('jurusan', $data_siswa->jurusan) == 'TJKT' ? 'selected' : '' }}>TJKT</option>
                        <option value="TITL" {{ old('jurusan', $data_siswa->jurusan) == 'TITL' ? 'selected' : '' }}>TITL</option>
                    </select>
                </div>
            </div>
    </div>

    {{-- Tombol --}}
    <div class="col-span-2 gap-4 flex justify-center mt-6">
        <a href="{{ route('siswa.index') }}"
            class="px-8 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl
                    hover:bg-gray-200 hover:shadow-lg transition-all duration-300 
                    border-2 border-gray-200 hover:border-gray-300 flex items-center gap-2">
            <i class='bxr  bx-x text-xl'  ></i> 
            Batal
        </a>
        <button type="submit"
            class="px-8 py-3 bg-gradient-to-r from-[#F67103] to-[#D4800C] text-white font-semibold rounded-xl
                    hover:from-[#D4800C] hover:to-[#F67103] hover:shadow-xl hover:-translate-y-0.5
                    transition-all duration-300 flex items-center gap-2">
            <i class='bxr  bx-check text-xl'  ></i> 
            Simpan siswa
        </button>
    </div>
    </form>
    </div>

    <script>
        function previewfoto_siswa(event) {
            const input = event.target;
            const preview = document.getElementById('preview-foto_siswa');
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
