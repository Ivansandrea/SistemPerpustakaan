@extends('layouts.main')

@section('title', 'Beranda')

@section('content')
    <!-- Hero Section -->
    <div
        class="mb-12 bg-gradient-to-r from-[#49777B] via-[#3a6166] to-[#49777B] rounded-3xl p-12 shadow-2xl relative overflow-hidden">
        <!-- Decorative circles -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -mr-32 -mt-32"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full -ml-24 -mb-24"></div>

        <div class="relative z-10 text-white">
            <div class="flex items-center justify-between">
                <div class="max-w-2xl">
                    <h1 class="text-5xl font-bold mb-4 leading-tight">
                        Selamat Datang di <br>
                        <span class="text-[#F67103]">Perpustakaan Digital</span>
                    </h1>
                    <p class="text-xl text-white/90 mb-6">
                        Temukan koleksi buku terbaik untuk menambah wawasan dan pengetahuan Anda
                    </p>
                    <div class="flex gap-4">
                        <a href="#bukubuku"
                            class="px-8 py-4 bg-gradient-to-r from-[#F67103] to-[#D4800C] rounded-xl font-bold text-lg hover:from-[#D4800C] hover:to-[#F67103] hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 flex items-center gap-2">
                            <i class='bx bx-book-open text-2xl'></i>
                            Lihat Semua Buku
                        </a>
                        <a href="{{ route('peminjaman.create') }}"
                            class="px-8 py-4 bg-white/10 backdrop-blur-sm border-2 border-white/30 rounded-xl font-bold text-lg hover:bg-white/20 hover:shadow-xl transition-all duration-300 flex items-center gap-2">
                            <i class='bx bx-plus-circle text-2xl'></i>
                            Pinjam Buku
                        </a>
                    </div>
                </div>
                <div class="hidden lg:block">
                    <div
                        class="w-64 h-64 bg-gradient-to-br from-[#F67103]/20 to-[#D4800C]/20 rounded-full flex items-center justify-center backdrop-blur-sm border-4 border-white/20">
                        <i class='bx bxs-book-heart text-9xl text-white/80'></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
        <div
            class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border-2 border-blue-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 bg-blue-500 rounded-xl flex items-center justify-center shadow-lg">
                    <i class='bx bx-book text-3xl text-white'></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600 font-medium">Total Buku</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $buku->count() }}</p>
                </div>
            </div>
        </div>

        <div
            class="bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-6 border-2 border-green-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 bg-green-500 rounded-xl flex items-center justify-center shadow-lg">
                    <i class='bx bx-user text-3xl text-white'></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600 font-medium">Total Siswa</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $siswa->count() }}</p>
                </div>
            </div>
        </div>

        <div
            class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-2xl p-6 border-2 border-yellow-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 bg-yellow-500 rounded-xl flex items-center justify-center shadow-lg">
                    <i class='bxr  bx-clipboard-minus  text-3xl text-white'  ></i> 
                </div>
                <div>
                    <p class="text-sm text-gray-600 font-medium">Dipinjam</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $peminjaman->count() }}</p>
                </div>
            </div>
        </div>

        <div
            class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl p-6 border-2 border-purple-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 bg-purple-500 rounded-xl flex items-center justify-center shadow-lg">
                    <i class='bxr  bx-clipboard-plus text-3xl text-white'  ></i> 
                </div>
                <div>
                    <p class="text-sm text-gray-600 font-medium">Dikembalikan</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $pengembalian->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Title -->
    <section id="bukubuku">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-bold text-[#49777B] mb-2">Koleksi Buku Terbaru</h2>
                <p class="text-gray-600">Jelajahi koleksi buku terbaru di perpustakaan kami</p>
            </div>
            <a href="{{ route('buku.index') }}"
                class="flex items-center gap-2 text-[#F67103] font-semibold hover:text-[#D4800C] transition-colors">
                Lihat Semua
                <i class='bx bx-right-arrow-alt text-2xl'></i>
            </a>
        </div>

        <!-- Books Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse ($buku as $b)
                <div
                    class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border border-[#D2C8AA]/30">
                    <!-- Image Container -->
                    <div class="relative overflow-hidden bg-gradient-to-br from-[#D2C8AA]/20 to-[#49777B]/10">
                        <img src="{{ asset('images/' . $b->foto) }}" alt="{{ $b->judul_buku }}"
                            class="w-full h-96 object-cover group-hover:scale-110 transition-transform duration-500">

                        <!-- Stock Badge -->
                        <div class="absolute top-3 right-3">
                            <span
                                class="px-3 py-1 rounded-full text-xs font-bold shadow-lg backdrop-blur-sm
                            {{ $b->stok > 5 ? 'bg-green-500 text-white' : ($b->stok > 0 ? 'bg-yellow-500 text-white' : 'bg-red-500 text-white') }}">
                                {{ $b->stok > 0 ? 'Tersedia' : 'Habis' }}
                            </span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-5">
                        <!-- Code Badge -->
                        <div class="mb-3">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-gradient-to-r from-[#49777B] to-[#3a6166] text-white shadow-md">
                                {{ $b->kode_buku }}
                            </span>
                        </div>

                        <!-- Title -->
                        <h3
                            class="text-lg font-bold text-gray-800 mb-2 line-clamp-2 group-hover:text-[#F67103] transition-colors">
                            {{ $b->judul_buku }}
                        </h3>

                        <!-- Description -->
                        <p class="text-sm text-gray-600 mb-4 line-clamp-2 cursor-default tooltip-text"
                            data-tooltip="{{ $b->deskripsi }}">
                            {{ Str::limit($b->deskripsi, 100) }}
                        </p>




                        <!-- Footer -->
                        <div class="flex items-center justify-between pt-3 border-t border-[#D2C8AA]/30">
                            <div class="flex items-center gap-2">
                                <i class='bx bx-package text-[#49777B] text-lg'></i>
                                <span class="text-sm font-semibold text-gray-700">Stok: {{ $b->stok }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-4 text-center py-20">
                    <div
                        class="w-32 h-32 bg-gradient-to-br from-[#D2C8AA]/30 to-[#49777B]/20 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class='bx bx-book text-6xl text-gray-400'></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-600 mb-2">Belum Ada Buku</h3>
                    <p class="text-gray-500 mb-6">Koleksi buku akan ditampilkan di sini</p>
                    <a href="{{ route('buku.create') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-[#F67103] to-[#D4800C] text-white rounded-xl font-semibold hover:shadow-lg transition-all">
                        <i class='bx bx-plus text-xl'></i>
                        Tambah Buku Pertama
                    </a>
                </div>
            @endforelse
        </div>
    </section>

    <script>
        document.querySelectorAll('.tooltip-text').forEach(el => {
            const tooltip = document.createElement('div');
            tooltip.className = 'tooltip-box';
            tooltip.textContent = el.dataset.tooltip;
            document.body.appendChild(tooltip);

            el.addEventListener('mouseenter', e => {
                tooltip.style.opacity = '1';
            });

            el.addEventListener('mousemove', e => {
                tooltip.style.top = (e.clientY - 10) + 'px'; // muncul di atas kursor
                tooltip.style.left = (e.clientX + 20) + 'px';
            });

            el.addEventListener('mouseleave', () => {
                tooltip.style.opacity = '0';
            });
        });
    </script>

@endsection
