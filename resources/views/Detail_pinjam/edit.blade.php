@extends('layouts.main')

@section('title', 'Edit Detail Peminjaman')

@section('content')
    <div class="flex items-center mb-4">
        <h2 class="text-xl font-semibold mr-2">Edit Detail Peminjaman : </h2>
        <h1 class="px-2 py-1 bg-green-100 text-green-700 font-bold rounded-xl">
            {{ $detail_pinjam->peminjaman->siswa->nama }}
        </h1>
    </div>

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full mx-auto border border-gray-100">
        <form action="{{ route('detail_pinjam.update', $detail_pinjam->id_detail_pinjam) }}" method="POST"
            enctype="multipart/form-data" class="grid grid-cols-2 gap-8">
            @csrf
            @method('PUT')

            {{-- Kolom kiri --}}
            <div class="flex flex-col space-y-6">
                {{-- Select Buku --}}
                <div class="relative">
                    <label for="id_buku" class="text-sm font-semibold text-gray-700 mb-1">Pilih Buku</label>
                    <select name="id_buku" id="id_buku"
                        class="w-full px-4 py-3 bg-gradient-to-br from-gray-50 to-white border-2 border-[#D2C8AA] rounded-xl
                    focus:outline-none focus:border-[#F67103] focus:ring-4 focus:ring-[#F67103]/10
                    transition-all duration-300 font-medium text-gray-800
                    hover:border-[#49777B] hover:shadow-md
                    @error('id_buku') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror"
                        {{ $detail_pinjam->status_pinjam === 'dikembalikan' ? 'disabled' : '' }} required>
                        <option value="">-- Pilih Buku --</option>
                        @foreach ($buku as $b)
                            <option value="{{ $b->id_buku }}"
                                {{ $detail_pinjam->id_buku == $b->id_buku ? 'selected' : '' }}>
                                {{ $b->judul_buku }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex flex-col space-y-5">
                {{-- Jumlah Pinjam --}}
                <div class="relative">
                    <label for="jumlah_pinjam" class="text-sm font-semibold text-gray-700 mb-1 flex items-center gap-2">
                        Jumlah Pinjam
                    </label>
                    <input type="number" name="jumlah_pinjam" id="jumlah_pinjam"
                        value="{{ $detail_pinjam->jumlah_pinjam }}"
                        class="w-full px-4 py-3 bg-gradient-to-br from-gray-50 to-white border-2 border-[#D2C8AA] rounded-xl 
                        focus:outline-none focus:border-[#F67103] focus:ring-4 focus:ring-[#F67103]/10 
                        transition-all duration-300 font-medium text-gray-800
                        hover:border-[#49777B] hover:shadow-md"
                        min="1" {{ $detail_pinjam->status_pinjam === 'dikembalikan' ? 'disabled' : '' }} required>
                </div>
            </div>

            {{-- Tombol --}}
            <div class="col-span-2 gap-4 flex justify-center mt-6">
                <a href="{{ route('detail_pinjam.index') }}"
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
    const selectBuku = document.getElementById('id_buku');
    const inputJumlah = document.getElementById('jumlah_pinjam');
    const form = document.querySelector('form');
    let stokBuku = 0;

    // Tambah elemen pesan error
    const pesanError = document.createElement('p');
    pesanError.classList.add('text-red-500', 'text-sm', 'mt-1');
    inputJumlah.parentNode.appendChild(pesanError);

    // Fungsi cek stok ke backend
    function cekStok(idBuku) {
        if (!idBuku) return;
        fetch(`/cek-stok/${idBuku}`)
            .then(res => res.json())
            .then(data => {
                stokBuku = data.stok;
                pesanError.textContent = '';
                inputJumlah.classList.remove('border-red-500');
            })
            .catch(() => {
                pesanError.textContent = '⚠️ Gagal mengambil data stok.';
                inputJumlah.classList.add('border-red-500');
            });
    }

    // Jalankan saat buku dipilih
    selectBuku.addEventListener('change', function() {
        cekStok(this.value);
    });

    // Jalankan saat pertama kali halaman dibuka (buku sudah terpilih)
    cekStok(selectBuku.value);

    // Validasi real-time jumlah pinjam
    inputJumlah.addEventListener('input', function() {
        const jumlah = parseInt(this.value);
        if (jumlah > stokBuku) {
            pesanError.textContent = `⚠️ Stok buku hanya tersisa ${stokBuku}`;
            this.classList.add('border-red-500');
            form.querySelector('button[type="submit"]').disabled = true;
            form.querySelector('button[type="submit"]').classList.add('opacity-50', 'cursor-not-allowed');
        } else {
            pesanError.textContent = '';
            this.classList.remove('border-red-500');
            form.querySelector('button[type="submit"]').disabled = false;
            form.querySelector('button[type="submit"]').classList.remove('opacity-50', 'cursor-not-allowed');
        }
    });
});
</script>
@endsection

