@extends('layouts.main')

@section('title', 'Syarat & Ketentuan')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-lg border border-gray-100 p-10 mt-6">
    <h1 class="text-3xl font-bold text-[#49777B] mb-6 text-center">Syarat & Ketentuan</h1>

    <p class="text-gray-600 mb-6 text-center">
        Harap membaca dengan seksama sebelum menggunakan layanan sistem ini.
    </p>

    <div class="space-y-6 text-gray-700 leading-relaxed">
        <section>
            <h2 class="text-xl font-semibold text-[#F67103] mb-2">1. Ketentuan Umum</h2>
            <p>
                Sistem ini digunakan untuk mencatat dan mengelola proses peminjaman serta pengembalian buku.
                Pengguna wajib menggunakan data yang valid dan tidak diperbolehkan melakukan perubahan tanpa izin admin.
            </p>
        </section>

        <section>
            <h2 class="text-xl font-semibold text-[#F67103] mb-2">2. Hak & Kewajiban Pengguna</h2>
            <ul class="list-disc list-inside space-y-1">
                <li>Menjaga kerahasiaan akun masing-masing.</li>
                <li>Bertanggung jawab atas setiap data yang dimasukkan.</li>
                <li>Tidak menyalahgunakan sistem untuk kepentingan pribadi.</li>
            </ul>
        </section>

        <section>
            <h2 class="text-xl font-semibold text-[#F67103] mb-2">3. Kebijakan Peminjaman Buku</h2>
            <ul class="list-disc list-inside space-y-1">
                <li>Buku yang dipinjam wajib dikembalikan sesuai tanggal yang telah ditentukan.</li>
                <li>Keterlambatan pengembalian akan dikenakan denda sesuai peraturan.</li>
                <li>Jika buku rusak atau hilang, peminjam wajib mengganti sesuai ketentuan perpustakaan.</li>
            </ul>
        </section>

        <section>
            <h2 class="text-xl font-semibold text-[#F67103] mb-2">4. Perubahan Syarat & Ketentuan</h2>
            <p>
                Pihak pengelola berhak mengubah isi syarat dan ketentuan ini sewaktu-waktu tanpa pemberitahuan terlebih dahulu.
                Versi terbaru akan selalu ditampilkan di halaman ini.
            </p>
        </section>

        <section>
            <h2 class="text-xl font-semibold text-[#F67103] mb-2">5. Kontak</h2>
            <p>
                Jika Anda memiliki pertanyaan mengenai syarat dan ketentuan ini, silakan hubungi admin melalui email:
                <a href="mailto:admin@perpustakaan.iduka.my.id" class="text-[#49777B] font-medium hover:underline">
                    admin@perpustakaan.iduka.my.id
                </a>
            </p>
        </section>
    </div>

</div>
@endsection
