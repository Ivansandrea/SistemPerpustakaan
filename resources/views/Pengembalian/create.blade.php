@extends('layouts.main')

@section('title', 'Tambah Pengembalian')

@section('content')
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-2xl font-bold text-[#49777B]">Form Pengembalian Buku</h2>
            <p class="text-gray-600 text-sm mt-1">Proses pengembalian buku yang dipinjam</p>
        </div>
        <a href="{{ route('pengembalian.index') }}"
            class="flex items-center bg-gray-100 text-gray-700 px-6 py-3 rounded-xl hover:bg-gray-200 hover:shadow-lg transition-all duration-300 font-semibold border-2 border-gray-200">
            <i class='bxr  bx-arrow-left-stroke text-2xl'  ></i> 
            Kembali
        </a>
    </div>

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full mx-auto border border-[#D2C8AA]/30">
        <form action="{{ route('pengembalian.store') }}" method="POST" class="space-y-8">
            @csrf

            <!-- Info Peminjaman Section -->
            {{-- <div class="bg-gradient-to-br from-[#49777B]/5 to-[#D2C8AA]/5 rounded-xl p-6 border border-[#D2C8AA]/30"> --}}


            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Pilih Peminjaman --}}
                <div class="relative">
                    <label for="id_peminjaman"
                        class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                        Pilih Peminjaman
                    </label>
                    <select name="id_peminjaman" id="id_peminjaman"
                        class="w-full px-4 py-3 bg-gradient-to-br from-gray-50 to-white border-2 border-[#D2C8AA] rounded-xl 
                            focus:outline-none focus:border-[#F67103] focus:ring-4 focus:ring-[#F67103]/10
                            transition-all duration-300 font-medium text-gray-800
                            hover:border-[#49777B] hover:shadow-md"
                        required>
                        <option value="">-- Pilih Peminjaman --</option>
                        @foreach ($peminjaman as $p)
                            <option value="{{ $p->id_peminjaman }}">
                                #{{ str_pad($p->id_peminjaman, '0', STR_PAD_LEFT) }} - {{ $p->siswa->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Tanggal Pengembalian --}}
                <div class="relative">
                    <label for="tanggal_dikembalikan"
                        class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                        Tanggal Pengembalian
                    </label>
                    <input type="date" name="tanggal_dikembalikan" id="tanggal_dikembalikan"
                        class="w-full px-4 py-3 bg-gradient-to-br from-gray-50 to-white border-2 border-[#D2C8AA] rounded-xl 
                            focus:outline-none focus:border-[#F67103] focus:ring-4 focus:ring-[#F67103]/10
                            transition-all duration-300 font-medium text-gray-800
                            hover:border-[#49777B] hover:shadow-md"
                        required>
                </div>
            </div>
            {{-- </div> --}}

            <!-- Daftar Buku Section -->
            <div id="buku-list"
                class="hidden bg-gradient-to-br from-green-50/50 to-white rounded-xl p-6 border border-green-200/50">
                <div class="flex items-center gap-2 mb-6">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-green-100 to-green-50 rounded-lg flex items-center justify-center">
                        <i class='bxr  bx-book text-green-600 text-xl'  ></i> 
                    </div>
                    <h3 class="text-xl font-bold text-[#49777B]">Pilih Buku yang Dikembalikan</h3>
                </div>

                <div class="bg-white rounded-xl shadow-md overflow-hidden border border-[#D2C8AA]/30">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gradient-to-r from-[#49777B] to-[#3a6166]">
                                    <th
                                        class="px-4 py-3 text-center text-white font-semibold uppercase tracking-wider text-sm">
                                        <i class='bxr  bx-check-circle text-lg'  ></i> 
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-white font-semibold uppercase tracking-wider text-sm">
                                        Judul Buku</th>
                                    <th
                                        class="px-6 py-3 text-center text-white font-semibold uppercase tracking-wider text-sm">
                                        Jumlah Pinjam</th>
                                    <th
                                        class="px-6 py-3 text-center text-white font-semibold uppercase tracking-wider text-sm">
                                        Jumlah Kembali</th>
                                    <th
                                        class="px-6 py-3 text-center text-white font-semibold uppercase tracking-wider text-sm">
                                        Denda</th>
                                </tr>
                            </thead>
                            <tbody id="buku-tbody" class="divide-y divide-[#D2C8AA]/20"></tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Tombol Submit --}}
            <div class="flex justify-center gap-4 pt-4">
                <a href="{{ route('pengembalian.index') }}"
                    class="px-8 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl
                    hover:bg-gray-200 hover:shadow-lg transition-all duration-300 
                    border-2 border-gray-200 hover:border-gray-300 flex items-center gap-2">
                    <i class='bxr  bx-x text-xl'  ></i> 
                    Batal
                </a>
                <button type="submit"
                    class="px-8 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-semibold rounded-xl
                    hover:from-green-600 hover:to-green-700 hover:shadow-xl hover:-translate-y-0.5
                    transition-all duration-300 flex items-center gap-2">
                    <i class='bxr  bx-check text-xl'  ></i> 
                    Simpan Pengembalian
                </button>
            </div>
        </form>
    </div>

    @verbatim
        <script>
            let tanggalKembaliGlobal = null;
            let bukuData = [];

            document.getElementById('id_peminjaman').addEventListener('change', function() {
                const id = this.value;
                const tbody = document.getElementById('buku-tbody');
                const list = document.getElementById('buku-list');
                tbody.innerHTML = '';

                if (id) {
                    fetch(`/pengembalian/get-buku/${id}`)
                        .then(res => res.json())
                        .then(data => {
                            bukuData = data;
                            list.classList.remove('hidden');
                            tanggalKembaliGlobal = data[0]?.peminjaman?.tanggal_kembali || null;

                            data.forEach((item, index) => {
                                const rowClass = index % 2 === 0 ? 'bg-white' : 'bg-gray-50/50';
                                tbody.innerHTML += `
                                <tr class="${rowClass} hover:bg-[#F67103]/5 transition-all">
                                    <td class="px-4 py-4 text-center">
                                        <input type="checkbox" name="buku[${item.id_detail_pinjam}][kembalikan]" value="1"
                                            class="w-5 h-5 text-[#F67103] border-2 border-[#D2C8AA] rounded focus:ring-[#F67103] focus:ring-2">
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <p class="font-semibold text-gray-800">${item.buku.judul_buku}</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex items-center justify-center px-3 py-1 rounded-lg font-bold text-sm bg-blue-100 text-blue-700 border border-blue-200">
                                            ${item.jumlah_pinjam}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <input type="number" name="buku[${item.id_detail_pinjam}][jumlah_kembali]"
                                            value="${item.jumlah_pinjam}" min="1" max="${item.jumlah_pinjam}" readonly
                                            class="w-24 px-3 py-2 text-center border-2 border-[#D2C8AA] rounded-lg focus:outline-none focus:border-[#F67103] focus:ring-2 focus:ring-[#F67103]/10 font-semibold">
                                        <input type="hidden" name="buku[${item.id_detail_pinjam}][id_buku]" value="${item.id_buku}">
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <input type="number" id="denda-${item.id_detail_pinjam}"
                                            name="buku[${item.id_detail_pinjam}][denda]"
                                            value="0" readonly
                                            class="w-32 py-2 text-center border-2 border-red-200 rounded-lg bg-red-50 text-red-700 font-bold">
                                    </td>
                                </tr>
                            `;
                            });
                        });
                } else {
                    list.classList.add('hidden');
                }
            });

            document.getElementById('tanggal_dikembalikan').addEventListener('change', function() {
                const tglPengembalian = new Date(this.value);
                if (!tanggalKembaliGlobal) return;

                const tglKembali = new Date(tanggalKembaliGlobal);
                const selisihHari = Math.floor((tglPengembalian - tglKembali) / (1000 * 60 * 60 * 24));
                const dendaPerHari = 1000;
                const totalDenda = selisihHari > 0 ? selisihHari * dendaPerHari : 0;

                bukuData.forEach(item => {
                    const el = document.getElementById(`denda-${item.id_detail_pinjam}`);
                    if (el) el.value = totalDenda;
                });
            });
        </script>
    @endverbatim
@endsection
