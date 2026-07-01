@extends('layouts.public')

@section('title', 'Toko Alkes Surabaya | Distributor Alkes - PT. Berito Jaya Medika')
@section('meta_description', 'PT. Berito Jaya Medika adalah toko alkes Surabaya dan distributor alat kesehatan Indonesia untuk rumah sakit, klinik, laboratorium, apotek, instansi, dan kebutuhan pengadaan medis.')
@section('meta_keywords', 'alkes surabaya, toko alkes surabaya, toko alat kesehatan surabaya, distributor alkes surabaya, distributor alkes indonesia, distributor alat kesehatan indonesia, supplier alat medis surabaya, grosir alkes surabaya, alat laboratorium surabaya')
@section('canonical', route('home'))

@push('structured_data')
@php
    $homeFaqSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => [
            [
                '@type' => 'Question',
                'name' => 'Apakah PT. Berito Jaya Medika termasuk toko alkes di Surabaya?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Ya. PT. Berito Jaya Medika melayani penjualan alat kesehatan, alat medis, dan kebutuhan laboratorium di Surabaya untuk rumah sakit, klinik, apotek, instansi, dan pelanggan umum.',
                ],
            ],
            [
                '@type' => 'Question',
                'name' => 'Apakah PT. Berito Jaya Medika melayani distributor alkes Indonesia?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'PT. Berito Jaya Medika melayani kebutuhan distribusi alat kesehatan dari Surabaya ke berbagai wilayah Indonesia dengan pilihan produk medis dari brand terpercaya.',
                ],
            ],
            [
                '@type' => 'Question',
                'name' => 'Produk alkes apa saja yang tersedia?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Produk yang tersedia mencakup alat diagnostik, instrumen bedah, bahan habis pakai medis, alat laboratorium, patient monitor, nebulizer, tensimeter, kursi roda, hospital bed, dan kebutuhan medis lain.',
                ],
            ],
            [
                '@type' => 'Question',
                'name' => 'Apakah produk tersedia untuk kebutuhan pengadaan pemerintah?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Sebagian produk tersedia melalui katalog INAPROC dan dapat dikonsultasikan dengan tim PT. Berito Jaya Medika untuk kebutuhan pengadaan instansi.',
                ],
            ],
        ],
    ];
@endphp
<script type="application/ld+json">
@json($homeFaqSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
</script>
@endpush

@section('content')

{{-- SECTION 1: HERO - Welcome & Pengenalan --}}
<!-- Hero - Welcome Section -->
<div class="relative bg-gradient-to-br from-blue-50 via-white to-blue-50 overflow-hidden">
    <!-- Subtle decorative -->
    <div class="absolute top-0 left-0 w-64 h-64 sm:w-96 sm:h-96 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
    <div class="absolute bottom-0 right-0 w-64 h-64 sm:w-96 sm:h-96 bg-yellow-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24 lg:py-32 relative z-10">
        <div class="max-w-3xl mx-auto text-center">
            <!-- Greeting Badge -->
            <div data-aos="fade-down" data-aos-duration="600">
                <span class="inline-flex items-center gap-2 px-5 py-2.5 bg-white border border-gray-200 text-gray-600 text-sm font-semibold rounded-full mb-8 shadow-sm">
                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                    Distributor Resmi Alat Kesehatan Sejak 1998
                </span>
            </div>

            <!-- Company Name -->
            <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold tracking-tight leading-[1.1] mb-6" data-aos="fade-up" data-aos-duration="800">
                <span class="text-blue-900">PT. BERITO</span><br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-600 via-red-500 to-red-600">JAYA MEDIKA</span>
            </h1>

            <!-- Tagline -->
            <p class="text-lg sm:text-xl text-gray-600 max-w-xl mx-auto leading-relaxed mb-10" data-aos="fade-up" data-aos-delay="200">
                Mitra terpercaya Anda dalam penyediaan solusi <strong class="text-blue-900">alat kesehatan</strong>, 
                <strong class="text-blue-900">laboratorium</strong> & <strong class="text-blue-900">alat medis</strong> 
                di Surabaya dan seluruh Indonesia.
            </p>

            <!-- Stats Row -->
            <div class="flex items-center justify-center gap-6 sm:gap-10 mb-10" data-aos="fade-up" data-aos-delay="300">
                <div class="text-center">
                    <div class="text-2xl sm:text-3xl font-black text-blue-900">20+</div>
                    <div class="text-xs text-gray-500 font-medium">Tahun</div>
                </div>
                <div class="w-px h-10 bg-gray-300"></div>
                <div class="text-center">
                    <div class="text-2xl sm:text-3xl font-black text-blue-900">500+</div>
                    <div class="text-xs text-gray-500 font-medium">Klien</div>
                </div>
                <div class="w-px h-10 bg-gray-300"></div>
                <div class="text-center">
                    <div class="text-2xl sm:text-3xl font-black text-blue-900">1000+</div>
                    <div class="text-xs text-gray-500 font-medium">Produk</div>
                </div>
            </div>

        </div>
    </div>
</div>

<section class="bg-white py-16 lg:py-20" aria-labelledby="seo-local-heading">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-10" data-aos="fade-up">
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 text-blue-800 text-sm font-bold">
                    Alkes Surabaya
                </span>
                <h2 id="seo-local-heading" class="mt-4 text-3xl sm:text-4xl lg:text-5xl font-extrabold text-blue-900 leading-tight">
                    Toko Alkes Surabaya dan Distributor Alat Kesehatan Indonesia
                </h2>
                <p class="mt-5 text-lg text-gray-600 leading-relaxed">
                    PT. Berito Jaya Medika menyediakan kebutuhan alat kesehatan untuk rumah sakit, klinik, puskesmas, laboratorium, apotek, instansi, dan pelanggan umum. Dari Surabaya, kami melayani pengadaan alat medis, alat laboratorium, dan produk habis pakai untuk kebutuhan lokal Jawa Timur hingga pengiriman nasional.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="rounded-2xl border border-blue-100 bg-blue-50/50 p-6">
                    <h3 class="text-xl font-bold text-blue-900 mb-3">Supplier Alkes untuk Fasilitas Kesehatan</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Kami membantu kebutuhan alat diagnostik, instrumen bedah, bahan habis pakai medis, alat laboratorium, patient monitor, nebulizer, tensimeter, kursi roda, hospital bed, dan perlengkapan pendukung layanan kesehatan.
                    </p>
                </div>

                <div class="rounded-2xl border border-red-100 bg-red-50/40 p-6">
                    <h3 class="text-xl font-bold text-blue-900 mb-3">Pengadaan dan Distribusi Alkes</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Tim PT. Berito Jaya Medika dapat membantu konsultasi produk, ketersediaan stok, pilihan brand, dan kebutuhan pengadaan melalui katalog INAPROC maupun pembelian langsung.
                    </p>
                </div>
            </div>

            <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="rounded-xl border border-gray-200 p-5 bg-white shadow-sm">
                    <h3 class="font-bold text-blue-900 mb-2">Apakah toko alkes di Surabaya?</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">Ya, kami melayani kebutuhan alat kesehatan dan alat medis di Surabaya.</p>
                </div>
                <div class="rounded-xl border border-gray-200 p-5 bg-white shadow-sm">
                    <h3 class="font-bold text-blue-900 mb-2">Melayani seluruh Indonesia?</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">Kami melayani pengiriman dan distribusi alkes ke berbagai wilayah Indonesia.</p>
                </div>
                <div class="rounded-xl border border-gray-200 p-5 bg-white shadow-sm">
                    <h3 class="font-bold text-blue-900 mb-2">Produk apa saja?</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">Alat diagnostik, laboratorium, habis pakai medis, instrumen bedah, dan produk kesehatan lain.</p>
                </div>
                <div class="rounded-xl border border-gray-200 p-5 bg-white shadow-sm">
                    <h3 class="font-bold text-blue-900 mb-2">Tersedia INAPROC?</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">Sebagian produk tersedia di katalog INAPROC untuk kebutuhan pengadaan instansi.</p>
                </div>
            </div>

            <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="{{ route('products') }}" class="inline-flex items-center justify-center w-full sm:w-auto px-6 py-3 rounded-xl bg-blue-700 hover:bg-blue-800 text-white font-bold transition">
                    Lihat Produk Alkes
                </a>
                <a href="{{ route('contact') }}" class="inline-flex items-center justify-center w-full sm:w-auto px-6 py-3 rounded-xl bg-red-600 hover:bg-red-700 text-white font-bold transition">
                    Konsultasi Pengadaan
                </a>
            </div>
        </div>
    </div>
</section>

{{-- â•”â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•—
    â•‘  SECTION 2: KATEGORI PRODUK                                 â•‘
    â•‘  Baris: ~115 - ~180                                         â•‘
    â•‘  3 kartu kategori: Diagnostik, Bedah, Habis Pakai           â•‘
    â•šâ•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• --}}
<!-- Product Categories Section -->
<div class="bg-gradient-to-b from-gray-50 to-white py-20 lg:py-28">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center" data-aos="fade-up">
            <h2 class="text-base font-semibold text-red-600 uppercase tracking-wider">Kategori Produk</h2>
            <h3 class="mt-3 text-4xl md:text-5xl font-extrabold text-blue-900 tracking-tight">
                Solusi Lengkap Kebutuhan Medis
            </h3>
            <p class="mt-5 max-w-2xl mx-auto text-xl text-gray-600">
                Dari diagnostik hingga perlengkapan bedah, kami memiliki apa yang Anda butuhkan.
            </p>
        </div>

        <div class="mt-20 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <a href="{{ route('products') }}" class="group relative block rounded-3xl shadow-2xl overflow-hidden h-96 transform hover:-translate-y-2 transition-all duration-500" data-aos="fade-up" data-aos-delay="100">
                <img class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="https://img.freepik.com/vektor-gratis/banyak-peralatan-medis-dan-obat-obatan-dengan-latar-belakang-putih_1308-43339.jpg?semt=ais_hybrid&w=740&q=80" alt="Diagnostik">
                <div class="absolute inset-0 bg-gradient-to-t from-blue-900 via-blue-900/70 to-transparent group-hover:from-blue-800 transition-colors duration-500"></div>
                <div class="absolute bottom-0 left-0 right-0 p-8">
                    <div class="inline-block px-4 py-1 bg-yellow-400 text-blue-900 text-xs font-bold rounded-full mb-3">POPULER</div>
                    <h4 class="text-3xl font-bold text-white mb-2">Peralatan Diagnostik</h4>
                    <p class="text-gray-200 mb-4">Teknologi diagnostik presisi tinggi</p>
                    <span class="inline-flex items-center text-yellow-400 font-semibold">
                        Lihat Selengkapnya 
                        <svg class="w-5 h-5 ml-2 transition-transform duration-300 group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </span>
                </div>
            </a>
            
            <a href="{{ route('products') }}" class="group relative block rounded-3xl shadow-2xl overflow-hidden h-96 transform hover:-translate-y-2 transition-all duration-500" data-aos="fade-up" data-aos-delay="300">
                <img class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="https://png.pngtree.com/background/20230525/original/pngtree-some-surgical-instruments-are-displayed-on-a-white-surface-picture-image_2735075.jpg" alt="Ruang Bedah">
                <div class="absolute inset-0 bg-gradient-to-t from-blue-900 via-blue-900/70 to-transparent group-hover:from-blue-800 transition-colors duration-500"></div>
                <div class="absolute bottom-0 left-0 right-0 p-8">
                    <div class="inline-block px-4 py-1 bg-red-500 text-white text-xs font-bold rounded-full mb-3">PREMIUM</div>
                    <h4 class="text-3xl font-bold text-white mb-2">Perlengkapan Bedah</h4>
                    <p class="text-gray-200 mb-4">Instrumen bedah berkualitas internasional</p>
                    <span class="inline-flex items-center text-yellow-400 font-semibold">
                        Lihat Selengkapnya 
                        <svg class="w-5 h-5 ml-2 transition-transform duration-300 group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </span>
                </div>
            </a>

            <a href="{{ route('products') }}" class="group relative block rounded-3xl shadow-2xl overflow-hidden h-96 transform hover:-translate-y-2 transition-all duration-500" data-aos="fade-up" data-aos-delay="500">
                <img class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="https://png.pngtree.com/png-clipart/20210620/original/pngtree-gloves-white-clean-medical-png-image_6438715.jpg" alt="Sarung Tangan Medis">
                <div class="absolute inset-0 bg-gradient-to-t from-blue-900 via-blue-900/70 to-transparent group-hover:from-blue-800 transition-colors duration-500"></div>
                <div class="absolute bottom-0 left-0 right-0 p-8">
                    <div class="inline-block px-4 py-1 bg-green-500 text-white text-xs font-bold rounded-full mb-3">STOK LENGKAP</div>
                    <h4 class="text-3xl font-bold text-white mb-2">Produk Habis Pakai</h4>
                    <p class="text-gray-200 mb-4">Ketersediaan stok terjamin</p>
                    <span class="inline-flex items-center text-yellow-400 font-semibold">
                        Lihat Selengkapnya 
                        <svg class="w-5 h-5 ml-2 transition-transform duration-300 group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </span>
                </div>
            </a>
            
        </div>
    </div>
</div>

{{-- â•”â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•—
    â•‘  SECTION 3: LEGALITAS                                       â•‘
    â•‘  Baris: ~182 - ~251                                         â•‘
    â•‘  NIB, Izin Distribusi, Sertifikat CDAKB                     â•‘
    â•šâ•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• --}}
<!-- Legalitas Section -->
<div class="bg-white py-20 lg:py-28">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center" data-aos="fade-up">
            <span class="inline-block px-4 py-2 bg-blue-100 text-blue-600 text-sm font-bold rounded-full mb-4">Legalitas</span>
            <h3 class="mt-2 text-4xl md:text-5xl font-extrabold text-blue-900 tracking-tight">
                Tersertifikasi dan Terpercaya
            </h3>
            <p class="mt-6 max-w-2xl mx-auto text-xl text-gray-600">
                Kami beroperasi dengan izin resmi dan mematuhi standar distribusi alat kesehatan yang berlaku di Indonesia.
            </p>
        </div>

        <div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="relative group" data-aos="fade-up" data-aos-delay="100">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-blue-700 rounded-3xl transform rotate-2 group-hover:rotate-0 transition-transform duration-300"></div>
                <div class="relative bg-white rounded-3xl shadow-xl p-8 transform hover:-translate-y-2 transition-all duration-300 cursor-pointer" onclick="showCertificate('nib')">
                    <div class="flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-600 to-blue-700 text-white mx-auto mb-6 shadow-lg">
                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                    </div>
                    <h4 class="text-2xl font-bold text-blue-900 text-center mb-3">Nomor Induk Berusaha</h4>
                    <p class="text-center text-gray-600 font-semibold text-lg mb-4">
                        9120406890292
                    </p>
                    <button class="w-full py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold transition-colors duration-300">
                        Lihat Sertifikat
                    </button>
                </div>
            </div>
            
            <div class="relative group" data-aos="fade-up" data-aos-delay="300">
                <div class="absolute inset-0 bg-gradient-to-r from-red-600 to-red-700 rounded-3xl transform rotate-2 group-hover:rotate-0 transition-transform duration-300"></div>
                <div class="relative bg-white rounded-3xl shadow-xl p-8 transform hover:-translate-y-2 transition-all duration-300 cursor-pointer" onclick="showCertificate('izin')">
                    <div class="flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-red-600 to-red-700 text-white mx-auto mb-6 shadow-lg">
                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.333 9-6.03 9-11.623 0-1.613-.42-3.136-1.165-4.504A11.956 11.956 0 0112 2.964z" />
                        </svg>
                    </div>
                    <h4 class="text-2xl font-bold text-blue-900 text-center mb-3">Izin Distribusi Alat Kesehatan</h4>
                    <p class="text-center text-gray-600 font-semibold text-lg mb-4">
                        91204068902920002
                    </p>
                    <button class="w-full py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-semibold transition-colors duration-300">
                        Lihat Sertifikat
                    </button>
                </div>
            </div>

            <div class="relative group" data-aos="fade-up" data-aos-delay="500">
                <div class="absolute inset-0 bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-3xl transform rotate-2 group-hover:rotate-0 transition-transform duration-300"></div>
                <div class="relative bg-white rounded-3xl shadow-xl p-8 transform hover:-translate-y-2 transition-all duration-300 cursor-pointer" onclick="showCertificate('cdakb')">
                    <div class="flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-yellow-500 to-yellow-600 text-white mx-auto mb-6 shadow-lg">
                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h4 class="text-2xl font-bold text-blue-900 text-center mb-3">Sertifikat CDAKB</h4>
                    <p class="text-center text-gray-600 font-semibold text-lg mb-4">
                        912040689029200000001
                    </p>
                    <button class="w-full py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg font-semibold transition-colors duration-300">
                        Lihat Sertifikat
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- â•”â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•—
    â•‘  SECTION 4: VISI & MISI                                     â•‘
    â•‘  Baris: ~253 - ~318                                         â•‘
    â•‘  Visi dan 4 poin misi perusahaan                            â•‘
    â•šâ•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• --}}
<!-- Vision & Mission Section -->
<div class="bg-gradient-to-b from-gray-50 to-white py-20 lg:py-28">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
            
            <div data-aos="fade-up" data-aos-duration="800" class="relative">
                <div class="absolute -inset-4 bg-gradient-to-r from-blue-100 to-blue-50 rounded-3xl transform -rotate-2"></div>
                <div class="relative bg-white p-10 rounded-3xl shadow-xl">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-600 to-blue-700 rounded-2xl flex items-center justify-center shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </div>
                        <h2 class="text-4xl font-extrabold text-blue-900">Visi Kami</h2>
                    </div>
                    <p class="text-lg text-gray-700 leading-relaxed">
                        Menjadi Perusahaan Kesehatan Terbaik Dengan Terus Memberikan Produk Kualitas Terbaik Dan Layanan yang sangat baik.
                    </p>
                </div>
            </div>
            
            <div data-aos="fade-up" data-aos-duration="800" data-aos-delay="200" class="relative">
                <div class="absolute -inset-4 bg-gradient-to-r from-red-100 to-red-50 rounded-3xl transform rotate-2"></div>
                <div class="relative bg-white p-10 rounded-3xl shadow-xl">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-red-600 to-red-700 rounded-2xl flex items-center justify-center shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                        </div>
                        <h2 class="text-4xl font-extrabold text-blue-900">Misi Kami</h2>
                    </div>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-green-500 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-gray-700">Meningkatkan kesehatan masyarakat melalui penyediaan perangkat medis dan produk yang terkait.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-green-500 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-gray-700">Menyediakan akses ke teknologi dan produk medis terkini yang inovatif dan teruji.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-green-500 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-gray-700">Memastikan setiap produk memenuhi standar kualitas.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-green-500 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-gray-700">Membangun kemitraan strategis jangka panjang dengan fasilitas kesehatan dan produsen.</span>
                        </li>
                    </ul>
                </div>
            </div>
            
        </div>
    </div>
</div>

{{-- â•”â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•—
    â•‘  SECTION 5: KLIEN                                           â•‘
    â•‘  Baris: ~320 - ~404                                         â•‘
    â•‘  Grid logo klien utama + tombol "Selengkapnya"              â•‘
    â•šâ•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• --}}
<!-- Clients Section -->
<div class="bg-white py-20 lg:py-28">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center" data-aos="fade-up">
            <span class="inline-block px-4 py-2 bg-blue-100 text-blue-600 text-sm font-bold rounded-full mb-4">Klien Kami</span>
            <h3 class="mt-2 text-4xl md:text-5xl font-extrabold text-blue-900 tracking-tight">
                Dipercaya oleh Fasilitas Kesehatan
            </h3>
            <p class="mt-6 max-w-2xl mx-auto text-xl text-gray-600">
                Kami bangga telah melayani dan menjadi mitra terpercaya bagi berbagai institusi kesehatan di Indonesia.
            </p>
        </div>

        <!-- Grid Klien Utama -->
        <div id="clients-grid" class="mt-20 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-8">
            <div class="flex flex-col items-center text-center group" data-aos="fade-up" data-aos-delay="100">
                <div class="w-28 h-28 rounded-2xl bg-gradient-to-br from-blue-50 to-blue-100 flex items-center justify-center mb-4 shadow-lg group-hover:shadow-2xl transition-all duration-300 transform group-hover:scale-110">
                    <img src="data:image/png;base64,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" alt="Logo Klien 1" class="w-20 h-20 object-contain grayscale group-hover:grayscale-0 transition-all duration-300 rounded-xl">
                </div>
                <p class="text-sm font-bold text-gray-700">RSUD Dr. Soetomo</p>
            </div>
            <div class="flex flex-col items-center text-center group" data-aos="fade-up" data-aos-delay="150">
                <div class="w-28 h-28 rounded-2xl bg-gradient-to-br from-red-50 to-red-100 flex items-center justify-center mb-4 shadow-lg group-hover:shadow-2xl transition-all duration-300 transform group-hover:scale-110">
                    <img src="data:image/png;base64,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" alt="Logo Klien 2" class="w-20 h-20 object-contain grayscale group-hover:grayscale-0 transition-all duration-300 rounded-xl">
                </div>
                <p class="text-sm font-bold text-gray-700">RSUD Dr. Iskak Tulungagung</p>
            </div>
            <div class="flex flex-col items-center text-center group" data-aos="fade-up" data-aos-delay="300">
                <div class="w-28 h-28 rounded-2xl bg-gradient-to-br from-purple-50 to-purple-100 flex items-center justify-center mb-4 shadow-lg group-hover:shadow-2xl transition-all duration-300 transform group-hover:scale-110">
                    <img src="https://static.uc.ac.id/psy/2018/02/Logo-RSJ-Menur.png" alt="Logo Klien 5" class="w-20 h-20 object-contain grayscale group-hover:grayscale-0 transition-all duration-300 rounded-xl">
                </div>
                <p class="text-sm font-bold text-gray-700">RS Jiwa Menur Surabaya Prov Jawa Timur</p>
            </div>
            <div class="flex flex-col items-center text-center group" data-aos="fade-up" data-aos-delay="350">
                <div class="w-28 h-28 rounded-2xl bg-gradient-to-br from-pink-50 to-pink-100 flex items-center justify-center mb-4 shadow-lg group-hover:shadow-2xl transition-all duration-300 transform group-hover:scale-110">
                    <img src="https://media.licdn.com/dms/image/v2/C560BAQGwIYLS90pTVA/company-logo_200_200/company-logo_200_200/0/1645625766253/rsud_dr_mohamad_soewandhie_logo?e=2147483647&v=beta&t=_-VqwfvqVNYSGkblGiLbxgomOatQzYlAXGqE3BtUibc" alt="Logo Klien 6" class="w-20 h-20 object-contain grayscale group-hover:grayscale-0 transition-all duration-300 rounded-xl">
                </div>
                <p class="text-sm font-bold text-gray-700">RSUD DR M SOEWANDHIE</p>
            </div>
            <div class="flex flex-col items-center text-center group" data-aos="fade-up" data-aos-delay="400">
                <div class="w-28 h-28 rounded-2xl bg-gradient-to-br from-indigo-50 to-indigo-100 flex items-center justify-center mb-4 shadow-lg group-hover:shadow-2xl transition-all duration-300 transform group-hover:scale-110">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTxygLxzwbuWzLawV5uYRss4a-Ku6DiE7_OFg&s" alt="Logo Klien 7" class="w-20 h-20 object-contain grayscale group-hover:grayscale-0 transition-all duration-300 rounded-xl">
                </div>
                <p class="text-sm font-bold text-gray-700">RSUD Bhakti Dharma Husada Surabaya</p>
            </div>
            <div class="flex flex-col items-center text-center group" data-aos="fade-up" data-aos-delay="450">
                <div class="w-28 h-28 rounded-2xl bg-gradient-to-br from-teal-50 to-teal-100 flex items-center justify-center mb-4 shadow-lg group-hover:shadow-2xl transition-all duration-300 transform group-hover:scale-110">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT404qDshBGwJWis2ArwjusbEUBLCYTSCa2Gg&s" alt="Logo Klien 8" class="w-20 h-20 object-contain grayscale group-hover:grayscale-0 transition-all duration-300 rounded-xl">
                </div>
                <p class="text-sm font-bold text-gray-700">RSUD Sidoarjo Barat</p>
            </div>
            <div class="flex flex-col items-center text-center group" data-aos="fade-up" data-aos-delay="500">
                <div class="w-28 h-28 rounded-2xl bg-gradient-to-br from-amber-50 to-amber-100 flex items-center justify-center mb-4 shadow-lg group-hover:shadow-2xl transition-all duration-300 transform group-hover:scale-110">
                    <img src="https://play-lh.googleusercontent.com/jY2Ymgj-u0wUDJiqzfbyUT5BSby2zeYn9JmOVCirO_mY6GXmrlz5GarDW-QSEFWl3qj6" alt="Logo Klien 9" class="w-20 h-20 object-contain grayscale group-hover:grayscale-0 transition-all duration-300 rounded-xl">
                </div>
                <p class="text-sm font-bold text-gray-700">RSUD Kanjuruhan Kepanjen Kab Malang</p>
            </div>
            <div class="flex flex-col items-center text-center group" data-aos="fade-up" data-aos-delay="550">
                <div class="w-28 h-28 rounded-2xl bg-gradient-to-br from-emerald-50 to-emerald-100 flex items-center justify-center mb-4 shadow-lg group-hover:shadow-2xl transition-all duration-300 transform group-hover:scale-110">
                    <img src="data:image/png;base64,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" alt="Logo Klien 10" class="w-20 h-20 object-contain grayscale group-hover:grayscale-0 transition-all duration-300 rounded-xl">
                </div>
                <p class="text-sm font-bold text-gray-700">RSUD Ibnu Sina Gresik</p>
            </div>
            <div class="flex flex-col items-center text-center group" data-aos="fade-up" data-aos-delay="200">
                <div class="w-28 h-28 rounded-2xl bg-gradient-to-br from-yellow-50 to-yellow-100 flex items-center justify-center mb-4 shadow-lg group-hover:shadow-2xl transition-all duration-300 transform group-hover:scale-110">
                    <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEhhL6urO1hFibguayQFqa8mnv9FZ7oG7_VAYQVWIEZLlBw3w-qNLkK0-FBaM6m4YA2pbkGmTqxKtSauv7NrBPBYOuQwLJoSyIWqH87YIrurHHQRIqo1XRydESM0irKh8mcWUHeXNF5tsoYE_QVuEzfU2ZTQb5kC9q8iiiu4tg9VzWedNvdDa0pdaHXx/s320/GKL15_Kimia%20Farma%20-%20Koleksilogo.com.jpg" alt="Logo Klien 3" class="w-20 h-20 object-contain grayscale group-hover:grayscale-0 transition-all duration-300 rounded-xl">
                </div>
                <p class="text-sm font-bold text-gray-700">KIMIA FARMA</p>
            </div>
            <div class="flex flex-col items-center text-center group" data-aos="fade-up" data-aos-delay="250">
                <div class="w-28 h-28 rounded-2xl bg-gradient-to-br from-green-50 to-green-100 flex items-center justify-center mb-4 shadow-lg group-hover:shadow-2xl transition-all duration-300 transform group-hover:scale-110">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ3RNUscTPlkKqWXip0MIuF0n72krA3D7wydw&s" alt="Logo Klien 4" class="w-20 h-20 object-contain grayscale group-hover:grayscale-0 transition-all duration-300 rounded-xl">
                </div>
                <p class="text-sm font-bold text-gray-700">K24</p>
            </div>
        </div>

        <!-- Tombol Selengkapnya -->
        <div class="mt-16 text-center">
            <button id="showMoreClientsBtn" class="px-8 py-3 bg-blue-600 text-white font-semibold rounded-full shadow-lg hover:bg-blue-700 transition-colors duration-300 transform hover:scale-105">
                Selengkapnya
            </button>
        </div>
    </div>
</div>

{{-- â•”â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•—
    â•‘  SECTION 6: TESTIMONI / FEEDBACK                            â•‘
    â•‘  Baris: ~406 - ~507                                         â•‘
    â•‘  Carousel testimoni klien dari database                     â•‘
    â•šâ•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• --}}
<!-- Client Feedback Section -->
<div class="bg-gradient-to-b from-white to-gray-50 py-20 lg:py-28">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center" data-aos="fade-up">
            <span class="inline-block px-4 py-2 bg-yellow-100 text-yellow-600 text-sm font-bold rounded-full mb-4">Testimoni</span>
            <h3 class="mt-2 text-4xl md:text-5xl font-extrabold text-blue-900 tracking-tight">
                Apa Kata Klien Kami
            </h3>
            <p class="mt-6 max-w-2xl mx-auto text-xl text-gray-600">
                Kepuasan klien adalah prioritas utama kami. Simak pengalaman mereka bekerja sama dengan PT. BERITO JAYA MEDIKA.
            </p>
        </div>

        @if($feedbacks->count() > 0)
        <!-- Carousel Container -->
        <div class="mt-20 relative">
            <!-- Navigation Buttons -->
            <button id="prevBtn" class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 z-10 w-14 h-14 bg-white hover:bg-blue-600 rounded-full shadow-xl flex items-center justify-center transition-all duration-300 group">
                <svg class="w-6 h-6 text-blue-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            
            <button id="nextBtn" class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 z-10 w-14 h-14 bg-white hover:bg-blue-600 rounded-full shadow-xl flex items-center justify-center transition-all duration-300 group">
                <svg class="w-6 h-6 text-blue-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>

            <!-- Carousel Track -->
            <div class="overflow-hidden pb-4">
                <div id="carouselTrack" class="flex transition-transform duration-500 ease-out">
                    @foreach($feedbacks as $feedback)
                    <div class="w-full md:w-1/2 lg:w-1/3 flex-shrink-0 px-4">
                        <div class="bg-white rounded-3xl shadow-xl p-8 h-full transform hover:-translate-y-2 transition-all duration-300 border-2 border-gray-100">
                            <!-- Quote Icon -->
                            <div class="flex justify-between items-start mb-6">
                                <svg class="w-12 h-12 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                                </svg>
                                
                                <!-- Rating Stars -->
                                <div class="flex items-center gap-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-5 h-5 {{ $i <= $feedback->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    @endfor
                                </div>
                            </div>

                            <!-- Feedback Text -->
                            <p class="text-gray-700 leading-relaxed mb-8 line-clamp-6">
                                "{{ $feedback->feedback }}"
                            </p>

                            <!-- Client Info -->
                            <div class="flex items-center gap-4 pt-6 border-t-2 border-gray-100">
                                @if($feedback->client_photo)
                                    <img src="{{ $feedback->client_photo }}" 
                                         alt="{{ $feedback->client_company }}" 
                                         class="w-16 h-16 rounded-full object-cover border-4 border-blue-100">
                                @else
                                    <div class="w-16 h-16 bg-gradient-to-br from-blue-600 to-blue-800 rounded-full flex items-center justify-center">
                                        <span class="text-white font-bold text-2xl">{{ substr($feedback->client_company, 0, 1) }}</span>
                                    </div>
                                @endif
                                
                                <div class="flex-1">
                                    <h4 class="text-lg font-bold text-blue-900">{{ $feedback->client_company }}</h4>
                                    <p class="text-sm font-semibold text-blue-600">Mitra PT. Berito Jaya Medika</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Indicators -->
            <div class="flex justify-center gap-2 mt-8">
                @foreach($feedbacks as $index => $feedback)
                    <button class="carousel-indicator w-3 h-3 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-blue-600 w-8' : 'bg-gray-300' }}" 
                            data-index="{{ $index }}"></button>
                @endforeach
            </div>
        </div>
        @else
        <!-- Empty State -->
        <div class="mt-20 text-center py-16">
            <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Belum Ada Testimoni</h3>
            <p class="text-gray-600">Testimoni klien akan ditampilkan di sini.</p>
        </div>
        @endif
    </div>
    </div>

{{-- â•”â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•—

{{-- â•”â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•—
    â•‘  POPUP: DAFTAR LENGKAP KLIEN                                â•‘
    â•‘  Baris: ~543 - ~1133                                        â•‘
    â•‘  Modal popup daftar 500+ klien (dari tombol "Selengkapnya") â•‘
    â•šâ•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• --}}
<!-- Popup Modal untuk Klien (Alpine.js Interactive) -->
<div id="clientsPopup" class="fixed inset-0 z-50 hidden overflow-y-auto" x-data="clientsPopupApp()" x-init="init()">
    <div class="flex items-center justify-center min-h-screen p-4 bg-black bg-opacity-50" @click.self="closePopup()">
        <div class="relative bg-white rounded-2xl shadow-xl max-w-5xl w-full flex flex-col" style="max-height: 90vh; height: 85vh;" @click.stop>
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-6 rounded-t-2xl">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <h3 class="text-2xl font-bold">Daftar Lengkap Klien Kami</h3>
                        <p class="text-blue-200 text-sm mt-1">
                            Menampilkan <span class="font-bold text-white" x-text="filtered.length"></span> dari <span class="font-bold text-white" x-text="allClients.length"></span> klien
                        </p>
                    </div>
                    <button id="closePopupBtn" @click="closePopup()" class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center hover:bg-white/30 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <!-- Search -->
                <div class="relative">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input type="text" x-model="search" placeholder="Cari klien..." class="w-full pl-12 pr-4 py-3 bg-white/20 backdrop-blur-sm border border-white/30 rounded-xl text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-white/50">
                </div>
            </div>
            <!-- Category Filters -->
            <div class="px-4 py-3 border-b border-gray-100 flex gap-2 bg-gray-50 overflow-x-auto scrollbar-hide" style="min-height: 52px;">
                <template x-for="cat in categories" :key="cat.key">
                    <button @click="activeCategory = cat.key" :class="activeCategory === cat.key ? 'bg-blue-600 text-white shadow-lg' : 'bg-white text-gray-600 hover:bg-blue-50 border border-gray-200'" class="px-4 py-2 rounded-xl text-sm font-semibold transition-all whitespace-nowrap flex items-center gap-1.5">
                        <span x-text="cat.icon"></span>
                        <span x-text="cat.label"></span>
                        <span class="ml-1 text-xs opacity-70" x-text="'(' + countCategory(cat.key) + ')'"></span>
                    </button>
                </template>
            </div>
            <!-- Content -->
            <div class="p-6 overflow-y-auto" style="flex: 1 1 0%; min-height: 0;">
                <div x-show="filtered.length > 0" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                    <template x-for="client in filtered" :key="client">
                        <div class="flex items-center gap-3 bg-gradient-to-r from-blue-50 to-blue-100/50 hover:from-blue-100 hover:to-blue-200/50 py-3 px-4 rounded-xl transition-all duration-200 group">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center text-xs font-bold flex-shrink-0" :class="getTypeColor(client)">
                                <span x-text="getTypeIcon(client)"></span>
                            </div>
                            <span class="text-sm font-medium text-gray-800 group-hover:text-blue-700 transition-colors" x-text="client"></span>
                        </div>
                    </template>
                </div>
                <div x-show="filtered.length === 0" class="flex flex-col items-center justify-center py-16">
                    <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <h4 class="text-lg font-bold text-gray-500">Tidak ditemukan</h4>
                    <p class="text-gray-400 text-sm mt-1">Coba kata kunci lain</p>
                </div>
            </div>
            <!-- Footer -->
            <div class="p-4 bg-gray-50 rounded-b-2xl text-center border-t border-gray-100">
                <p class="text-gray-600 text-sm">Terima kasih atas kepercayaan Anda.</p>
            </div>
        </div>
    </div>
</div>
<script>
function clientsPopupApp() {
    return {
        search: '',
        activeCategory: 'all',
        allClients: [],
        categories: [
            { key: 'all', label: 'Semua', icon: '\u2630' },
            { key: 'rs', label: 'Rumah Sakit', icon: '\uD83C\uDFE5' },
            { key: 'puskesmas', label: 'Puskesmas', icon: '\uD83C\uDFE8' },
            { key: 'apotek', label: 'Apotek', icon: '\uD83D\uDC8A' },
            { key: 'klinik', label: 'Klinik', icon: '\uD83E\uDE7A' },
            { key: 'kimia', label: 'Kimia Farma', icon: '\uD83E\uDDEA' },
            { key: 'dinkes', label: 'Dinkes', icon: '\uD83C\uDFDB' },
            { key: 'lainnya', label: 'Lainnya', icon: '\uD83D\uDCCC' }
        ],
        init() {
            this.allClients = [
'RS PUTRI','RS JASEM','RS UNAIR','RS GATOEL','RS BAPTIS','RS SILOAM','RS SOERYA','RS DARMO','RS IA NUN','FKG U H T','RSUD LAWANG','RSU DENISA','RS ISLAM 1','RS BRAWIJAYA','RS NINDHITA','KLINIK ZAYTUN','KLINIK MAUNAH','RS RIZANI','RSU WIJAYA','APOTEK SKM','RSD KERTOSONO','APOTIK GAMA','RS AISYIYAH','RS ISLAM II','RS BALIMED','RSU SUMEKAR','RS EKA HUSADA','RSI MASYITOH','KLINIK AMINAH','APOTIK BELLA','SINYO MEDIKA','APOTIK FARMASI','RSPAL DR RAMELAN','RS PHC SURABAYA','RS SITI KHODIJAH','RSU AL-IRSYAD','RS HUSADA UTAMA','PUSKESMAS BLUTO','PUSKESMAS TANJUNG','APOTIK AFAS 1','RS GOTONG ROYONG','APOTIK NUR ALIF','TOKO JAYA AGUNG','RS DELTA SURYA','PUSKESMAS OMBEN','APOTIK FARHAN','PUSKESMAS KOKOP','PUSKESMAS GANDING','RS RKZ SURABAYA','RS WILLIAM BOTH','APOTIK ABDULLAH','PUSKESMAS PASEAN','RSUD CILINCING','KLINIK STIESIA','APOTIK FAJAR','APOTIK KAMBOJA','APOTIK IMPIAN','RS SITI HAJAR','PUSKESMAS JAGIR','PUSKESMAS PANCENG','RSUD MIMIKA','RS DHARMA HUSADA','APOTIK KHM','PUSKESMAS SOPAAH','PUSKESMAS AYAH I','PUSKESMAS KOWEL','DINKES WONOGIRI','APOTIK INDRIA','RS PUSURA CANDI','RSUD LIUN PADULI','PUSKESMAS MLARAK','PUSKESMAS MONCEK','RSUD KOTA MADIUN','PUSKESMAS PENELEH','RSU ANWAR MEDIKA','APOTIK KUSUMA','APOTIK SEHATI','RS SHEILA MEDIKA','APOTIK ROME 05','SITI JANUARIYAH','RSI CAHAYA GIRI','PUSKESMAS TALANGO','RSUD BANGGAI','RSUD KESESI','RSU KALIWATES','APOTIK VALENCIA','APOTIK PASYHA','PUSKESMAS LOMPOE','APOTIK FAJAR BARU','PUSKESMAS MADE','PUSKESMAS MENUR','PUSKESMAS KONANG','PUSKESMAS GAMBIR','PUSKESMAS SEMEMI','APOTIK CARISA','PUSKESMAS JERUK','RS WONOLANGAN','RSIA FERINA','PUSKESMAS WIYUNG','PUSKESMAS SUKOLILO','RSU MUSLIMAT','RSUD CANDI UMBUL','TOKO ALAM SUBUR','PUSKESMAS RANGKAH','PUSKESMAS TALANG','PUSKESMAS KEDURUS','RSUD REHATTA','APOTIK BETRO','RS ISLAM MALANG','RS PANTI NIRMALA','BU LANI GUNAWAN','RS CITRA MEDIKA','KLINIK E R H A','RS METRO HOSPITAL','DR.  EKA (RSAL)','APOTIK ALDERAN','APOTIK NUR FARMA','RSUD DR SOETOMO','RSUD HAJI SURABAYA','CITRA LAND MEDIKA','RSUD DR SOETIJONO','RSIA MUHAMMADIYAH','RS BHAKTI RAHAYU','RSI GARAM KALIANGET','RSUD BALI MANDARA','RS ROYAL SURABAYA','RSUD KOTA MALANG','APOTIK ABDULLAH 3','RSUD BANTEN','PUSKESMAS CAMPLONG','PUSKESMAS TLANAKAN','APOTIK MUNTAZAR','APOTIK SARI SEHAT','PT MUSAFA BHAKTI','APOTIK SETIA FARMA','PUSKESMAS TANJUNGBUMI','RSUD GAMBIRAN KEDIRI','RUMKITAL Dr. OEPOMO','RSUD DUNGUS MADIUN','APOTIK SUNAN PERAPEN','RSUD WANGAYA','APOTIK ROME 07','APOTIK YAKERSUDA','PUSKESMAS KALIANGET','APOTIK TRI SAKTI','RS SEMEN GRESIK','APOTIK PANGESTU','PUSKESMAS KAMONING','PUSKESMAS SAWAH PULO','APOTIK FATHAN FARMA','APOTIK WARU INDAH','APOTIK ROME 06','PUSKESMAS GILIGENTING','RSUD PURUK CAHU','KLINIK PHC BENOWO','APOTIK MUFARRIJ','APOTIK AL-KAROMAH','RSUD TABANAN BALI','PUSKESMAS BENJENG','PUSKESMAS CURAHTULIS','APOTIK K-24 BURNEH','APOTIK QONITA FARMA','APOTIK K-24 WAGE','CV, DIAN MEDICA','APOTIK K-24 PPS','PUSKESMAS PANAGUAN','PUSKESMAS BAKTI JAYA','APOTIK SATRIA FARMA','RSUD BAGAS WARAS','APOTIK KINGS FARMA','PUSKESMAS WONOKUSUMO','PUSKESMAS BATUMARMAR','APOTIK K-24 KLAMPIS','PUSKESMAS TIGARAKSA','APOTIK GITHA FIDA FARMA','RS MITRA KELUARGA WARU','PUSKESMAS ASEMROWO','PUSKESMAS GAYUNGAN','PT. ANUGRAH MITRA JAYA','RSUD KAB. SUKOHARJO','KLINIK WIDYA MANDIRI','REKSANA MUDAH','PUSKESMAS BALONGPANGGANG','APOTIK BERKAH SUMENEP','APOTIK 3  CARE PLUS','PT SEJATI GLOBAL MEDIKA','APOTIK K 24 GENTENG','PUSKESMAS BATU PUTIH','APOTIK PEMUDA KAFFA','PT. SARANA LINTAS MEDIKA','PUSKESMAS KENJERAN','PUSKESMAS DR SOETOMO','PUSKESMAS PEGIRIAN','Drg. CELINE YOUNG','PUSKESMAS CIHIDEUNG UDIK','KIMIA FARMA KEBONSARI','PUSKESMAS SIMOLAWANG','PUSKESMAS KLAMPIS NGASEM','PUSKESMAS KEDUNGMUNDU','PUSKESMAS KALIRUNGKUT','APOTIK K 24 SEMAMPIR','APOTIK MASEHAT','PUSKESMAS PONDOK PUCUNG','PUSKESMAS PONDOK BETUNG','DINKES KABUPATEN PACITAN','PUSKESMAS TAMBAK REJO','APOTIK K-24 KWANYAR','APOTIK ALLISWELL','RS UMUM PUSAT SURABAYA','PUSKESMAS BOROBUDUR','DINKES KOTA PEKALONGAN','PT. ARTINDO MAHA JAYA','PUSKESMAS BANGKALAN','PUSKESMAS MULYOREJO','PUSKESMAS DUKUH KUPANG','APOTIK K-24 JAJAG','PUSKESMAS JEMURSARI','APOTIK JAYA FARMA','APOTIK BUNDA KITA','APOTIK KIRA FARMA','KLINIK YOMAMEDIKA','KIMIA FARMA AP. BANGIL','CV DOUBLE A SOLUTIONS','KIMIA FARMA AP NGANJUK','PUSKESMAS TEMBOK DUKUH','PUSKESMAS BATUCEPER','APOTIK PUTRA ABADI','PUSKESMAS WANASARI','RSUD CENGKARENG','APOTIK K-24 GKB','SEPTIAN ADI SAPUTRA','PT AZKEN INDONESIA','PUSKESMAS JAPANAN','APOTIK AMORITA FARMA','KIMIA FARMA SURAMADU','KIMIA FARMA APOTIK 243','APOTIK HIDAYAH ABADI','PUSKESMAS PAYUNG SARI','PUSKESMAS TANJUNGSARI','PUSKESMAS KALIJUDAN','PUSKESMAS KETABANG','APOTIK K H M 2','CV  KURNIA CIPTA KARYA','APOTIK KELUARGA SEHAT','CV. RESTU ACTIV MANDIRI','PUSKESMAS JONGGOL','KIMIA FARMA PENJARINGAN','PUSKESMAS MENGANTI','APOTIK PAGESANGAN','CV DJAVU MUSTIKA','APOTIK HANDIKA FARMA','KIMIA FARMA APOTIK 407','APOTIK K 24 SRONO','KIMIA FARMA APOTIK 26','PUSKESMAS TENGGILIS','APOTIK K24 PASAR PAKIS','APOTIK K 24 TALANGSARI','APOTIK SETIA PAMEKASAN','PT. MARINDA CAHYA MEDIKA','KLINIK PRATAMA SARTIKA 44','RSUD SYAMRABU BANGKALAN','RSUD DR M SOEWANDHIE','RS GIGI DAN MULUT FKG UNAIR','RSUD DR H MOH ANWAR','PT. KARYA DWI ELANG (KDE)','RSUD DR ISKAK  TULUNGAGUNG','RSUD KABUPATEN JOMBANG','RSUD EKA CANDRARINI','BALI INTERNATIONAL HOSPITAL','RSUD GENTENG','RSUD ANUNTALOKO','PT. HOKKY JAYAMAS ABADI','PT. SEHAT INTI PERKASA','PUSKESMAS BATULENGER','RS KUSUMA HOSPITAL','RS UMUM PERMATA','RSUD DR R SOEDARSONO','RSUD IBNU SINA GRESIK','RSUD DAERAH KETAPANG','APOTIK K24 SIDOKARE','RS ADI HUSADA KAPASARI','PUSKESMAS PASONGSONGAN','PUSKESMAS KADUR PAMEKASAN','PT HILMY MEDIKA SARANA','RSUD SUMBERGLAGAH','APOTIK SUMEKAR BARU','PUSKESMAS WARU - PAMEKASAN','RSUD SIDOARJO BARAT','RSUD PROF DR SOEKANDAR','PUSKESMAS KETAPANG','RSIA PURA RAHARJA','RS MARINIR EWAPANGALILA','RUMKITBAN 05.08.03 SIDOARJO','RSUD HUSADA PRIMA PROV JATIM','KIMIA FARMA APOTIK 25 DARMO','RSIA PURI BUNDA MADURA','RS NASIONAL SURABAYA','APOTIK K-24 SUKODONO','PUSKESMAS PROPPO PAMEKASAN','ANUGERAH SINAR MAHDYANTA. PT','DINAS KESEHATAN KOTA BAUBAU','RSUD WALUYO JATI KRAKSAAN','APOTIK K 24 TANAH MERAH','APOTIK K-24 SEPANJANG','RSU AISYIYAH PONOROGO','RUMKIT BHAYAGKARA BONDOWOSO','RS PREMIER SURABAYA','DINAS KESEHATAN KABUPATEN POSO','APOTIK GRATI FARMA','RS WIJAYA KUSUMA','KLINIK UTAMA PHC DALWA','RSU ANNA MEDIKA MADURA','APOTEK WONOASIH FARMA','APOTIK MAYANG FARMA','RSUD HADJI BOEJASIN','RSU BRIMEDIKA MALANG','RSUD DAHA HUSADA','RS WIYUNG SEJAHTERA','APOTIK INAS FARMA','APOTIK NEW MITRA SEHAT','PUSKESMAS KEBOMAS GERSIK','KLINIK UTAMA SUKMA WIJAYA','KIMIA FARMA APOTIK SUKOMULYO','RSUD SIMPANG LIMA GUMUL','RSUD DOLOPO MADIUN','APOTIK K24 PELINDO 3','PT. BERGAS WARAS INDONESIA','APOTIK MEGA FARMA (MJKRT)','RSUD R. ALI MANSHUR','APOTIK KUSUMA BANGSA','APOTIK K 24 GADUNG WAGE','KLINIK PRATAMA PHC KEBRAON','RSI NYAI AGENG PINATIH','PUSKESMAS BUNGAH GRESIK','APOTIK K-24 TRUNOJOYO','PUSKESMAS KEDUNG BANTENG','KIMIA FARMA APOTIK 643 GRESIK','RS NAHDLATUL ULAMA JOMBANG','APOTIK K-24 PAMEKASAN','PUSKESMAS SIDOTOPO WETAN','KIMIA FARMA APOTIK 304 PERAK','PUSKESMAS II DENPASAR BARAT','PUSKESMAS KARANGSAMBUNG','RS ISLAM SAKINAH','KIMIA FARMA APOTIK 788 GKB','YAYASAN KLINIK ABDI MULIA','UNIVERSITAS GADJAH MADA','RS GIGI DAN MULUT NALA HUSADA','RS ARAFAH ANWAR MEDIKA','KIMIA FARMA APOTIK 321 LAMONGREJO','RSUD BLAMBANGAN BANYUWANGI','PUSKESMAS PUCANG SEWU','PT. DWI TUNGGAL JAYADI MAKMUR','RSUD BESUKI SITUBONDO','RSIA KENDANGSARI MERR','RS ONKOLOGI SURABAYA','KIMIA FARMA 35 NGAGEL','RS MATA UNDAAN SURABAYA','RS MITRA KELUARGA SATELIT','KIMIA FARMA APOTIK DRIYOREJO','PUSKESMAS KREMBANGAN SELATAN','RSU ASYIFA HUSADA PAMEKASAN','PUSKESMAS PONDOK CABE ILIR','APOTIK K-24 WONOKUSUMO','KIMIA FARMA APOTIK KETINTANG','KIMIA FARMA APOTIK BABAT LAMONGAN','PT. MUTUAL BAHTERA SANTOSO','DR TYAS ( RSUD PASURUAN )','KIMIA FARMA APOTIK 164 KARTINI','KIMIA FARMA APOTIK 0492 IBNU SINA','KIMIA FARMA APOTIK SUMENEP','KIMIA FARMA APOTIK 274 PAMEKASAN','RSIA SITI AISYAH PAMEKASAN','RS PKU MUHAMMADIYAH SURABAYA','KIMIA FARMA APOTIK GEDANGAN','RS NATIONAL DIPONEGORO','PT. SYNERGI ANTAR HUSADA','KIMIA FARMA APOTIK 26 DIPONEGORO','KIMIA FARMA APOTIK 731 USMAN SADAR','KIMIA FARMA APOTIK KUSUMA BANGSA','DINAS KESEHATAN KOTA MAKASSAR','PUSKESMAS PONDOK BENDA','KIMIA FARMA APOTIK 180 PAHLAWAN','KIMIA FARMA APOTIK 124 SEUDATI','KIMIA FARMA APOTIK MULYOSARI','KIMIA FARMA APOTI 460 G. WALK','RSU BUDI KEMULIAAN JAKARTA','APOTIK PEMUDA KAFFA (KONSINYASI)','KIMIA FARMA APOTIK BANYU URIP II','KIMIA FARMA APOTIK 166 A. YANI','KIMIA FARMA MUNUKAN TAMA 2','RSUD WARU KAB PAMEKASAN','KIMIA FARMA APOTIK BOJONEGORO','KIMIA FARMA APOTIK BENDUL MERISI','KIMIA FARMA BLIMBING LAMONGAN','RS MUHAMMADIYAH LAMONGAN','APOTIK K-24 MERR KALIJUDAN','KIMIA FARMA BALONGPANGGANG','DINAS KESEHATAN KOTA BANJAR','KIMIA FARMA APOTIK KUPANG JAYA','KIMIA FARMA APOTIK 419 TRUNOJOYO','KIMIA FARMA APOTIK 163 JOKOTOLE','KIMIA FARMA APOTIK LONTAR','IR UTORO TJAHJO SUDHONO','KIMIA FARMA APOTEK 022 UPN','KLINIK PRATAMA Q-LIFE KLINIK','RS MITRA KELUARGA KENJERAN','PUSKESMAS CIJEUNGJING KAB CIAMIS','DINAS KESEHATAN KABUPATEN MELAWI','APOTIK K24 KETINTANG SURABAYA','KIMIA FARMA APOTIK HR. MUHAMMAD','PUSKESMAS MANUKAN KULON','PUSKESMAS SLEMAN-SRIMULYO','DRG RR. MYRNA ARDIARINI, SP.KG','KIMIA FARMA APOTIK REWWIN','KIMIA FARMA  APOTIK KALIBOKOR','KLINIK PRATAMA RAWAT INAP AL-MIFTAH','KIMIA FARMA APOTIK UNDAAN','KIMIA FARMA APOTIK ARJUNO','KIMIA FARMA AP 432 AMPEL','APOTIK RIZKY PUTRA FARMA','RSUD ABDOER RAHEM SITUBONDO','RSIA PERDANA MEDICA','PUSKESMAS LARANGAN BADUNG','KIMIA FARMA CERME GRESIK','KIMIA FARMA APOTIK WIYUNG 2','KIMIA FARMA KRIAN','KIMIA FARMA APOTIK SAMPANG','RS PERKEBUNAN JEMBER KLINIK','RS MUHAMMADIYAH PAMOTAN','RS YASYFIN DARUSSALAM GONTOR','RUMKIT BAYANGKARA WAHYU TUTUKO','PT. SEMANGAT KARYA MEDIKA','APOTIK HANDIKA FARMA (KONSINYASI)','KIMIA FARMA APOTIK 485 BUKIT PALMA','APOTIK FAJAR (KONSINYASI)','KIMIA FARMA  APOTIK MANUKAN','KLINIK E R H A GALAXY MALL','PUSKESMAS II NEGARA KAB JEMBRANA','APOTIK K-24 DHARMAHUSADA','PT. SURYA MISFALAH ABADI','APOTIK AL KAROMAH (KONSINYASI)','APOTIK KING FARMA (KONSINYASI)','APOTIK PANGSUD BOJONEGORO','RSUD DR MOHAMMAD ZYN SAMPANG','RSUD MOHAMMAD NOER PAMEKASAN','RSUD BANGIL KAB PASURUAN','RS BHAYANGKARA PUSDIK SABHARA','RS BEDAH MANYAR SURABAYA','RSIA MUHAMMADIYAH LUMAJANG','KLINIK PRATAMA PHC TANJUNG PERAK','PUSKESMAS SAPEKEN KAB SUMENEP','DINAS KESEHATAN KABUPATEN NGANJUK','RSUP PROF.DR.I.G.N.G NGOERAH','LAURENSIA VIDYA AYUNINGTYAS., DR','KIMIA FARMA APOTIK 119 DELTASARI','KIMIA FARMA APOTIK 24 DHARMAWANGSA','MEDMAX GLOBAL INDOTAMA, PT','KIMIA FARMA APOTIK 45 DARMO','KLINIK UTAMA RAWAT JALAN PRAMITA','APOTIK SUMBER SEHAT FARMA (SDA)','MARIO MOSES ASTARIMOLANEU','RSUD BUKIT MENOREH MAGELANG','RSUD MANGUSADA KABUPATEN BADUNG','PUSKESMAS SUBAH KABUPATEN BATANG','RS UMUM DARMAYU MADIUN','KIMIA FARMA APOTIK 0668 MENGANTI','KIMIA FARMA APOTIK 52 DUKUH KUPANG','PT. MULIA PERMATA SERAMBI','RSUD DR. ABDOER RAHEM SITUBONDO','BEND. PENGELUARAN RUMKITAL DR RAMELAN','APOTIK PANJAITAN FARMA PROBOLINGGO','RS PELENGKAP MEDICAL CENTER JOMBANG','RSUD PASIRIAN KABUPATEN LUMAJANG','KIMIA FARMA APOTIK KHM. KHOLIL BANGKALAN','KIMIA FARMA 836 ESTHEVA JEMURSARI','KIMIA FARMA APOTIK 175 KARANGMENJANGAN','PT. SPIRIT SEHAT SUKSES INDONESIA','PUSKESMAS KESONGO KABUPATEN BOJONEGORO','RSUD SAPTOSARI KAB GUNUNG KIDUL','PUSKESMAS MALO KABUPATEN BOJONEGORO','RS TNI AU SOEMITRO LANUD MULJONO','KLINIK UTAMA RAWAT INAP GRHA KUMALA','DINAS  LINGKUNGAN HIDUP KAB. LEBAK','KLINIK PRATAMA RAWAT JALAN ROYAL CLINIC MERR','PUSKESMAS SEKARGADUNG PASURUAN','KIMIA APOTIK 994 SUKOLILO','KIMIA FARMA H & B PAKUWON CITY','PT. HOKKY JAYAMAS ABADI (KONSINYASI)','KIMIA FARMA APOTIK 526 RUNGKUT MADYA','RSUD DR DARSONO PACITAN','POLITEKNIK KESEHATAN KALIMANTAN TIMUR KU','APOTIK KALIJATEN 46/PT. BERKAH USAHA PUTERA','APOTIK K 24 MLAJAH / PT. MONZA SATRIA JAYA','APOTIK ABDULLAH (KONSINYASI)','APOTIK K24 TRUNOJOYO SIDOARJO (KONSINYASI)','KLINIK PRATAMA ST. VINCENTIUS A. PAULO','DINAS SOSIAL KABUPATEN BOJONEGORO','RSUD DR R SOSODORO DJATIKOESOEMO','RSUD DR R KOESMA KABUPATEN TUBAN','RSUD BHAKTI DHARMA HUSADA SURABAYA','RSUD DR HARJONO KABUPATEN PONOROGO','RS JIWA MENUR SURABAYA PROV JAWA TIMUR','RSUD DR MOH. SALEH KOTA PROBOLINGGO','RSUD PROVINSI NUSA TENGGARA BARAT','RSUD KELAS D PADANGAN KAB BOJONEGORO','RS ISLAM SITI HAJAR MATARAM','DINAS KESEHATAN KABUPATEN SUMENEP','DINAS KESEHATAN KABUPATEN BULUNGAN','RS ADI HUSADA UNDAAN WETAN','RSUD R.T. NOTOPURO SIDOARJO','PUSKESMAS LARANGAN BADUNG PAMEKASAN','KLINIK UTAMA HEART AND SURGERY CLINIC','RSIA BANTUAN 05.08.05 SURABAYA','DINAS KESEHATAN KOTA SEMARANG','PUSKESMAS SITU GINTUNG','RSUD PRAMBANAN KABUPATEN SLEMAN','RSUD SANJIWANI KABUPATEN GIANYAR','RSUD DR WAHIDIN SUDIRO HUSODO','YAYASAN KESEHATAN MABARROT WRINGINANOM','RSUD MAJENANG KABUPATEN CILACAP','KLINIK PRATAMA RAWAT JALAN GOTONG ROYONG I','PUSKESMAS BANDARAN KAB PAMEKASAN','RSUD GRATI KABUPATEN PASURUAN','RS MATA MASYARAKAT JAWA TIMUR PROV JATIM','PUSKESMAS SEPULU KABUPATEN BANGKALAN','RS UMUM DR. MOH JAMIL PADANG DITJEN PELAYANAN','RSUD DR EKO MAULANA BANGKA BELITUNG','KIMIA FARMA  APOTIK 023 KENDANGSARI','RSUD PLOSO KABUPATEN JOMBANG','RSUD KESEHATAN KERJA PROVINSI JAWA BARAT','RSUD DR SOEHADI PRIJONEGORO KABUPATEN','DINAS KESEHATAN PENGENDALIAN PENDUDUK DAN KB','UNIV. UDAYANA SEKRETARIAT UTAMA KEMENTRIAN P DAN K','RSUD LANTO DG.PASEWANG KAB JENEPONTO','KLINIK RAWAT INAP UTAMA MUHAMMADIYAH KEDUNGADEM','KIMIA FARMA HEALTH & BEAUTY TUNJUNGAN PLAZA 3','RS GIGI DAN MULUT UNIVERSITAS BRAWIJAYA MALANG','RS ORTHOPEDI & TRAUMATOLOGI SURABAYA','RSUD DR H. SLAMET MARTODIRDJO PAMEKASAN','KLINIK PRATAMA RAWAT INAP ARSYFA FIRST MEDIKA','KLINIK RAWAT INAP DAN BERSALIN DELTA MUTIARA','DINAS KESEHATAN KABUPATEN BOGOR/PUSKESMAS TAMANSARI','DINAS KESEHATAN KOTA TANGERANG/PUSKESMAS PERIUK JAYA','RSUD KANJURUHAN KEPANJEN KABUPATEN MALANG','RSUD KABUPATEN MAJENE/DINKES KAB MAJENE','PUSKESMAS I DINAS KESEHATAN KECAMATAN DENPASAR UTARA','RSUD KELAS D KI AGENG SELO WIROSARI KAB GROBOGAN','RUMKIT BHAYANGKARA MATARAM KEPOLISIAN NEGARA REPUBLIK','RS GIGI DAN MULUT GUSTI HASAN AMAN BANJARMASIN','DINAS KESEHATAN KOTA TANGGERANG / UPT INSTALASI FARMASI','RS PARU DR H.A. ROTINSULU BANDUNG DITJEN PELAYANAN','RSUD CUT NYAK DHIEN MEULABOH KAB ACEH','BALAI BESAR KESEHATAN PARU MASYARAKAT BANDUNG DITJEN','APOTIK K 24 RUNGKUT UPN/PT. FATHIYYA ALAMGIR SIDDIQ','PENGADAAN BHP MEDIS FARMASI PAKET 184 RS. UNIV SEBELAS MARET','UNIV. JEMBER SEKRETARIAT UTAMA KEMENTRIAN RISET DAN TEKNOLOGI','RS PENYAKIT INFEKSI PROF. DR SULIANTI SAROSO JAKARTA','BADAN KEPENDUDUKAN DAN KELUARGA BERENCANA NASIONAL','DINAS KESEHATAN DAN KELUARGA BERENCANA KABUPATEN SAMPANG','RS DR. MARZUKI MAHDI BOGOR DITJEN PELAYANAN KESEHATAN','PUSKESMAS KINTAMANI II BANJAR KEMBANGSARI','RS JIWA PROF DR SOEROYO MAGELANG DITJEN PELAYANAN KESEHATAN'
            ].sort();
        },
        getType(name) {
            const n = name.toUpperCase();
            if (n.startsWith('KIMIA FARMA') || n.startsWith('KIMIA APOTIK')) return 'kimia';
            if (n.startsWith('PUSKESMAS')) return 'puskesmas';
            if (n.match(/^(RS |RSU |RSUD |RSUP |RSIA |RSI |RSD |RSPAL |RUMKIT|RUMKITAL|RUMKITBAN)/)) return 'rs';
            if (n.match(/^(APOTIK|APOTEK)/)) return 'apotek';
            if (n.match(/^KLINIK/)) return 'klinik';
            if (n.match(/^(DINKES|DINAS)/)) return 'dinkes';
            return 'lainnya';
        },
        get filtered() {
            let list = this.allClients;
            if (this.activeCategory !== 'all') list = list.filter(c => this.getType(c) === this.activeCategory);
            if (this.search.trim()) { const q = this.search.toLowerCase(); list = list.filter(c => c.toLowerCase().includes(q)); }
            return list;
        },
        countCategory(key) {
            if (key === 'all') return this.allClients.length;
            return this.allClients.filter(c => this.getType(c) === key).length;
        },
        getTypeColor(name) {
            const colors = { rs: 'bg-blue-100 text-blue-700', puskesmas: 'bg-green-100 text-green-700', apotek: 'bg-amber-100 text-amber-700', klinik: 'bg-pink-100 text-pink-700', kimia: 'bg-teal-100 text-teal-700', dinkes: 'bg-indigo-100 text-indigo-700', lainnya: 'bg-gray-100 text-gray-700' };
            return colors[this.getType(name)] || colors.lainnya;
        },
        getTypeIcon(name) {
            const icons = { rs: '\uD83C\uDFE5', puskesmas: '\uD83C\uDFE8', apotek: '\uD83D\uDC8A', klinik: '\uD83E\uDE7A', kimia: '\uD83E\uDDEA', dinkes: '\uD83C\uDFDB', lainnya: '\uD83D\uDCCC' };
            return icons[this.getType(name)] || '\uD83D\uDCCC';
        },
        closePopup() {
            document.getElementById('clientsPopup').classList.add('hidden');
            document.body.style.overflow = '';
        }
    }
}
</script>

{{-- â•”â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•—
    â•‘  POPUP: SERTIFIKAT                                          â•‘
    â•‘  Baris: ~1135 - ~1161                                       â•‘
    â•‘  Modal popup gambar sertifikat (NIB/IDAK/CDAKB)             â•‘
    â•šâ•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• --}}
@if (isset($latestArticles) && $latestArticles->count() > 0)
@php
    $homeArticleFallback = asset('image/logo.png');
    $homeArticleImage = function (?string $image) use ($homeArticleFallback) {
        $image = ltrim((string) $image, '/');

        if (
            $image === ''
            || str_contains($image, '..')
            || (!is_file(storage_path('app/public/' . $image)) && !is_file(public_path('storage/' . $image)))
        ) {
            return $homeArticleFallback;
        }

        return url('/media/' . $image);
    };
@endphp
<section class="bg-white py-16 lg:py-20" aria-labelledby="home-articles-heading">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div class="max-w-2xl">
                <h2 id="home-articles-heading" class="text-3xl font-extrabold leading-tight text-blue-950 sm:text-4xl">
                    Artikel dan Dokumentasi Terbaru
                </h2>
                <p class="mt-3 text-gray-600">
                    Lihat dokumentasi uji fungsi, informasi produk, dan aktivitas PT. Berito Jaya Medika.
                </p>
            </div>
            <a href="{{ route('articles') }}" class="inline-flex w-fit items-center gap-2 rounded-xl bg-blue-800 px-5 py-3 text-sm font-bold text-white transition hover:bg-blue-900">
                Semua Artikel
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <div class="grid gap-5 md:grid-cols-3">
            @foreach ($latestArticles as $article)
                @php $articleDate = $article->published_at ?? $article->created_at; @endphp
                <a href="{{ route('articles.show', $article) }}" class="group overflow-hidden rounded-xl border border-gray-100 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <img src="{{ $homeArticleImage($article->image) }}" alt="{{ $article->title }}" class="aspect-[16/10] w-full bg-gray-50 object-cover transition duration-500 group-hover:scale-105">
                    <div class="p-5">
                        <p class="text-xs font-bold text-red-600">{{ $articleDate->format('d M Y') }}</p>
                        <h3 class="mt-2 line-clamp-2 text-lg font-extrabold leading-tight text-blue-950 group-hover:text-red-600">
                            {{ $article->title }}
                        </h3>
                        <p class="mt-3 line-clamp-3 text-sm leading-relaxed text-gray-600">
                            {{ \Illuminate\Support\Str::limit(strip_tags($article->content), 130) }}
                        </p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Popup Modal untuk Sertifikat -->
<div id="certificatePopup" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen p-4 bg-black bg-opacity-75">
        <div class="relative bg-white rounded-2xl shadow-xl max-w-4xl w-full">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-6 rounded-t-2xl">
                <div class="flex justify-between items-center">
                    <h3 class="text-2xl font-bold" id="certificateTitle">Sertifikat</h3>
                    <button id="closeCertificateBtn" class="text-white hover:text-gray-200 text-2xl font-light">&times;</button>
                </div>
            </div>

            <!-- Content -->
            <div class="p-6">
                <div class="flex items-center justify-center">
                    <img id="certificateImage" src="" alt="Sertifikat" class="max-w-full h-auto rounded-lg shadow-lg">
                    <div class="certificate-watermark"></div>                
                </div>
            </div>

            <!-- Footer -->
            <div class="p-4 bg-gray-50 rounded-b-2xl text-center">
                <p class="text-gray-600 text-sm">Sertifikat resmi PT. BERITO JAYA MEDIKA</p>
            </div>
        </div>
    </div>
</div>

{{-- â•”â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•—
    â•‘  JAVASCRIPT                                                 â•‘
    â•‘  Baris: ~1163 - ~1334                                       â•‘
    â•‘  - Popup klien (buka/tutup)                                 â•‘
    â•‘  - Carousel testimoni (autoplay, navigasi, responsive)      â•‘
    â•‘  - Popup sertifikat (buka/tutup)                            â•‘
    â•šâ•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Popup Klien (with body overflow lock)
    const showMoreClientsBtn = document.getElementById('showMoreClientsBtn');
    const clientsPopup = document.getElementById('clientsPopup');

    if (showMoreClientsBtn) {
        showMoreClientsBtn.addEventListener('click', function () {
            clientsPopup.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        });
    }

    // Carousel Testimoni
    const track = document.getElementById('carouselTrack');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const indicators = document.querySelectorAll('.carousel-indicator');
    
    if (track && prevBtn && nextBtn) {
        const slides = track.children;
        const totalSlides = slides.length;
        let currentIndex = 0;
        let itemsToShow = 1;
        
        function updateItemsToShow() {
            if (window.innerWidth >= 1024) {
                itemsToShow = 3;
            } else if (window.innerWidth >= 768) {
                itemsToShow = 2;
            } else {
                itemsToShow = 1;
            }
            updateCarousel();
        }
        
        function updateCarousel() {
            const slideWidth = 100 / itemsToShow;
            const maxIndex = Math.max(0, totalSlides - itemsToShow);
            currentIndex = Math.max(0, Math.min(currentIndex, maxIndex));
            const offset = -(currentIndex * slideWidth);
            track.style.transform = `translateX(${offset}%)`;
            
            indicators.forEach((indicator, index) => {
                if (index === currentIndex) {
                    indicator.classList.add('bg-blue-600', 'w-8');
                    indicator.classList.remove('bg-gray-300');
                } else {
                    indicator.classList.remove('bg-blue-600', 'w-8');
                    indicator.classList.add('bg-gray-300');
                }
            });
        }
        
        nextBtn.addEventListener('click', () => {
            const maxIndex = Math.max(0, totalSlides - itemsToShow);
            if (currentIndex < maxIndex) {
                currentIndex++;
            } else {
                currentIndex = 0;
            }
            updateCarousel();
        });
        
        prevBtn.addEventListener('click', () => {
            const maxIndex = Math.max(0, totalSlides - itemsToShow);
            if (currentIndex > 0) {
                currentIndex--;
            } else {
                currentIndex = maxIndex;
            }
            updateCarousel();
        });
        
        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                currentIndex = index;
                updateCarousel();
            });
        });
        
        let autoPlayInterval = setInterval(() => {
            const maxIndex = Math.max(0, totalSlides - itemsToShow);
            if (currentIndex < maxIndex) {
                currentIndex++;
            } else {
                currentIndex = 0;
            }
            updateCarousel();
        }, 5000);
        
        track.addEventListener('mouseenter', () => {
            clearInterval(autoPlayInterval);
        });
        
        track.addEventListener('mouseleave', () => {
            autoPlayInterval = setInterval(() => {
                const maxIndex = Math.max(0, totalSlides - itemsToShow);
                if (currentIndex < maxIndex) {
                    currentIndex++;
                } else {
                    currentIndex = 0;
                }
                updateCarousel();
            }, 5000);
        });
        
        window.addEventListener('resize', updateItemsToShow);
        updateItemsToShow();
    }
});

// Fungsi untuk menampilkan popup sertifikat
function showCertificate(type) {
    const popup = document.getElementById('certificatePopup');
    const title = document.getElementById('certificateTitle');
    const image = document.getElementById('certificateImage');
    
    // Sesuaikan dengan path gambar sertifikat Anda
    const certificates = {
        'nib': {
            title: 'Nomor Induk Berusaha',
            image: '/image/certificates/NIB.jpg' // Sesuaikan path
        },
        'izin': {
            title: 'Izin Distribusi Alat Kesehatan',
            image: '/image/certificates/IDAK.jpg' // Sesuaikan path
        },
        'cdakb': {
            title: 'Sertifikat CDAKB',
            image: '/image/certificates/CDAKB.jpg' // Sesuaikan path
        }
    };
    
    if (certificates[type]) {
        title.textContent = certificates[type].title;
        image.src = certificates[type].image;
        popup.classList.remove('hidden');
    }
}

// Event listener untuk menutup popup sertifikat
document.addEventListener('DOMContentLoaded', function() {
    const closeCertificateBtn = document.getElementById('closeCertificateBtn');
    const certificatePopup = document.getElementById('certificatePopup');
    
    if (closeCertificateBtn) {
        closeCertificateBtn.addEventListener('click', function() {
            certificatePopup.classList.add('hidden');
        });
    }
    
    window.addEventListener('click', function(event) {
        if (event.target === certificatePopup) {
            certificatePopup.classList.add('hidden');
        }
    });
});
</script>

{{-- â•”â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•—
    â•‘  CSS STYLES                                                 â•‘
    â•‘  Baris: ~1336 - ~1392                                       â•‘
    â•‘  - Animasi blob, line-clamp, carousel, watermark            â•‘
    â•šâ•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• --}}
<style>
@keyframes blob {
    0% { transform: translate(0px, 0px) scale(1); }
    33% { transform: translate(30px, -50px) scale(1.1); }
    66% { transform: translate(-20px, 20px) scale(0.9); }
    100% { transform: translate(0px, 0px) scale(1); }
}

.animate-blob {
    animation: blob 7s infinite;
}

.animation-delay-2000 {
    animation-delay: 2s;
}

.line-clamp-6 {
    display: -webkit-box;
    -webkit-line-clamp: 6;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

#carouselTrack {
    display: flex;
}

#carouselTrack > * {
    flex: 0 0 100%;
}

@media (min-width: 768px) {
    #carouselTrack > * {
        flex: 0 0 50%;
    }
}

@media (min-width: 1024px) {
    #carouselTrack > * {
        flex: 0 0 33.333333%;
    }
}

.certificate-watermark {
    position: absolute;
    inset: 0;
    pointer-events: none;

    /* repeating watermark */
    background-image: url('/image/logo.png');
    background-repeat: repeat;
    background-size: 100px; /* atur besar logo repeating */
    opacity: 0.12; /* transparansi */
    transform: rotate(-20deg); /* miring seperti dokumen resmi */
    mix-blend-mode: multiply; /* efek lebih menyatu */
}
</style>

@endsection
