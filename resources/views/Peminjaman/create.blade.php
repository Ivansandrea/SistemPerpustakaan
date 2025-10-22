@extends('layouts.main')

@section('title', 'Tambah Peminjaman')

@section('content')
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-2xl font-bold text-[#49777B]">Form Peminjaman Buku</h2>
            <p class="text-gray-600 text-sm mt-1">Tambahkan data peminjaman buku baru</p>
        </div>
    </div>

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full mx-auto border border-[#D2C8AA]/30">
        <form action="{{ route('peminjaman.store') }}" method="POST" enctype="multipart/form-data" id="peminjamanForm"
            class="space-y-8">
            @csrf

            <!-- Info Peminjam Section -->
            <div class="bg-gradient-to-br from-[#49777B]/5 to-[#D2C8AA]/5 rounded-xl p-6 border border-[#D2C8AA]/30">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    {{-- Nama Siswa --}}
                    <div class="relative md:col-span-1">
                        <label for="id_siswa"
                            class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                            Nama Siswa
                        </label>
                        <select name="id_siswa" id="id_siswa"
                            class="w-full px-4 py-3 bg-gradient-to-br from-gray-50 to-white rounded-xl 
                            focus:outline-none focus:ring-4 
                            transition-all duration-300 font-medium text-gray-800
                            hover:shadow-md
                            @error('id_siswa') border-2 border-red-400 focus:border-red-500 focus:ring-red-100 @else border-2 border-[#D2C8AA] focus:border-[#F67103] focus:ring-[#F67103]/10 hover:border-[#49777B] @enderror"
                            required>
                            <option value="" disabled {{ old('id_siswa') ? '' : 'selected' }}>Pilih Nama Siswa
                            </option>
                            @foreach ($siswa as $s)
                                <option value="{{ $s->id_siswa }}" {{ old('id_siswa') == $s->id_siswa ? 'selected' : '' }}>
                                    {{ $s->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Tanggal Pinjam --}}
                    <div class="relative md:col-span-1">
                        <label for="tanggal_pinjam"
                            class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                            Tanggal Pinjam
                        </label>
                        <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" value="{{ old('tanggal_pinjam') }}"
                            class="w-full px-4 py-3 bg-gradient-to-br from-gray-50 to-white rounded-xl 
                            focus:outline-none focus:ring-4 
                            transition-all duration-300 font-medium text-gray-800
                            hover:shadow-md
                            @error('tanggal_pinjam') border-2 border-red-400 focus:border-red-500 focus:ring-red-100 @else border-2 border-[#D2C8AA] focus:border-[#F67103] focus:ring-[#F67103]/10 hover:border-[#49777B] @enderror"
                            required>
                    </div>

                    {{-- Tanggal Kembali --}}
                    <div class="relative md:col-span-1">
                        <label for="tanggal_kembali"
                            class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                            Tanggal Kembali
                        </label>
                        <input type="date" name="tanggal_kembali" id="tanggal_kembali"
                            value="{{ old('tanggal_kembali') }}"
                            class="w-full px-4 py-3 bg-gradient-to-br from-gray-50 to-white rounded-xl 
                            focus:outline-none focus:ring-4 
                            transition-all duration-300 font-medium text-gray-800
                            hover:shadow-md
                            @error('tanggal_kembali') border-2 border-red-400 focus:border-red-500 focus:ring-red-100 @else border-2 border-[#D2C8AA] focus:border-[#F67103] focus:ring-[#F67103]/10 hover:border-[#49777B] @enderror"
                            required>
                    </div>
                </div>
            </div>

            <!-- Daftar Buku Section -->
            <div class="bg-gradient-to-br from-[#F67103]/5 to-[#D4800C]/5 rounded-xl p-6 border border-[#F67103]/30">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-2">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-[#F67103]/20 to-[#D4800C]/20 rounded-lg flex items-center justify-center">
                            <i class='bxr  bx-book-open text-xl text-[#F67103]'></i>
                        </div>
                        <h3 class="text-xl font-bold text-[#49777B]">Daftar Buku yang Dipinjam</h3>
                    </div>
                    <button type="button" onclick="addBuku()"
                        class="flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-[#F67103] to-[#D4800C] text-white rounded-lg hover:from-[#D4800C] hover:to-[#F67103] transition-all duration-300 font-semibold shadow-md hover:shadow-lg">
                        <i class='bxr  bx-plus text-lg'></i>
                        Tambah Buku
                    </button>
                </div>

                <div id="buku-wrapper" class="space-y-4">
                    {{-- Buku Pertama --}}
                    <div class="buku-row bg-white rounded-xl p-4 border-2 border-[#D2C8AA]/50 shadow-sm">
                        <div class="flex gap-3 items-start">
                            <div class="flex-1">
                                <label class="block text-xs font-semibold text-gray-600 mb-2">Pilih Buku</label>
                                <select name="buku[0][id_buku]" onchange="filterOptions()"
                                    class="buku-select w-full px-4 py-3 bg-gradient-to-br from-gray-50 to-white border-2 border-[#D2C8AA] rounded-xl 
                                    focus:outline-none focus:border-[#F67103] focus:ring-4 focus:ring-[#F67103]/10
                                    transition-all duration-300 font-medium text-gray-800
                                    hover:border-[#49777B] hover:shadow-md"
                                    required>
                                    <option value="" disabled {{ old('buku.0.id_buku') ? '' : 'selected' }}>Pilih Buku
                                    </option>
                                    @foreach ($buku as $b)
                                        <option value="{{ $b->id_buku }}"
                                            {{ old('buku.0.id_buku') == $b->id_buku ? 'selected' : '' }}>
                                            {{ $b->judul_buku }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-32">
                                <label class="block text-xs font-semibold text-gray-600 mb-2">Jumlah</label>
                                <input type="number" name="buku[0][jumlah_pinjam]" placeholder="0" min="1"
                                    class="w-full px-4 py-3 bg-gradient-to-br from-gray-50 to-white border-2 border-[#D2C8AA] rounded-xl 
                                    focus:outline-none focus:border-[#F67103] focus:ring-4 focus:ring-[#F67103]/10 
                                    transition-all duration-300 font-medium text-gray-800 text-center
                                    hover:border-[#49777B] hover:shadow-md"
                                    required>
                            </div>
                            <div class="pt-7">
                                <button type="button" disabled
                                    class="p-2 rounded-lg bg-gray-100 text-gray-400 cursor-not-allowed">
                                    <i class='bxr  bx-x'></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @if (session('error'))
                        <div class="p-3 mb-4 bg-red-100 text-red-700 border border-red-300 rounded">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
            </div>

            {{-- Tombol Submit --}}
            <div class="flex justify-center gap-4 pt-4">
                <a href="{{ route('peminjaman.index') }}"
                    class="px-8 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl
                    hover:bg-gray-200 hover:shadow-lg transition-all duration-300 
                    border-2 border-gray-200 hover:border-gray-300 flex items-center gap-2">
                    <i class='bxr  bx-x text-xl'></i>
                    Batal
                </a>
                <button type="submit"
                    class="px-8 py-3 bg-gradient-to-r from-[#F67103] to-[#D4800C] text-white font-semibold rounded-xl
                    hover:from-[#D4800C] hover:to-[#F67103] hover:shadow-xl hover:-translate-y-0.5
                    transition-all duration-300 flex items-center gap-2">
                    <i class='bxr  bx-check text-xl'></i>
                    Simpan Peminjaman
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initBukuRow(document.querySelector('.buku-row'));
        });

        let count = 1;

        function initBukuRow(row) {
            const selectBuku = row.querySelector('.buku-select');
            const inputJumlah = row.querySelector('input[type="number"]');
            let stokBuku = 0;

            // Buat elemen pesan error di bawah input jumlah
            let pesanError = document.createElement('p');
            pesanError.classList.add('text-red-500', 'text-sm', 'mt-1');
            inputJumlah.parentNode.appendChild(pesanError);

            // Ambil stok ketika buku dipilih
            selectBuku.addEventListener('change', function() {
                const idBuku = this.value;
                if (idBuku) {
                    fetch(`/cek-stok/${idBuku}`)
                        .then(res => res.json())
                        .then(data => {
                            stokBuku = data.stok;
                            pesanError.textContent = '';
                            inputJumlah.value = '';
                            inputJumlah.classList.remove('border-red-500');
                            checkAllErrors();
                        })
                        .catch(() => {
                            pesanError.textContent = '⚠️ Gagal mengambil data stok.';
                            inputJumlah.classList.add('border-red-500');
                            checkAllErrors();
                        });
                } else {
                    stokBuku = 0;
                    pesanError.textContent = '';
                    inputJumlah.classList.remove('border-red-500');
                    checkAllErrors();
                }
            });

            // Validasi real-time jumlah pinjam
            inputJumlah.addEventListener('input', function() {
                const jumlah = parseInt(this.value);
                if (jumlah > stokBuku) {
                    pesanError.textContent = `⚠️ Stok buku hanya tersisa ${stokBuku}`;
                    this.classList.add('border-red-500');
                } else {
                    pesanError.textContent = '';
                    this.classList.remove('border-red-500');
                }
                checkAllErrors();
            });
        }

        // Tambah baris buku baru
        function addBuku() {
            const wrapper = document.getElementById('buku-wrapper');
            const newRow = document.createElement('div');
            newRow.classList.add('buku-row', 'bg-white', 'rounded-xl', 'p-4', 'border-2', 'border-[#D2C8AA]/50',
                'shadow-sm');
            newRow.innerHTML = `
        <div class="flex gap-3 items-start">
            <div class="flex-1">
                <label class="block text-xs font-semibold text-gray-600 mb-2">Pilih Buku</label>
                <select name="buku[${count}][id_buku]" class="buku-select w-full px-4 py-3 bg-gradient-to-br from-gray-50 to-white border-2 border-[#D2C8AA] rounded-xl 
                    focus:outline-none focus:border-[#F67103] focus:ring-4 focus:ring-[#F67103]/10
                    transition-all duration-300 font-medium text-gray-800
                    hover:border-[#49777B] hover:shadow-md" required>
                    <option value="" disabled selected>Pilih Buku</option>
                    @foreach ($buku as $b)
                        <option value="{{ $b->id_buku }}">{{ $b->judul_buku }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-32">
                <label class="block text-xs font-semibold text-gray-600 mb-2">Jumlah</label>
                <input type="number" name="buku[${count}][jumlah_pinjam]" placeholder="0" min="1"
                    class="w-full px-4 py-3 bg-gradient-to-br from-gray-50 to-white border-2 border-[#D2C8AA] rounded-xl 
                    focus:outline-none focus:border-[#F67103] focus:ring-4 focus:ring-[#F67103]/10 
                    transition-all duration-300 font-medium text-gray-800 text-center
                    hover:border-[#49777B] hover:shadow-md" required>
            </div>
            <div class="pt-7">
                <button type="button" onclick="this.closest('.buku-row').remove(); filterOptions(); checkAllErrors();"
                    class="p-2 rounded-lg bg-red-50 text-red-500 hover:bg-red-100 hover:text-red-600 transition-all duration-300">
                    <i class='bx bx-x'></i> 
                </button>
            </div>
        </div>
    `;
            wrapper.appendChild(newRow);
            initBukuRow(newRow);
            filterOptions();
            count++;
            checkAllErrors();
        }

        // Filter buku agar tidak bisa dipilih ganda
        function filterOptions() {
            const selected = Array.from(document.querySelectorAll('.buku-select'))
                .map(s => s.value)
                .filter(v => v !== "");

            document.querySelectorAll('.buku-select').forEach(select => {
                Array.from(select.options).forEach(opt => {
                    if (opt.value === "") return;
                    opt.hidden = selected.includes(opt.value) && opt.value !== select.value;
                });
            });
        }

        // ✅ Cek semua error dan kontrol tombol submit
        function checkAllErrors() {
            const errors = document.querySelectorAll('.text-red-500');
            const hasError = Array.from(errors).some(e => e.textContent.trim() !== '');
            const submitBtn = document.querySelector('button[type="submit"]');
            if (hasError) {
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
            } else {
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            }
        }
    </script>

@endsection
