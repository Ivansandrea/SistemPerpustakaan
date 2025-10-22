<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Sekolah</title>
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>

    @vite('resources/css/app.css')
</head>
<style>
    * {
        scroll-behavior: smooth;
    }

    .tooltip-box {
        position: fixed;
        background-color: #1f2937;
        /* abu gelap */
        color: white;
        font-size: 0.75rem;
        border-radius: 0.5rem;
        padding: 6px 10px;
        max-width: 16rem;
        z-index: 9999;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.2s ease;
    }
</style>

<body class="bg-gradient-to-br from-[#D2C8AA]/30 via-gray-50 to-[#49777B]/20 min-h-screen">

    <!-- Sidebar Fixed -->
    <aside
        class="fixed left-0 top-0 h-screen w-64 bg-gradient-to-b from-[#49777B] to-[#3a6166] text-white flex flex-col shadow-2xl z-50">
        <div class="p-6 border-b border-white/10">
            <div class="flex items-center gap-3">
                <div
                    class="w-12 h-12 bg-gradient-to-br from-[#F67103] to-[#D4800C] rounded-xl flex items-center justify-center text-2xl shadow-lg">
                    📚
                </div>
                <a href="{{ route('beranda') }}">
                    <h2 class="text-xl font-bold">Perpustakaan</h2>
                    <p class="text-xs text-white/70">Sistem Manajemen</p>
                </a>
            </div>
        </div>

        <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
            <a href="{{ route('buku.index') }}"
                class="flex items-center gap-3 py-3 px-4 rounded-xl hover:bg-white/10 transition-all duration-300 group hover:translate-x-1">
                <span class="text-xl group-hover:scale-110 transition-transform"><i class='bxr  bx-book'></i> </span>
                <span class="font-medium">Data Buku</span>
            </a>
            <a href="{{ route('siswa.index') }}"
                class="flex items-center gap-3 py-3 px-4 rounded-xl hover:bg-white/10 transition-all duration-300 group hover:translate-x-1">
                <span class="text-xl group-hover:scale-110 transition-transform"><i class='bxr  bx-user'></i> </span>
                <span class="font-medium">Data Siswa</span>
            </a>
            <hr>
            <a href="{{ route('peminjaman.index') }}"
                class="flex items-center gap-3 py-3 px-4 rounded-xl hover:bg-white/10 transition-all duration-300 group hover:translate-x-1">
                <span class="text-xl group-hover:scale-110 transition-transform"><i class='bxr  bx-clipboard-minus'></i>
                </span>
                <span class="font-medium">Peminjaman</span>
            </a>
            <a href="{{ route('detail_pinjam.index') }}"
                class="flex items-center gap-3 py-3 px-4 rounded-xl hover:bg-white/10 transition-all duration-300 group hover:translate-x-1">
                <span class="text-xl group-hover:scale-110 transition-transform"><i
                        class='bxr  bx-clipboard-detail'></i> </span>
                <span class="font-medium">Detail Peminjaman</span>
            </a>
            <hr>
            <a href="{{ route('pengembalian.index') }}"
                class="flex items-center gap-3 py-3 px-4 rounded-xl hover:bg-white/10 transition-all duration-300 group hover:translate-x-1">
                <span class="text-xl group-hover:scale-110 transition-transform"><i class='bxr  bx-clipboard-plus'></i>
                </span>
                <span class="font-medium">Pengembalian</span>
            </a>
            <a href="{{ route('detail_pengembalian.index') }}"
                class="flex items-center gap-3 py-3 px-4 rounded-xl hover:bg-white/10 transition-all duration-300 group hover:translate-x-1">
                <span class="text-xl group-hover:scale-110 transition-transform"><i
                        class='bxr  bx-clipboard-detail'></i>
                </span>
                <span class="font-medium">Detail Pengembalian</span>
            </a>
            <hr>
            <a href="#"
                class="flex items-center gap-3 py-3 px-4 rounded-xl hover:bg-white/10 transition-all duration-300 group hover:translate-x-1">
                <span class="text-xl group-hover:scale-110 transition-transform"><i class='bxr  bx-cog'></i> </span>
                <span class="font-medium">Pengaturan</span>
            </a>
        </nav>

        <div class="p-4 border-t border-white/10 gap-2 flex flex-col">
            <a href="{{ route('syarat.ketentuan') }}" class="hover:text-[#F67103] font-medium italic">
                Syarat & Ketentuan
            </a>
            <a href="#"
                class="flex items-center justify-center gap-2 bg-gradient-to-r from-[#F67103] to-[#D4800C] py-3 rounded-xl hover:from-[#D4800C] hover:to-[#F67103] transition-all duration-300 font-semibold shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                Keluar
            </a>
        </div>
    </aside>

    <!-- Main Content dengan margin left -->
    <main class="ml-64 p-8 min-h-screen">
        <!-- Header dengan Gradient -->
        <header
            class="mb-8 bg-gradient-to-r from-white to-[#D2C8AA]/20 rounded-2xl shadow-lg p-6 border border-[#D2C8AA]/30">
            <div class="flex items-center justify-between">
                <div>
                    <h1
                        class="text-4xl py-1 font-bold bg-gradient-to-r from-[#49777B] to-[#F67103] bg-clip-text text-transparent">
                        @yield('title')
                    </h1>
                    <p class="text-gray-600 mt-1">Kelola data perpustakaan dengan mudah</p>
                </div>
                <div class="flex items-center gap-3">
                    <div class="bg-gradient-to-br from-[#F67103]/10 to-[#D4800C]/10 p-3 rounded-xl">
                        <svg class="w-8 h-8 text-[#F67103]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                </div>
            </div>
        </header>

        <!-- Content Card dengan Design Modern -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-[#D2C8AA]/20 backdrop-blur-sm">
            @yield('content')
        </div>

        <!-- Footer Info -->
        <footer class="mt-6 text-center">
            <p class="text-sm text-gray-500">
                © 2025 Perpustakaan Sekolah - Sistem Manajemen Buku
            </p>
        </footer>
    </main>

</body>

</html>
