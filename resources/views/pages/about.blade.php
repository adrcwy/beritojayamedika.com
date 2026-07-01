@extends('layouts.public')

@section('title', 'Tentang Distributor Alkes Surabaya - PT. Berito Jaya Medika')
@section('meta_description', 'Kenali PT. Berito Jaya Medika, distributor alat kesehatan Surabaya yang melayani kebutuhan alat medis, alat laboratorium, dan pengadaan alkes di Indonesia sejak 1998.')
@section('meta_keywords', 'tentang pt. berito jaya medika, distributor alkes surabaya, perusahaan alat kesehatan surabaya, supplier alat medis indonesia')
@section('canonical', route('about'))

@section('content')

<!-- Hero - About Introduction -->
<div class="relative bg-gradient-to-br from-blue-50 via-white to-blue-50 overflow-hidden">
    <div class="absolute top-0 left-0 w-64 h-64 sm:w-96 sm:h-96 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
    <div class="absolute bottom-0 right-0 w-64 h-64 sm:w-96 sm:h-96 bg-yellow-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24 lg:py-32 relative z-10">
        <div class="max-w-3xl mx-auto text-center">
            <!-- Badge -->
            <div data-aos="fade-down" data-aos-duration="600">
                <span class="inline-flex items-center gap-2 px-5 py-2.5 bg-white border border-gray-200 text-gray-600 text-sm font-semibold rounded-full mb-8 shadow-sm">
                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                    Distributor Resmi Alat Kesehatan Sejak 1998
                </span>
            </div>

            <!-- Company Name -->
            <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold tracking-tight leading-[1.1] mb-6" data-aos="fade-up" data-aos-duration="800">
                <span class="text-blue-900">Tentang</span><br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-600 via-red-500 to-red-600">PT. Berito Jaya Medika</span>
            </h1>

            <!-- Tagline -->
            <p class="text-lg sm:text-xl text-gray-600 max-w-xl mx-auto leading-relaxed mb-10" data-aos="fade-up" data-aos-delay="200">
                Partner terpercaya dalam penyediaan <strong class="text-blue-900">alat kesehatan</strong>,
                <strong class="text-blue-900">laboratorium</strong> & <strong class="text-blue-900">alat medis</strong>
                untuk fasilitas kesehatan di seluruh Indonesia.
            </p>

            <!-- Stats Row -->
            <div class="flex items-center justify-center gap-6 sm:gap-10" data-aos="fade-up" data-aos-delay="300">
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

<!-- Values Section -->
<div class="bg-gradient-to-b from-gray-50 to-white py-20 lg:py-28">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center" data-aos="fade-up">
            <span class="inline-block px-4 py-2 bg-red-100 text-red-600 text-sm font-bold rounded-full mb-4">Nilai-Nilai Kami</span>
            <h3 class="mt-2 text-4xl md:text-5xl font-extrabold text-blue-900 tracking-tight">
                Fondasi Kami dalam Melayani
            </h3>
        </div>

        <div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="group relative" data-aos="fade-up" data-aos-delay="100">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-blue-600 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform rotate-3"></div>
                <div class="relative bg-white rounded-3xl shadow-xl p-8 transform hover:-translate-y-2 transition-all duration-300">
                    <div class="flex items-center justify-center w-20 h-20 rounded-2xl bg-gradient-to-br from-blue-100 to-blue-200 text-blue-700 mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-10 h-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                    </div>
                    <h4 class="text-2xl font-bold text-blue-900 text-center mb-4">Integritas</h4>
                    <p class="text-center text-gray-600 leading-relaxed">
                        Menjalankan bisnis dengan jujur, transparan, dan etis dalam setiap interaksi.
                    </p>
                </div>
            </div>
            
            <div class="group relative" data-aos="fade-up" data-aos-delay="300">
                <div class="absolute inset-0 bg-gradient-to-r from-red-500 to-red-600 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform rotate-3"></div>
                <div class="relative bg-white rounded-3xl shadow-xl p-8 transform hover:-translate-y-2 transition-all duration-300">
                    <div class="flex items-center justify-center w-20 h-20 rounded-2xl bg-gradient-to-br from-red-100 to-red-200 text-red-700 mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-10 h-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                        </svg>
                    </div>
                    <h4 class="text-2xl font-bold text-blue-900 text-center mb-4">Kualitas</h4>
                    <p class="text-center text-gray-600 leading-relaxed">
                        Hanya menyediakan produk terbaik yang telah teruji dan memenuhi standar.
                    </p>
                </div>
            </div>

            <div class="group relative" data-aos="fade-up" data-aos-delay="500">
                <div class="absolute inset-0 bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform rotate-3"></div>
                <div class="relative bg-white rounded-3xl shadow-xl p-8 transform hover:-translate-y-2 transition-all duration-300">
                    <div class="flex items-center justify-center w-20 h-20 rounded-2xl bg-gradient-to-br from-yellow-100 to-yellow-200 text-yellow-700 mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-10 h-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.056 3 12s4.03 8.25 9 8.25zM12 12a3 3 0 100-6 3 3 0 000 6z" />
                        </svg>
                    </div>
                    <h4 class="text-2xl font-bold text-blue-900 text-center mb-4">Pelayanan</h4>
                    <p class="text-center text-gray-600 leading-relaxed">
                        Berfokus pada kepuasan pelanggan melalui respons cepat dan solusi yang efektif.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Services Section -->
<div class="bg-white py-20 lg:py-28">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Technical Support -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center mb-32">
            <div data-aos="fade-right" data-aos-duration="800">
                <span class="inline-block px-4 py-2 bg-blue-100 text-blue-900 text-sm font-bold rounded-full mb-4">Layanan Profesional</span>
                <h3 class="mt-2 text-4xl md:text-5xl font-extrabold text-blue-900 tracking-tight leading-tight">
                    Dukungan Teknis Profesional
                </h3>
                <p class="mt-6 text-lg text-gray-600 leading-relaxed">
                    Tim teknisi kami tidak hanya melakukan instalasi, tetapi juga menyediakan layanan pemeliharaan berkala untuk memastikan alat Anda bekerja optimal.
                </p>
                <div class="mt-8 space-y-4">
                    <div class="flex items-start gap-4 p-4 bg-blue-50 rounded-xl" data-aos="fade-right" data-aos-delay="200">
                        <div class="flex-shrink-0 w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-blue-900">Instalasi & Uji Fungsi</h4>
                            <p class="text-gray-600">Pengaturan profesional dengan pengujian menyeluruh</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 p-4 bg-blue-50 rounded-xl" data-aos="fade-right" data-aos-delay="400">
                        <div class="flex-shrink-0 w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-blue-900">Perbaikan & Suku Cadang Asli</h4>
                            <p class="text-gray-600">Garansi keaslian dan kualitas komponen</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative flex justify-center" data-aos="fade-left" data-aos-duration="800">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-100 to-blue-50 rounded-3xl transform rotate-3"></div>
                <img class="relative rounded-2xl shadow-2xl transform hover:scale-105 transition-transform duration-500" src="https://virtudigilab.com/wp-content/uploads/2022/01/patology-anatomy-copy.jpg" alt="Technical Support">
            </div>
        </div>
        
        <!-- Distribution Network -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="relative flex justify-center order-last lg:order-first" data-aos="fade-right" data-aos-duration="800">
                <div class="absolute inset-0 bg-gradient-to-br from-yellow-100 to-yellow-50 rounded-3xl transform -rotate-3"></div>
                <img class="relative rounded-2xl shadow-2xl transform hover:scale-105 transition-transform duration-500" src="https://images.unsplash.com/photo-1542744173-05336fcc7ad4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1770&q=80" alt="Tim sedang konsultasi">
            </div>
            <div data-aos="fade-left" data-aos-duration="800">
                <span class="inline-block px-4 py-2 bg-red-100 text-red-600 text-sm font-bold rounded-full mb-4">Konsultasi & Distribusi</span>
                <h3 class="mt-2 text-4xl md:text-5xl font-extrabold text-blue-900 tracking-tight leading-tight">
                    Jaringan Distribusi Nasional
                </h3>
                <p class="mt-6 text-lg text-gray-600 leading-relaxed">
                    Dengan pengalaman bertahun-tahun, kami siap membantu Anda menemukan solusi alat kesehatan yang paling tepat dan efisien untuk kebutuhan fasilitas Anda.
                </p>
                <div class="mt-8 space-y-4">
                    <div class="flex items-start gap-4 p-4 bg-red-50 rounded-xl" data-aos="fade-left" data-aos-delay="200">
                        <div class="flex-shrink-0 w-10 h-10 bg-red-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-blue-900">Konsultasi Kebutuhan Produk</h4>
                            <p class="text-gray-600">Analisis mendalam untuk solusi optimal</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 p-4 bg-red-50 rounded-xl" data-aos="fade-left" data-aos-delay="300">
                        <div class="flex-shrink-0 w-10 h-10 bg-red-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-blue-900">Jaminan Ketersediaan Stok</h4>
                            <p class="text-gray-600">Pasokan berkelanjutan tanpa gangguan</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 p-4 bg-red-50 rounded-xl" data-aos="fade-left" data-aos-delay="400">
                        <div class="flex-shrink-0 w-10 h-10 bg-red-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-blue-900">Pengiriman Tepat Waktu</h4>
                            <p class="text-gray-600">Jangkauan ke seluruh Indonesia</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Partners Section -->
<div class="bg-gradient-to-b from-gray-50 to-white py-20 lg:py-28">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center" data-aos="fade-up">
            <span class="inline-block px-4 py-2 bg-red-100 text-red-600 text-sm font-bold rounded-full mb-4">Mitra Kami</span>
            <h3 class="mt-2 text-4xl md:text-5xl font-extrabold text-blue-900 tracking-tight">
                Tersedia Merk / Brand
            </h3>
            <p class="mt-6 max-w-2xl mx-auto text-xl text-gray-600">
                Kami bekerja sama dengan para pemimpin industri untuk menghadirkan teknologi medis terbaik bagi Anda.
            </p>
        </div>

        <!-- Grid Mitra Utama -->
        <div id="partners-grid" class="mt-20 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-8">
            <div class="flex flex-col items-center text-center group" data-aos="fade-up" data-aos-delay="100">
                <div class="w-28 h-28 rounded-2xl bg-white border-2 border-gray-200 flex items-center justify-center mb-4 shadow-lg group-hover:shadow-2xl group-hover:border-blue-500 transition-all duration-300 transform group-hover:scale-110">
                    <img src="image/toocare.png" alt="Logo Brand 1" class="w-20 h-20 object-contain grayscale group-hover:grayscale-0 transition-all duration-300">
                </div>
                <p class="text-sm font-bold text-gray-700">TOO CARE</p>
            </div>
            <div class="flex flex-col items-center text-center group" data-aos="fade-up" data-aos-delay="150">
                <div class="w-28 h-28 rounded-2xl bg-white border-2 border-gray-200 flex items-center justify-center mb-4 shadow-lg group-hover:shadow-2xl group-hover:border-blue-500 transition-all duration-300 transform group-hover:scale-110">
                    <img src="https://www.remediams.com/assets/files/14495-remedi-brand-logo.jpg" alt="Logo Brand 2" class="w-20 h-20 object-contain grayscale group-hover:grayscale-0 transition-all duration-300">
                </div>
                <p class="text-sm font-bold text-gray-700">REMEDI</p>
            </div>
            <div class="flex flex-col items-center text-center group" data-aos="fade-up" data-aos-delay="200">
                <div class="w-28 h-28 rounded-2xl bg-white border-2 border-gray-200 flex items-center justify-center mb-4 shadow-lg group-hover:shadow-2xl group-hover:border-blue-500 transition-all duration-300 transform group-hover:scale-110">
                    <img src="data:image/png;base64,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" alt="Logo Brand 3" class="w-20 h-20 object-contain grayscale group-hover:grayscale-0 transition-all duration-300">
                </div>
                <p class="text-sm font-bold text-gray-700">ONE HEALTH</p>
            </div>
            <div class="flex flex-col items-center text-center group" data-aos="fade-up" data-aos-delay="250">
                <div class="w-28 h-28 rounded-2xl bg-white border-2 border-gray-200 flex items-center justify-center mb-4 shadow-lg group-hover:shadow-2xl group-hover:border-blue-500 transition-all duration-300 transform group-hover:scale-110">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQJpIURaSgCa-2LtqjsjU1C8f5uOxwgfp2ADQ&s" alt="Logo Brand 4" class="w-20 h-20 object-contain grayscale group-hover:grayscale-0 transition-all duration-300">
                </div>
                <p class="text-sm font-bold text-gray-700">AMPM</p>
            </div>
            <div class="flex flex-col items-center text-center group" data-aos="fade-up" data-aos-delay="300">
                <div class="w-28 h-28 rounded-2xl bg-white border-2 border-gray-200 flex items-center justify-center mb-4 shadow-lg group-hover:shadow-2xl group-hover:border-blue-500 transition-all duration-300 transform group-hover:scale-110">
                    <img src="https://smhealth.store/cdn/shop/collections/SHOPIFY_Brands_Collections_Icon_dc80a87c-4b89-4f9f-be1d-1b8f81482de3_1200x1200.png?v=1667529300" alt="Logo Brand 5" class="w-20 h-20 object-contain grayscale group-hover:grayscale-0 transition-all duration-300">
                </div>
                <p class="text-sm font-bold text-gray-700">SINOCARE</p>
            </div>
            <div class="flex flex-col items-center text-center group" data-aos="fade-up" data-aos-delay="350">
                <div class="w-28 h-28 rounded-2xl bg-white border-2 border-gray-200 flex items-center justify-center mb-4 shadow-lg group-hover:shadow-2xl group-hover:border-blue-500 transition-all duration-300 transform group-hover:scale-110">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSigHjNnef3fKx7M8X9YPccvh4VDOW_Pm7eWA&s" alt="Logo Brand 6" class="w-20 h-20 object-contain grayscale group-hover:grayscale-0 transition-all duration-300">
                </div>
                <p class="text-sm font-bold text-gray-700">ONE MED</p>
            </div>
            <div class="flex flex-col items-center text-center group" data-aos="fade-up" data-aos-delay="400">
                <div class="w-28 h-28 rounded-2xl bg-white border-2 border-gray-200 flex items-center justify-center mb-4 shadow-lg group-hover:shadow-2xl group-hover:border-blue-500 transition-all duration-300 transform group-hover:scale-110">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTBEFcpQ1iC1_K0WIV1LUa_rboTvysnzQZ04g&s" alt="Logo Brand 7" class="w-20 h-20 object-contain grayscale group-hover:grayscale-0 transition-all duration-300">
                </div>
                <p class="text-sm font-bold text-gray-700">GEA MEDICAL</p>
            </div>
            <div class="flex flex-col items-center text-center group" data-aos="fade-up" data-aos-delay="450">
                <div class="w-28 h-28 rounded-2xl bg-white border-2 border-gray-200 flex items-center justify-center mb-4 shadow-lg group-hover:shadow-2xl group-hover:border-blue-500 transition-all duration-300 transform group-hover:scale-110">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRcB34nMLld2hu_7wbZ31AOIfESVgoEgOKO7w&s" alt="Logo Brand 8" class="w-20 h-20 object-contain grayscale group-hover:grayscale-0 transition-all duration-300">
                </div>
                <p class="text-sm font-bold text-gray-700">TERUMO</p>
            </div>
            <div class="flex flex-col items-center text-center group" data-aos="fade-up" data-aos-delay="500">
                <div class="w-28 h-28 rounded-2xl bg-white border-2 border-gray-200 flex items-center justify-center mb-4 shadow-lg group-hover:shadow-2xl group-hover:border-blue-500 transition-all duration-300 transform group-hover:scale-110">
                    <img src="https://denusastore.com/wp-content/uploads/2025/09/life-resources.png" alt="Logo Brand 9" class="w-20 h-20 object-contain grayscale group-hover:grayscale-0 transition-all duration-300">
                </div>
                <p class="text-sm font-bold text-gray-700">RESOURCES</p>
            </div>
            <div class="flex flex-col items-center text-center group" data-aos="fade-up" data-aos-delay="550">
                <div class="w-28 h-28 rounded-2xl bg-white border-2 border-gray-200 flex items-center justify-center mb-4 shadow-lg group-hover:shadow-2xl group-hover:border-blue-500 transition-all duration-300 transform group-hover:scale-110">
                    <img src="https://www.galerimedika.com/image/cache/catalog/brands/small-general-care-600x315w.jpg" alt="Logo Brand 10" class="w-20 h-20 object-contain grayscale group-hover:grayscale-0 transition-all duration-300">
                </div>
                <p class="text-sm font-bold text-gray-700">General Care</p>
            </div>
        </div>

        <!-- Tombol Selengkapnya -->
        <div class="mt-16 text-center">
            <button id="showMorePartnersBtn" class="px-8 py-3 bg-red-600 text-white font-semibold rounded-full shadow-lg hover:bg-red-700 transition-colors duration-300 transform hover:scale-105">
                Selengkapnya
            </button>
        </div>
    </div>
</div>


<!-- Popup Modal untuk Merk/Brand (Alpine.js Interactive) -->
<div id="partnersPopup" class="fixed inset-0 z-50 hidden overflow-y-auto" x-data="brandsPopupApp()" x-init="init()">
    <div class="flex items-center justify-center min-h-screen p-4 bg-black bg-opacity-50" @click.self="closePopup()">
        <div class="relative bg-white rounded-2xl shadow-xl max-w-4xl w-full max-h-[90vh] flex flex-col" @click.stop>
            <!-- Header -->
            <div class="bg-gradient-to-r from-red-600 to-red-800 text-white p-6 rounded-t-2xl">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <h3 class="text-2xl font-bold">Daftar Lengkap Merk / Brand</h3>
                        <p class="text-red-200 text-sm mt-1">
                            Menampilkan <span class="font-bold text-white" x-text="filtered.length"></span> dari <span class="font-bold text-white" x-text="allBrands.length"></span> brand
                        </p>
                    </div>
                    <button @click="closePopup()" class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center hover:bg-white/30 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <!-- Search -->
                <div class="relative">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input type="text" x-model="search" placeholder="Cari brand..." class="w-full pl-12 pr-4 py-3 bg-white/20 backdrop-blur-sm border border-white/30 rounded-xl text-white placeholder-red-200 focus:outline-none focus:ring-2 focus:ring-white/50">
                </div>
            </div>
            <!-- Content -->
            <div class="p-6 overflow-y-auto flex-grow">
                <div x-show="filtered.length > 0" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                    <template x-for="brand in filtered" :key="brand">
                        <div class="flex items-center gap-3 bg-gradient-to-r from-red-50 to-red-100/50 hover:from-red-100 hover:to-red-200/50 py-3 px-4 rounded-xl transition-all duration-200 group">
                            <div class="w-8 h-8 bg-red-600 text-white rounded-lg flex items-center justify-center text-xs font-bold flex-shrink-0">
                                <span x-text="brand.charAt(0)"></span>
                            </div>
                            <span class="text-sm font-semibold text-gray-800 group-hover:text-red-700 transition-colors" x-text="brand"></span>
                        </div>
                    </template>
                </div>
                <div x-show="filtered.length === 0" class="flex flex-col items-center justify-center py-16">
                    <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <h4 class="text-lg font-bold text-gray-500">Brand tidak ditemukan</h4>
                    <p class="text-gray-400 text-sm mt-1">Coba kata kunci lain</p>
                </div>
            </div>
            <!-- Footer -->
            <div class="p-4 bg-gray-50 rounded-b-2xl text-center border-t border-gray-100">
                <p class="text-gray-600 text-sm">Inovasi kesehatan terbaik.</p>
            </div>
        </div>
    </div>
</div>
<script>
function brandsPopupApp() {
    return {
        search: '',
        allBrands: [],
        init() {
            this.allBrands = ['TOO CARE','REMEDI','ONE HEALTH','AMPM','SINOCARE','OMRON','RESOURCES','ONEMED','GEA MEDICAL','GENERAL CARE','FORSCH','BSN','RUSCH','PAHSCO','TERUMO','JMS','BD','SONY','RIESTER','ABN','YUWELL','JUARA MEDICAL','CORE-RAY','DENSPLY'].sort();
        },
        get filtered() {
            if (!this.search.trim()) return this.allBrands;
            const q = this.search.toLowerCase();
            return this.allBrands.filter(b => b.toLowerCase().includes(q));
        },
        closePopup() {
            document.getElementById('partnersPopup').classList.add('hidden');
            document.body.style.overflow = '';
        }
    }
}
document.addEventListener('DOMContentLoaded', function () {
    const showMorePartnersBtn = document.getElementById('showMorePartnersBtn');
    if (showMorePartnersBtn) {
        showMorePartnersBtn.addEventListener('click', function () {
            document.getElementById('partnersPopup').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        });
    }
});
</script>


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

.animation-delay-4000 {
    animation-delay: 4s;
}
</style>

@endsection
