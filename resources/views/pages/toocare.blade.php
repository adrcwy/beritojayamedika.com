@extends('layouts.public')

@section('title', 'Too Care | Produk Kesehatan PT. Berito Jaya Medika')
@section('meta_description', 'Too Care adalah brand produk kesehatan dari PT. Berito Jaya Medika untuk mendukung kebutuhan perawatan kesehatan masyarakat Indonesia.')
@section('meta_keywords', 'too care, produk kesehatan, brand alat kesehatan, pt. berito jaya medika, alkes surabaya')
@section('canonical', route('toocare'))

@section('content')

<div class="relative bg-gradient-to-b from-white via-emerald-50/40 to-white py-20 sm:py-28 overflow-hidden">
    <div class="absolute inset-0 opacity-15">
        <div class="absolute top-20 left-10 w-72 h-72 bg-emerald-200 rounded-full mix-blend-multiply filter blur-3xl animate-blob"></div>
        <div class="absolute top-40 right-10 w-72 h-72 bg-teal-200 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-20 left-1/2 w-72 h-72 bg-cyan-200 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-4000"></div>
    </div>
    
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="max-w-5xl mx-auto text-center">

            <div class="mb-6" data-aos="fade-down" data-aos-duration="800"> <!-- jarak ditambah -->
                <div class="inline-block relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-200 to-teal-300 rounded-[2rem] blur-3xl opacity-20 animate-pulse"></div>

                    <div class="relative bg-gradient-to-br from-emerald-50 via-teal-50 to-white rounded-[2rem] p-2 shadow-2xl transform hover:scale-105 transition-all duration-500 border-4 border-emerald-100">

                        <img src="{{ asset('image/toocare.png') }}"
                            alt="Too Care Logo"
                            class="w-40 h-36 object-contain mx-auto">
                    </div>
                </div>
            </div>

            <h1 class="text-3xl md:text-5xl font-black bg-clip-text bg-gradient-to-r from-emerald-600 via-teal-600 to-cyan-600 mb-4" data-aos="fade-up" data-aos-delay="100">
                
                Too Care
            </h1>

            <div class="inline-block mb-6" data-aos="fade-up" data-aos-delay="200">
                <p class="text-lg md:text-xl text-emerald-600 font-bold px-6 py-2 bg-white/60 backdrop-blur-sm rounded-full shadow-lg border-2 border-emerald-200">
                    Caring for Your Health
                </p>
            </div>

            <p class="text-base text-gray-700 max-w-3xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="300">
                Too Care adalah brand terbaru dari PT. Berito Jaya Medika yang menghadirkan produk-produk kesehatan inovatif dan berkualitas tinggi untuk meningkatkan kualitas hidup masyarakat Indonesia.
            </p>
        </div>
    </div>
</div>


<!-- Current Products Section -->
<div class="bg-white py-24 relative overflow-hidden">
    <!-- Decorative Background -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-emerald-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 float-animation"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-teal-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 float-animation" style="animation-delay: 2s;"></div>
    </div>
    
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative">
        <!-- Section Header -->
        <div class="text-center mb-20" data-aos="fade-up">

           <h2 class="text-3xl sm:text-5xl md:text-6xl font-black mb-4 sm:mb-6">
            <span class="tag-badge text-white px-6 py-2.5 rounded-full text-sm font-bold tracking-wider uppercase shadow-lg">
                    Produk Kami 
                </span>
            </h2>
        </div>

        <!-- Products Grid -->
        <div class="max-w-7xl mx-auto grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 sm:gap-6">
            
            <!-- Product 1: Alcohol -->
            <div class="gradient-border group rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3" data-aos="fade-up" data-aos-delay="400">
                <div class="relative aspect-square overflow-hidden bg-gradient-to-br from-blue-100 via-blue-50 to-white">
                    <img src="{{ asset('image/product1.png') }}" alt="Alcohol 70%" 
                         class="w-full h-full object-contain p-6 transform group-hover:scale-110 group-hover:rotate-3 transition-all duration-700">
                    <div class="absolute top-4 left-4">
                        <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                            HYGIENE
                        </span>
                    </div>
                </div>
                <div class="p-3 sm:p-6 bg-white">
                    <h3 class="text-sm sm:text-xl font-black text-gray-900 mb-1 sm:mb-3 group-hover:text-teal-600 transition-colors">
                        ALCOHOL 70%
                    </h3>
                    <div class="space-y-1 text-xs sm:text-sm text-gray-600">
                        <p class="font-semibold text-blue-600">✓ Alcohol 70%</p>
                        <p class="font-semibold text-blue-600">✓ Mudah dibuka & ditutup</p>
                        <p class="font-semibold text-blue-600">✓ Aman untuk kulit</p>
                        <div class="pt-3 mt-3 border-t border-gray-100">
                            <p class="text-xs text-gray-500 italic">Antiseptik pembersih luka yang efektif</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product 2: Celana Khitan -->
            <div class="gradient-border group rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3" data-aos="fade-up" data-aos-delay="400">
                <div class="relative aspect-square overflow-hidden bg-gradient-to-br from-blue-100 via-blue-50 to-white">
                    <img src="{{ asset('image/product2.png') }}" alt="Celana Khitan" 
                         class="w-full h-full object-contain p-6 transform group-hover:scale-110 group-hover:rotate-3 transition-all duration-700">
                    <div class="absolute top-4 left-4">
                        <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                            PROTECTION
                        </span>
                    </div>
                </div>
                <div class="p-3 sm:p-6 bg-white">
                    <h3 class="text-sm sm:text-xl font-black text-gray-900 mb-1 sm:mb-3 group-hover:text-teal-600 transition-colors">
                        CELANA KHITAN
                    </h3>
                    <div class="space-y-1 text-xs sm:text-sm text-gray-600">
                        <p class="font-semibold text-blue-600">✓ Spon kuat & elastis</p>
                        <p class="font-semibold text-blue-600">✓ 100% cotton</p>
                        <p class="font-semibold text-blue-600">✓ Anti panas</p>
                        <p class="font-semibold text-blue-600">✓ Ukuran S, M, L, XL</p>
                        <div class="pt-3 mt-3 border-t border-gray-100">
                            <p class="text-xs text-gray-500 italic">Melindungi luka pasca sunat</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product 3: Povidone Iodine -->
            <div class="gradient-border group rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3" data-aos="fade-up" data-aos-delay="400">
                <div class="relative aspect-square overflow-hidden bg-gradient-to-br from-blue-100 via-blue-50 to-white">
                    <img src="{{ asset('image/product3.png') }}" alt="Povidone Iodine" 
                         class="w-full h-full object-contain p-6 transform group-hover:scale-110 group-hover:rotate-3 transition-all duration-700">
                    <div class="absolute top-4 left-4">
                        <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                            HYGIENE
                        </span>
                    </div>
                </div>
                <div class="p-3 sm:p-6 bg-white">
                    <h3 class="text-sm sm:text-xl font-black text-gray-900 mb-1 sm:mb-3 group-hover:text-teal-600 transition-colors">
                        POVIDONE IODINE
                    </h3>
                    <div class="space-y-1 text-xs sm:text-sm text-gray-600">
                        <p class="font-semibold text-blue-600">✓ Povidone iodine 10%</p>
                        <p class="font-semibold text-blue-600">✓ pH balance</p>
                        <p class="font-semibold text-blue-600">✓ Tidak pedih</p>
                        <p class="font-semibold text-blue-600">✓ Berbagai ukuran</p>
                        <div class="pt-3 mt-3 border-t border-gray-100">
                            <p class="text-xs text-gray-500 italic">Mengobati & mencegah infeksi luka</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product 4: Spalk Gip Infus -->
            <div class="gradient-border group rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3" data-aos="fade-up" data-aos-delay="400">
                <div class="relative aspect-square overflow-hidden bg-gradient-to-br from-blue-100 via-blue-50 to-white">
                    <img src="{{ asset('image/product4.png') }}" alt="Spalk Gip Infus" 
                         class="w-full h-full object-contain p-6 transform group-hover:scale-110 group-hover:rotate-3 transition-all duration-700">
                    <div class="absolute top-4 left-4">
                        <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                            MEDICAL SUPPLY
                        </span>
                    </div>
                </div>
                <div class="p-3 sm:p-6 bg-white">
                    <h3 class="text-sm sm:text-xl font-black text-gray-900 mb-1 sm:mb-3 group-hover:text-teal-600 transition-colors">
                        SPALK GIP INFUS
                    </h3>
                    <div class="space-y-1 text-xs sm:text-sm text-gray-600">
                        <p class="font-semibold text-blue-600">✓ Kain busa + papan</p>
                        <p class="font-semibold text-blue-600">✓ 1 Pack isi 20 pcs</p>
                        <p class="font-semibold text-blue-600">✓ Kuat & nyaman</p>
                        <div class="pt-3 mt-3 border-t border-gray-100">
                            <p class="text-xs text-gray-500 italic">Penahan infus agar tidak bergeser</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product 5: Spalk Bidai -->
            <div class="gradient-border group rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3" data-aos="fade-up" data-aos-delay="400">
                <div class="relative aspect-square overflow-hidden bg-gradient-to-br from-blue-100 via-blue-50 to-white">
                    <img src="{{ asset('image/product5.png') }}" alt="Spalk Bidai Patah Tulang" 
                         class="w-full h-full object-contain p-6 transform group-hover:scale-110 group-hover:rotate-3 transition-all duration-700">
                    <div class="absolute top-4 left-4">
                        <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                            MEDICAL SUPPL5
                        </span>
                    </div>
                </div>
                <div class="p-3 sm:p-6 bg-white">
                    <h3 class="text-sm sm:text-xl font-black text-gray-900 mb-1 sm:mb-3 group-hover:text-teal-600 transition-colors">
                        SPALK BIDAI KAKI
                    </h3>
                    <div class="space-y-1 text-xs sm:text-sm text-gray-600">
                        <p class="font-semibold text-indigo-600">✓ Spons empuk</p>
                        <p class="font-semibold text-indigo-600">✓ Kuat & ringan</p>
                        <p class="font-semibold text-indigo-600">✓ Panjang 110 cm</p>
                        <div class="pt-3 mt-3 border-t border-gray-100">
                            <p class="text-xs text-gray-500 italic">Immobilisasi tulang patah</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Produk Terbaru Section (with PDF Brochure Modal) -->
<div class="bg-white py-24 relative overflow-hidden" x-data="{ pdfModal: false, pdfUrl: '', pdfTitle: '' }">
    <!-- Decorative Background -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 right-10 w-72 h-72 bg-emerald-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 float-animation"></div>
        <div class="absolute bottom-20 left-10 w-96 h-96 bg-teal-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 float-animation" style="animation-delay: 2s;"></div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center mb-20" data-aos="fade-up">
            <h2 class="text-3xl sm:text-5xl md:text-6xl font-black mb-4 sm:mb-6">
                <span class="tag-badge text-white px-6 py-2.5 rounded-full text-sm font-bold tracking-wider uppercase shadow-lg">
                    Produk Terbaru
                </span>
            </h2>
        </div>

        <div class="max-w-7xl mx-auto grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 sm:gap-6">
            @foreach([
                ['img' => 'comingsoon1.png', 'title' => 'TOO CARE PATIENT MONITOR 5 PARAMETER', 'desc' => 'Pemantauan tanda vital pasien (EKG, SpO2, NIBP) secara real-time dan akurat.', 'pdf' => 'brochure/TOO CARE PATIENT MONITOR 5 PARAMETER (A4).pdf', 'img1' => 'brochure/TOO-CARE-PATIENT-MONITOR-5-PARAMETER-A4/TOO CARE PATIENT MONITOR 5 PARAMETER (A4)_page-0001.jpg', 'img2' => 'brochure/TOO-CARE-PATIENT-MONITOR-5-PARAMETER-A4/TOO CARE PATIENT MONITOR 5 PARAMETER (A4)_page-0002.jpg'],
                ['img' => 'comingsoon2.png', 'title' => 'TOO CARE VIDEO LARINGOSCOPE 4,5"', 'desc' => 'Visualisasi jalan napas jernih di layar 4.5 inci untuk intubasi yang lebih mudah dan aman.', 'pdf' => 'brochure/TOO CARE VIDEO LARINGOSCOPE 4,5 (A4).pdf', 'img1' => 'brochure/TOO CARE VIDEO LARINGOSCOPE 4,5 (A4).jpg/TOO CARE VIDEO LARINGOSCOPE 4,5 (A4)_page-0001.jpg', 'img2' => 'brochure/TOO CARE VIDEO LARINGOSCOPE 4,5 (A4).jpg/TOO CARE VIDEO LARINGOSCOPE 4,5 (A4)_page-0002.jpg'],
                ['img' => 'comingsoon3.png', 'title' => 'TOO CARE SYRINGE PUMP', 'desc' => 'Presisi tinggi untuk pemberian obat (dosis kecil) secara terkontrol dan otomatis.', 'pdf' => 'brochure/TOO CARE SYRINGE  PUMP (A4).pdf', 'img1' => 'brochure/TOO-CARE-SYRINGE--PUMP-A4/TOO CARE SYRINGE  PUMP (A4)_page-0001.jpg', 'img2' => 'brochure/TOO-CARE-SYRINGE--PUMP-A4/TOO CARE SYRINGE  PUMP (A4)_page-0002.jpg'],
                ['img' => 'comingsoon4.png', 'title' => 'TOO CARE INFUSION PUMP', 'desc' => 'Kontrol aliran cairan infus (volume besar) secara otomatis, aman, dan konsisten.', 'pdf' => 'brochure/TOO CARE INFUSION PUMP (A4).pdf', 'img1' => 'brochure/TOO-CARE-INFUSION-PUMP-A4/TOO CARE INFUSION PUMP (A4)_page-0001.jpg', 'img2' => 'brochure/TOO-CARE-INFUSION-PUMP-A4/TOO CARE INFUSION PUMP (A4)_page-0002.jpg'],
                ['img' => 'comingsoon5.png', 'title' => 'TOO CARE ECG 12 CHANNEL', 'desc' => 'Rekam dan analisis aktivitas listrik jantung 12-lead untuk diagnosis komprehensif.', 'pdf' => 'brochure/TOO CARE ECG 12 CHANNEL (A4).pdf', 'img1' => 'brochure/TOO-CARE-ECG-12-CHANNEL-A4/TOO CARE ECG 12 CHANNEL (A4)_page-0001.jpg', 'img2' => 'brochure/TOO-CARE-ECG-12-CHANNEL-A4/TOO CARE ECG 12 CHANNEL (A4)_page-0002.jpg'],
                ['img' => 'comingsoon6.png', 'title' => 'TOO CARE TENSIMETER DIGITAL', 'desc' => 'Alat elektronik untuk mengukur tekanan darah yang praktis dan mudah digunakan.', 'pdf' => 'brochure/TOO CARE TENSIMETER DIGITAL (A4).pdf', 'img1' => 'brochure/TOO-CARE-TENSIMETER-DIGITAL-A4/TOO CARE TENSIMETER DIGITAL (A4)_page-0001.jpg', 'img2' => 'brochure/TOO-CARE-TENSIMETER-DIGITAL-A4/TOO CARE TENSIMETER DIGITAL (A4)_page-0002.jpg'],
                ['img' => 'comingsoon7.png', 'title' => 'TOO CARE SPIROMETER DIGITAL', 'desc' => 'Alat medis untuk mengukur fungsi paru-paru, khususnya volume dan kecepatan aliran udara.', 'pdf' => 'brochure/TOO CARE SPIROMETER DIGITAL (A4).pdf', 'img1' => 'brochure/TOO-CARE-SPIROMETER-DIGITAL-A4/TOO CARE SPIROMETER DIGITAL (A4)_page-0001.jpg', 'img2' => 'brochure/TOO-CARE-SPIROMETER-DIGITAL-A4/TOO CARE SPIROMETER DIGITAL (A4)_page-0002.jpg']
            ] as $product)
            <div class="group bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-500 transform hover:-translate-y-2 border-2 border-gray-100 cursor-pointer" data-aos="fade-up" data-aos-delay="200"
                 @click="pdfUrl='{{ asset($product['pdf']) }}'; pdfTitle='{{ $product['title'] }}'; pdfModal=true">
                <div class="relative aspect-square bg-gradient-to-br from-blue-100 to-blue-200 overflow-hidden">
                    <img src="{{ asset('image/' . $product['img']) }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 opacity-90">
                    <div class="absolute inset-0 bg-gradient-to-t from-blue-900/30 to-transparent"></div>
                    <div class="absolute top-3 right-3 bg-emerald-500 text-white px-3 py-1.5 rounded-full text-xs font-bold shadow-lg animate-pulse">NEW</div>
                </div>
                <div class="p-2.5 sm:p-5">
                    <h3 class="text-xs sm:text-lg font-bold text-gray-900 mb-1 sm:mb-2">{{ $product['title'] }}</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">{{ $product['desc'] }}</p>
                    <p class="text-emerald-600 text-xs font-bold mt-3 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Lihat Brochure
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- PDF Viewer Modal (mobile-friendly) -->
    <div x-show="pdfModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-2 sm:p-4 bg-black/60" @click.self="pdfModal=false"
         x-data="{ isMobile: window.innerWidth < 768 }" x-init="window.addEventListener('resize', () => isMobile = window.innerWidth < 768)">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl flex flex-col" style="height: 85vh; max-height: 90vh;" @click.stop>
            <!-- Header -->
            <div class="flex items-center justify-between p-3 sm:p-4 border-b bg-emerald-600 rounded-t-2xl text-white">
                <h3 class="font-bold text-sm sm:text-lg leading-tight pr-2" x-text="pdfTitle"></h3>
                <div class="flex items-center gap-2 flex-shrink-0">
                    <a :href="pdfUrl" download class="px-3 py-1.5 sm:px-4 sm:py-2 bg-white/20 hover:bg-white/30 rounded-lg text-xs sm:text-sm font-bold transition-colors flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        <span class="hidden sm:inline">Download</span>
                    </a>
                    <button @click="pdfModal=false" class="w-8 h-8 bg-white/20 hover:bg-white/30 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>
            <!-- Desktop: iframe PDF viewer -->
            <div x-show="!isMobile" class="p-2" style="flex: 1 1 0%; min-height: 0;">
                <iframe :src="pdfUrl" class="w-full h-full rounded-lg border" frameborder="0"></iframe>
            </div>
            <!-- Mobile: Download PDF button -->
            <div x-show="isMobile" class="flex-1 flex flex-col items-center justify-center p-8 text-center gap-6">
                <div class="w-20 h-20 bg-emerald-100 rounded-full flex items-center justify-center">
                    <svg class="w-10 h-10 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <p class="text-gray-500 text-sm">Brochure produk tersedia dalam format PDF</p>
                <a :href="pdfUrl" download class="w-full max-w-xs py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl text-center transition-colors flex items-center justify-center gap-2 shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Download Brochure
                </a>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes blob {
    0% { transform: translate(0px, 0px) scale(1); }
    33% { transform: translate(30px, -50px) scale(1.1); }
    66% { transform: translate(-20px, 20px) scale(0.9); }
    100% { transform: translate(0px, 0px) scale(1); }
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
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

.float-animation {
    animation: float 6s ease-in-out infinite;
}

.gradient-border {
    position: relative;
    background: white;
}

.gradient-border::before {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: 1.5rem;
    padding: 2px;
    background: linear-gradient(135deg, #10b981, #14b8a6, #06b6d4);
    -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
    -webkit-mask-composite: xor;
    mask-composite: exclude;
    opacity: 0;
    transition: opacity 0.3s;
}

.gradient-border:hover::before {
    opacity: 1;
}

.tag-badge {
    background: linear-gradient(135deg, #10b981 0%, #14b8a6 100%);
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
}
</style>

@endsection
