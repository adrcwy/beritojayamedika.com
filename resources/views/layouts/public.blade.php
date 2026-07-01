<!DOCTYPE html>
<html lang="id">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $defaultTitle = 'Toko Alkes Surabaya | Distributor Alkes - PT. Berito Jaya Medika';
        $defaultDescription = 'PT. Berito Jaya Medika adalah toko alkes dan distributor alat kesehatan di Surabaya yang melayani kebutuhan rumah sakit, klinik, laboratorium, instansi, dan pengiriman alkes ke seluruh Indonesia.';
        $defaultKeywords = 'alkes surabaya, toko alkes surabaya, toko alat kesehatan surabaya, distributor alkes, distributor alkes indonesia, distributor alat kesehatan, alat kesehatan surabaya, supplier alat medis, jual alkes, alat laboratorium surabaya, grosir alkes surabaya';
        $seoTitle = trim($__env->yieldContent('title')) ?: $defaultTitle;
        $seoDescription = trim($__env->yieldContent('meta_description')) ?: $defaultDescription;
        $seoKeywords = trim($__env->yieldContent('meta_keywords')) ?: $defaultKeywords;
        $seoCanonical = trim($__env->yieldContent('canonical')) ?: url()->current();
        $seoImage = trim($__env->yieldContent('og_image')) ?: asset('image/logo.png');
        $businessSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'LocalBusiness',
            'additionalType' => 'https://schema.org/MedicalBusiness',
            'name' => 'PT. Berito Jaya Medika',
            'alternateName' => ['PT. Berito Jaya Medika', 'BJM Alkes Surabaya'],
            'description' => 'Toko alkes dan distributor alat kesehatan di Surabaya untuk kebutuhan rumah sakit, klinik, laboratorium, instansi, dan pelanggan nasional.',
            'url' => url('/'),
            'logo' => asset('image/logo.png'),
            'image' => [asset('image/logo.png'), asset('image/product1.png'), asset('image/product2.png')],
            'email' => 'beritojayamedika@gmail.com',
            'telephone' => '+62315321477',
            'contactPoint' => [[
                '@type' => 'ContactPoint',
                'telephone' => '+6281336385959',
                'contactType' => 'sales',
                'areaServed' => 'ID',
                'availableLanguage' => ['id'],
            ]],
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'Jl. Achmad Jais No.34 Ruko Grand Achmad Jais Blok C-2, Peneleh, Genteng',
                'addressLocality' => 'Surabaya',
                'addressRegion' => 'Jawa Timur',
                'postalCode' => '60274',
                'addressCountry' => 'ID',
            ],
            'geo' => [
                '@type' => 'GeoCoordinates',
                'latitude' => -7.2551498,
                'longitude' => 112.7380559,
            ],
            'areaServed' => [
                ['@type' => 'City', 'name' => 'Surabaya'],
                ['@type' => 'AdministrativeArea', 'name' => 'Jawa Timur'],
                ['@type' => 'Country', 'name' => 'Indonesia'],
            ],
            'openingHoursSpecification' => [[
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                'opens' => '08:00',
                'closes' => '16:00',
            ]],
            'priceRange' => '$$',
        ];
        $websiteSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => 'PT. Berito Jaya Medika',
            'url' => url('/'),
            'inLanguage' => 'id-ID',
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => url('/products') . '?search={search_term_string}',
                'query-input' => 'required name=search_term_string',
            ],
        ];
    @endphp

    <!-- SEO -->
    <title>{{ $seoTitle }}</title>
    <meta name="description" content="{{ $seoDescription }}">
    <meta name="keywords" content="{{ $seoKeywords }}">
    <meta name="robots" content="index, follow, max-image-preview:large">
    <link rel="canonical" href="{{ $seoCanonical }}">

    <!-- LOCAL SEO -->
    <meta name="geo.region" content="ID-JI">
    <meta name="geo.placename" content="Surabaya">
    <meta name="geo.position" content="-7.2551498;112.7380559">
    <meta name="ICBM" content="-7.2551498,112.7380559">

    <!-- OPEN GRAPH -->
    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $seoDescription }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $seoCanonical }}">
    <meta property="og:image" content="{{ $seoImage }}">
    <meta property="og:locale" content="id_ID">
    <meta property="og:site_name" content="PT. Berito Jaya Medika">

    <!-- TWITTER CARDS -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoTitle }}">
    <meta name="twitter:description" content="{{ $seoDescription }}">
    <meta name="twitter:image" content="{{ $seoImage }}">

    <!-- HREFLANG -->
    <link rel="alternate" hreflang="id" href="{{ $seoCanonical }}">
    <link rel="alternate" hreflang="x-default" href="{{ $seoCanonical }}">

    <!-- JSON-LD STRUCTURED DATA -->
    <script type="application/ld+json">
    @json($businessSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
    </script>
    <script type="application/ld+json">
    @json($websiteSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
    </script>
    @stack('structured_data')

    <!-- FAVICON -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700;800&display=swap" rel="stylesheet">

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        html {
            scroll-behavior: smooth;
        }
        body {
            font-family: 'Manrope', sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }

        /* Page fade-in animation */
        @keyframes pageFadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .page-content {
            animation: pageFadeIn 0.5s ease-out;
        }
        
        /* Navbar Animation */
        .nav-link {
            position: relative;
            transition: all 0.3s ease;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 3px;
            bottom: -2px;
            left: 50%;
            background: linear-gradient(90deg, #dc2626, #ef4444);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        .nav-link.active::after {
            width: 100%;
        }
        
        /* Mobile menu animation */
        .mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }
        
        .mobile-menu.active {
            max-height: 500px;
        }
        
        /* Floating animation for social icons */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .social-icon {
            transition: all 0.3s ease;
        }
        
        .social-icon:hover {
            animation: float 1s ease-in-out infinite;
            color: #fbbf24;
        }
        
        /* Gradient border animation */
        @keyframes borderGlow {
            0%, 100% { border-color: rgba(239, 68, 68, 0.5); }
            50% { border-color: rgba(239, 68, 68, 1); }
        }
        
        .cta-button-animated {
            animation: borderGlow 2s ease-in-out infinite;
        }

        /* Floating Music Player Button */
        .floating-music-btn {
            position: fixed;
            z-index: 1000;
            width: 45px; /* Diperkecil */
            height: 45px; /* Diperkecil */
            border-radius: 50%;
            background: #28a745; /* Warna hijau saat diputar */
            color: white;
            border: none;
            font-size: 0; /* Hide fallback text until icon UI is initialized */
            cursor: grab;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            /* Muncul di ujung kiri bawah */
            bottom: 80px; /* Jarak dari bawah, lebih tinggi dari tombol scroll */
            left: 20px;
        }

        .floating-music-btn:active {
            cursor: grabbing;
        }

        .floating-music-btn:hover {
            background: #218838;
            transform: scale(1.1);
        }

        .floating-music-btn.paused {
            background: #6f42c1;
        }

        .floating-music-btn.paused:hover {
            background: #5a32a3;
        }

        .floating-music-btn i {
            font-size: 18px;
        }

        /* Scroll to Top Button */
        .scroll-to-top-btn {
            position: fixed;
            bottom: 20px;
            left: 20px;
            z-index: 40;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, #dc2626, #ef4444);
            color: white;
            border: none;
            font-size: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
        }

        .scroll-to-top-btn:hover {
            transform: scale(1.1);
        }
        

    </style>
    @stack('styles')
</head>
<body class="antialiased text-blue-900 bg-white overflow-x-hidden" x-data="{ 
    contactModalOpen: false, 
    feedbackModalOpen: false, 
    detailModalOpen: false, 
    marketplaceModalOpen: false, 
    selectedProduct: null, 
    articleModalOpen: false, 
    selectedArticle: null,
    mobileMenuOpen: false,
    scrolled: false
}" 
@scroll.window="scrolled = window.pageYOffset > 20">

    @php
        $desktopNavBase = 'nav-link inline-flex items-center whitespace-nowrap px-2 lg:px-3 xl:px-4 py-2 text-xs lg:text-sm rounded-lg';
        $desktopNavActive = 'active font-semibold text-blue-900 bg-blue-50';
        $desktopNavInactive = 'font-medium text-gray-600 hover:bg-blue-50 hover:text-blue-900';
        $mobileNavBase = 'flex items-center px-4 py-3 text-base rounded-lg transition-colors';
        $mobileNavActive = 'font-semibold text-blue-900 bg-blue-50';
        $mobileNavInactive = 'font-medium text-gray-600 hover:bg-blue-50 hover:text-blue-900';
    @endphp

    <!-- Enhanced Navbar with Blur Effect on Scroll -->
    <nav class="sticky top-0 z-50 transition-all duration-300" 
         :class="scrolled ? 'bg-white/95 backdrop-blur-md shadow-lg' : 'bg-white shadow-sm'">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20 transition-all duration-300">
                <!-- Logo with Animation -->
                <div class="min-w-0 flex-shrink-0 transform transition-transform duration-300 hover:scale-105">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3">
                        <div class="relative">
                            <img src="{{ asset('image/logo.png') }}" 
                                 alt="Logo PT. Berito Jaya Medika" 
                                 class="h-9 sm:h-10 w-auto">
                            <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-red-600 rounded-full opacity-0 group-hover:opacity-20 blur transition-opacity"></div>
                        </div>
                        <span class="font-extrabold text-base sm:text-lg lg:text-xl xl:text-2xl bg-gradient-to-r from-blue-900 to-blue-700 bg-clip-text text-transparent whitespace-nowrap">
                            PT. BERITO JAYA MEDIKA
                        </span>
                    </a>
                </div>
                
                <!-- Desktop Navigation -->
                <div class="hidden md:ml-4 md:flex md:space-x-1 xl:space-x-2">
                    <a href="{{ route('home') }}" 
                       class="{{ $desktopNavBase }} {{ request()->routeIs('home') ? $desktopNavActive : $desktopNavInactive }}">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Home
                    </a>
                    <a href="{{ route('about') }}" 
                       class="{{ $desktopNavBase }} {{ request()->routeIs('about') ? $desktopNavActive : $desktopNavInactive }}">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Tentang Kami
                    </a>
                    <a href="{{ route('toocare') }}" 
                       class="{{ $desktopNavBase }} {{ request()->routeIs('toocare') ? $desktopNavActive : $desktopNavInactive }}">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                        Too Care
                    </a>
                    <a href="{{ route('products') }}" 
                       class="{{ $desktopNavBase }} {{ request()->routeIs('products') ? $desktopNavActive : $desktopNavInactive }}">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        Produk
                    </a>
                    <a href="{{ route('catalog-book') }}" 
                       class="{{ $desktopNavBase }} {{ request()->routeIs('catalog-book') ? $desktopNavActive : $desktopNavInactive }}">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5S19.832 5.477 21 6.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253"/>
                        </svg>
                        Catalog Book
                    </a>
                    <a href="{{ route('articles') }}" 
                       class="{{ $desktopNavBase }} {{ request()->routeIs('articles*') ? $desktopNavActive : $desktopNavInactive }}">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                        Artikel
                    </a>                
                </div>

                <!-- CTA Button Desktop -->
                <div class="hidden md:ml-4 md:flex md:items-center">
                    <a href="#" 
                       @click.prevent="contactModalOpen = true" 
                       class="group relative inline-flex items-center bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold py-2.5 px-4 xl:px-6 rounded-xl text-xs lg:text-sm transition-all duration-300 transform hover:scale-105 hover:shadow-xl cursor-pointer overflow-hidden">
                        <span class="absolute inset-0 w-full h-full bg-white opacity-0 group-hover:opacity-20 transition-opacity"></span>
                        <svg class="w-4 h-4 mr-2 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span class="relative z-10">Hubungi Kami</span>
                    </a>
                </div>
                
                <!-- Mobile menu button -->
                <div class="flex items-center md:hidden">
                    <button 
                        @click="mobileMenuOpen = !mobileMenuOpen"
                        type="button" 
                        class="inline-flex items-center justify-center p-2 rounded-lg text-gray-600 hover:text-blue-900 hover:bg-blue-50 transition-colors">
                        <span class="sr-only">Open menu</span>
                        <svg x-show="!mobileMenuOpen" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <svg x-show="mobileMenuOpen" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile Navigation -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 transform -translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform -translate-y-2"
             class="md:hidden border-t border-gray-100 bg-white"
             style="display: none;">
            <div class="px-4 pt-2 pb-4 space-y-1">
                <a href="{{ route('home') }}" class="{{ $mobileNavBase }} {{ request()->routeIs('home') ? $mobileNavActive : $mobileNavInactive }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Home
                </a>
                <a href="{{ route('about') }}" class="{{ $mobileNavBase }} {{ request()->routeIs('about') ? $mobileNavActive : $mobileNavInactive }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Tentang Kami
                </a>
                <a href="{{ route('toocare') }}" class="{{ $mobileNavBase }} {{ request()->routeIs('toocare') ? $mobileNavActive : $mobileNavInactive }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    Too Care
                </a>
                <a href="{{ route('products') }}" class="{{ $mobileNavBase }} {{ request()->routeIs('products') ? $mobileNavActive : $mobileNavInactive }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    Produk
                </a>
                <a href="{{ route('catalog-book') }}" class="{{ $mobileNavBase }} {{ request()->routeIs('catalog-book') ? $mobileNavActive : $mobileNavInactive }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5S19.832 5.477 21 6.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253"/>
                    </svg>
                    Catalog Book
                </a>
                <a href="{{ route('articles') }}" class="{{ $mobileNavBase }} {{ request()->routeIs('articles*') ? $mobileNavActive : $mobileNavInactive }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                    Artikel
                </a>
                <button 
                    @click="contactModalOpen = true; mobileMenuOpen = false"
                    class="w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-red-600 to-red-700 text-white font-bold rounded-lg shadow-lg mt-4">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Hubungi Kami
                </button>
            </div>
        </div>
    </nav>

    <main class="page-content">
        @yield('content')
    </main>

    <!-- Enhanced Footer -->
    <footer class="relative bg-gradient-to-br from-blue-900 via-blue-800 to-blue-900 text-gray-300 overflow-hidden">
        <!-- Decorative Background Elements -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-96 h-96 bg-yellow-400 rounded-full filter blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-red-500 rounded-full filter blur-3xl"></div>
        </div>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                <!-- Company Info -->
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <img src="{{ asset('image/logo.png') }}" 
                             alt="Logo" 
                             class="h-10 w-auto">
                    </div>
                    <h3 class="font-extrabold text-2xl mb-4 bg-gradient-to-r from-white to-yellow-400 bg-clip-text text-transparent">
                        PT. BERITO JAYA MEDIKA
                    </h3>
                    <p class="text-sm text-gray-400 leading-relaxed mb-6">
                        Distributor terpercaya alat kesehatan dan teknologi medis di Indonesia sejak 1998.
                    </p>
                    

                </div>
                
                <!-- Navigation Links -->
                <div>
                    <h4 class="font-bold text-white mb-6 text-lg flex items-center">
                        <svg class="w-5 h-5 mr-2 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Navigasi
                    </h4>
                    <ul class="space-y-3 text-sm">
                        <li>
                            <a href="{{ route('about') }}" class="group flex items-center hover:text-yellow-400 transition-colors">
                                <svg class="w-4 h-4 mr-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                                Tentang Kami
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('toocare') }}" class="group flex items-center hover:text-yellow-400 transition-colors">
                                <svg class="w-4 h-4 mr-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                                Too Care
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('products') }}" class="group flex items-center hover:text-yellow-400 transition-colors">
                                <svg class="w-4 h-4 mr-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                                Produk
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('catalog-book') }}" class="group flex items-center hover:text-yellow-400 transition-colors">
                                <svg class="w-4 h-4 mr-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                                Catalog Book
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('articles') }}" class="group flex items-center hover:text-yellow-400 transition-colors">
                                <svg class="w-4 h-4 mr-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                                Artikel
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 class="font-bold text-white mb-6 text-lg flex items-center">
                        <svg class="w-5 h-5 mr-2 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Hubungi Kami
                    </h4>
                    <ul class="space-y-4 text-sm">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-3 text-yellow-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <a href="mailto:beritojayamedika@gmail.com" class="hover:text-yellow-400 transition-colors">
                                beritojayamedika@gmail.com
                            </a>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-3 text-yellow-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <a href="https://maps.app.goo.gl/MjWnMTPjVtnGPcDx9" class="hover:text-yellow-400 transition-colors">
                            Jl. Achmad Jais No.34  Ruko Grand Achmad Jais Blok C-2, Peneleh, Kec. Genteng, Surabaya,
                            Jawa Timur 60274

    </a>
                        </li>
                    </ul>
                    
                    <!-- Quick Contact Button -->
                    <button 
                        @click="contactModalOpen = true"
                        class="mt-6 w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold rounded-2xl transition-all duration-300 transform hover:scale-105 shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        Hubungi Sekarang
                    </button>
                    <button
                        @click="feedbackModalOpen = true"
                        class="mt-4 w-full flex items-center justify-center gap-3 px-6 py-3
                            bg-emerald-50/100 backdrop-blur-sm
                            text-emerald-600 font-semibold rounded-2xl
                            shadow-md hover:shadow-lg hover:bg-emerald-100
                            transition-all duration-300">
                        
                        <i class="fa-regular fa-envelope text-lg"></i>
                        <span>Kritik & Saran</span>

                        <!-- panah kanan -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </button>

                </div>
            </div>


            
            <!-- Bottom Bar -->
            <div class="mt-12 pt-8 border-t border-blue-700">
                <div class="flex flex-col md:flex-row justify-between items-center text-sm hover:text-yellow-400 transition-colors">

                    </p>
                    <div class="flex space-x-6">
                        <p class="hover:text-yellow-400 transition-colors">Privacy Policy</p>
                        <p class="hover:text-yellow-400 transition-colors">Terms of Service</p>
                        <p class="hover:text-yellow-400 transition-colors">Sitemap</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Scroll to Top Button -->
        <button 
            @click="window.scrollTo({top: 0, behavior: 'smooth'})"
            id="scrollToTopBtn"
            class="scroll-to-top-btn"
            style="display: none;">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
            </svg>
        </button>
    </footer>

    <!-- Enhanced Feeback Modal Modal -->
    <div 
        x-show="feedbackModalOpen" 
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center p-4" 
        style="display: none;"
        @keydown.escape.window="feedbackModalOpen = false">
        
        <!-- Backdrop -->
        <div 
            x-show="feedbackModalOpen" 
            @click="feedbackModalOpen = false" 
            class="fixed inset-0 bg-blue-900/70 backdrop-blur-sm">
        </div>

        <!-- Modal Content -->
        <div 
            x-show="feedbackModalOpen"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90"
            class="relative z-10 w-full max-w-lg bg-white rounded-3xl shadow-2xl overflow-hidden">
            
            <!-- Header with Gradient -->
            <div class="bg-gradient-to-r from-blue-900 to-blue-800 px-8 py-6 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-40 h-40 bg-yellow-400 rounded-full opacity-20 blur-2xl"></div>
                <div class="relative flex justify-between items-center">
                    <div>
                        <h3 class="text-3xl font-extrabold text-white">Kritik & Saran</h3>
                        <p class="text-blue-200 text-sm mt-1">Kami siap membantu Anda</p>
                    </div>
                    <button 
                        @click="feedbackModalOpen = false" 
                        class="text-white hover:bg-white/20 rounded-lg p-2 transition-all duration-200">
                        <span class="sr-only">Tutup</span>
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            
            <!-- Contact Options -->
            <div class="p-4 space-y-4">
                        <div class="p-8">
            <form id="feedbackForm">
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Pengirim (Opsional)</label>
                    <input type="text" name="sender_name"
                           class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                           placeholder="Nama Anda...">
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kritik & Saran *</label>
                    <textarea name="message" required rows="4"
                              class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                              placeholder="Tulis masukan Anda di sini..."></textarea>
                </div>

                <button type="submit"
                    class="group flex items-center w-full px-6 py-4 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white rounded-2xl shadow-lg transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                    <div class="flex-1 text-left">
                        <h4 class="font-bold text-lg">Kirim Kritik & Saran</h4>
                    </div>
                    <svg class="w-6 h-6 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </button>
            </form>
             <p id="feedbackSuccess" class="hidden text-green-600 font-semibold mt-4 text-center">
                    Terima kasih, masukan Anda berhasil dikirim!
                </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Contact Modal -->
    <div 
        x-show="contactModalOpen" 
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center p-4" 
        style="display: none;"
        @keydown.escape.window="contactModalOpen = false">
        
        <!-- Backdrop -->
        <div 
            x-show="contactModalOpen" 
            @click="contactModalOpen = false" 
            class="fixed inset-0 bg-blue-900/70 backdrop-blur-sm">
        </div>

        <!-- Modal Content -->
        <div 
            x-show="contactModalOpen"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90"
            class="relative z-10 w-full max-w-lg bg-white rounded-3xl shadow-2xl overflow-hidden">
            
            <!-- Header with Gradient -->
            <div class="bg-gradient-to-r from-blue-900 to-blue-800 px-8 py-6 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-40 h-40 bg-yellow-400 rounded-full opacity-20 blur-2xl"></div>
                <div class="relative flex justify-between items-center">
                    <div>
                        <h3 class="text-3xl font-extrabold text-white">Hubungi Kami</h3>
                        <p class="text-blue-200 text-sm mt-1">Kami siap membantu Anda</p>
                    </div>
                    <button 
                        @click="contactModalOpen = false" 
                        class="text-white hover:bg-white/20 rounded-lg p-2 transition-all duration-200">
                        <span class="sr-only">Tutup</span>
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            
            <!-- Contact Options -->
            <div class="p-8 space-y-4">
                <!-- WhatsApp -->
                <a 
                    href="https://wa.me/6281336385959" 
                    target="_blank" 
                    class="group flex items-center w-full px-6 py-4 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white rounded-2xl shadow-lg transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-4">
                        <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91C2.13 13.66 2.59 15.36 3.45 16.86L2.06 21.94L7.31 20.55L7.42 20.19C8.75 21.33 10.35 21.79 12.04 21.79C17.5 21.79 21.95 17.34 21.95 11.88C21.95 6.42 17.5 2 12.04 2ZM12.04 20.13C10.52 20.13 9.04 19.68 7.78 18.89L7.42 18.67L4.03 19.53L4.9 16.22L4.67 15.87C3.81 14.56 3.38 13.06 3.38 11.47C3.38 7.35 7.29 3.64 12.04 3.64C16.79 3.64 20.7 7.35 20.7 11.81C20.7 16.27 16.79 20.13 12.04 20.13Z"/>
                        </svg>
                    </div>
                    <div class="flex-1 text-left">
                        <h4 class="font-bold text-lg">Chat via WhatsApp</h4>
                        <p class="text-sm text-green-100">Respons cepat & langsung</p>
                    </div>
                    <svg class="w-6 h-6 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>

                <!-- Phone -->
                <a 
                    href="tel:(031)5321477" 
                    class="group flex items-center w-full px-6 py-4 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white rounded-2xl shadow-lg transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-4">
                        <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <div class="flex-1 text-left">
                        <h4 class="font-bold text-lg">Telepon Langsung</h4>
                        <p class="text-sm text-blue-100">Senin - Jumat, 08:00 - 16:00</p>
                        <p class="text-sm text-blue-100">Sabtu, 08:00 - 14:00</p>
                    </div>
                    <svg class="w-6 h-6 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>

                <!-- Email -->
                <a 
                    href="mailto:beritojayamedika@gmail.com" 
                    class="group flex items-center w-full px-6 py-4 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white rounded-2xl shadow-lg transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-4">
                        <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="flex-1 text-left">
                        <h4 class="font-bold text-lg">Kirim Email</h4>
                        <p class="text-sm text-red-100">Untuk pertanyaan detail</p>
                    </div>
                    <svg class="w-6 h-6 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
            </div>

            <!-- Footer Info -->
            <div class="bg-gray-50 px-8 py-6 border-t border-gray-200">
                <div class="flex items-start space-x-3">
                    <svg class="w-6 h-6 text-blue-900 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="text-sm text-gray-600">
                        <p class="font-semibold text-blue-900 mb-1">Jam Operasional</p>
                        <p>Senin - Jumat: 08:00 - 16:00 WIB</p>
                        <p>Sabtu: 08:00 - 14:00 WIB</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Music Button -->
    <button id="floatingMusicBtn" class="floating-music-btn paused" type="button" aria-label="Putar musik">
        <i class="fas fa-music" aria-hidden="true"></i>
        <span class="sr-only">Putar musik</span>

    </button>

    <!-- Audio Element -->
    <audio id="myAudio" preload="auto" loop playsinline>
        <source src="{{ asset('music/lagu.mp3') }}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>

    <!-- Custom JS for Floating Music Button (Fixed: persistence, loop, autoplay retry) -->
    <script>
        const musicBtn = document.getElementById('floatingMusicBtn');
        const audio = document.getElementById('myAudio');
        const scrollToTopBtn = document.getElementById('scrollToTopBtn');
        const audioPositionKey = 'bjm_audio_position';
        const audioPlayingKey = 'bjm_audio_playing';

        let isPlaying = false;
        let isDragging = false;
        let restoredAudioPosition = false;
        let audioRestorePromise = null;

        // Enable looping
        audio.loop = true;
        audio.volume = 0.45;

        function getSavedAudioPosition() {
            const savedTime = localStorage.getItem(audioPositionKey);
            const parsedTime = Number.parseFloat(savedTime || '0');

            return Number.isFinite(parsedTime) && parsedTime > 0 ? parsedTime : 0;
        }

        function saveAudioPosition() {
            if (!audio) return;

            if (Number.isFinite(audio.currentTime) && audio.currentTime > 0) {
                localStorage.setItem(audioPositionKey, audio.currentTime.toString());
            }
        }

        function restoreAudioPosition() {
            if (restoredAudioPosition || !audio) {
                return Promise.resolve();
            }

            if (audioRestorePromise) {
                return audioRestorePromise;
            }

            const savedTime = getSavedAudioPosition();
            if (savedTime <= 0) {
                restoredAudioPosition = true;
                return Promise.resolve();
            }

            audioRestorePromise = new Promise((resolve) => {
                const applySavedTime = () => {
                    const duration = Number.isFinite(audio.duration) ? audio.duration : 0;
                    const safeTime = duration > 0 ? Math.min(getSavedAudioPosition(), Math.max(duration - 0.25, 0)) : getSavedAudioPosition();
                    audio.currentTime = safeTime;
                    restoredAudioPosition = true;
                    resolve();
                };

                if (audio.readyState >= 1) {
                    applySavedTime();
                } else {
                    audio.addEventListener('loadedmetadata', applySavedTime, { once: true });
                    audio.load();
                }
            });

            return audioRestorePromise;
        }

        // Draggable functionality with isDragging detection
        let pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
        let dragStartX = 0, dragStartY = 0;
        let resumeListenersInstalled = false;

        function dragMouseDown(e) {
            e.preventDefault();
            const clientX = e.clientX || (e.touches && e.touches[0].clientX);
            const clientY = e.clientY || (e.touches && e.touches[0].clientY);
            pos3 = clientX;
            pos4 = clientY;
            dragStartX = clientX;
            dragStartY = clientY;
            isDragging = false;
            document.onmouseup = closeDragElement;
            document.onmousemove = elementDrag;
            document.ontouchend = closeDragElement;
            document.ontouchmove = elementDragTouch;
        }

        function elementDrag(e) {
            e.preventDefault();
            pos1 = pos3 - e.clientX;
            pos2 = pos4 - e.clientY;
            pos3 = e.clientX;
            pos4 = e.clientY;
            if (Math.abs(e.clientX - dragStartX) > 5 || Math.abs(e.clientY - dragStartY) > 5) isDragging = true;
            moveBtn();
        }

        function elementDragTouch(e) {
            e.preventDefault();
            const t = e.touches[0];
            pos1 = pos3 - t.clientX;
            pos2 = pos4 - t.clientY;
            pos3 = t.clientX;
            pos4 = t.clientY;
            if (Math.abs(t.clientX - dragStartX) > 5 || Math.abs(t.clientY - dragStartY) > 5) isDragging = true;
            moveBtn();
        }

        function moveBtn() {
            const top = musicBtn.offsetTop - pos2;
            const left = musicBtn.offsetLeft - pos1;
            const maxTop = window.innerHeight - musicBtn.offsetHeight;
            const maxLeft = window.innerWidth - musicBtn.offsetWidth;
            musicBtn.style.top = Math.max(0, Math.min(top, maxTop)) + 'px';
            musicBtn.style.left = Math.max(0, Math.min(left, maxLeft)) + 'px';
        }

        function closeDragElement() {
            document.onmouseup = null;
            document.onmousemove = null;
            document.ontouchend = null;
            document.ontouchmove = null;
        }

        musicBtn.onmousedown = dragMouseDown;
        musicBtn.ontouchstart = dragMouseDown;

        function setPlayingUI() {
            musicBtn.innerHTML = '<i class="fas fa-pause" aria-hidden="true"></i><span class="sr-only">Jeda musik</span>';
            musicBtn.setAttribute('aria-label', 'Jeda musik');
            musicBtn.classList.remove('paused');
            isPlaying = true;
            localStorage.setItem(audioPlayingKey, '1');
        }

        function setPausedUI(remember = true) {
            musicBtn.innerHTML = '<i class="fas fa-music" aria-hidden="true"></i><span class="sr-only">Putar musik</span>';
            musicBtn.setAttribute('aria-label', 'Putar musik');
            musicBtn.classList.add('paused');
            isPlaying = false;
            if (remember) {
                localStorage.setItem(audioPlayingKey, '0');
            }
        }

        function installResumeListeners() {
            if (resumeListenersInstalled) return;
            resumeListenersInstalled = true;

            const resumeOnInteraction = (event) => {
                if (musicBtn.contains(event.target)) {
                    return;
                }

                if (localStorage.getItem(audioPlayingKey) !== '0') {
                    tryPlayAudio();
                }
                ['pointerdown', 'click', 'touchstart', 'keydown', 'wheel', 'scroll'].forEach((eventName) => {
                    document.removeEventListener(eventName, resumeOnInteraction);
                });
                resumeListenersInstalled = false;
            };

            ['pointerdown', 'click', 'touchstart', 'keydown', 'wheel', 'scroll'].forEach((eventName) => {
                document.addEventListener(eventName, resumeOnInteraction, { once: true, passive: true });
            });
        }

        async function tryPlayAudio() {
            audio.muted = false;
            await restoreAudioPosition();

            return audio.play()
                .then(setPlayingUI)
                .catch(() => {
                    setPausedUI(false);
                    installResumeListeners();
                });
        }

        // Toggle play/pause (only if not dragging)
        musicBtn.addEventListener('click', () => {
            if (isDragging) return;
            if (audio.paused) {
                localStorage.setItem(audioPlayingKey, '1');
                tryPlayAudio();
            } else {
                saveAudioPosition();
                audio.pause();
                setPausedUI(true);
            }
        });

        // Save position every 1 second
        setInterval(() => {
            if (audio && audio.currentTime > 0) {
                localStorage.setItem(audioPositionKey, audio.currentTime.toString());
            }
        }, 500);

        // Save on page unload too
        window.addEventListener('beforeunload', saveAudioPosition);
        window.addEventListener('pagehide', saveAudioPosition);
        audio.addEventListener('timeupdate', saveAudioPosition);
        audio.addEventListener('pause', saveAudioPosition);
        audio.addEventListener('loadedmetadata', restoreAudioPosition, { once: true });

        // Restore + auto-play as early as possible.
        function bootAudio() {
            const wasPlaying = localStorage.getItem(audioPlayingKey);

            if (wasPlaying !== '0') {
                localStorage.setItem(audioPlayingKey, '1');
                tryPlayAudio();
            } else {
                setPausedUI();
            }
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', bootAudio, { once: true });
        } else {
            bootAudio();
        }

        // Scroll to Top Button
        window.addEventListener('scroll', () => {
            if (!scrollToTopBtn) return;
            if (window.pageYOffset > 20) {
                scrollToTopBtn.style.display = 'flex';
            } else {
                scrollToTopBtn.style.display = 'none';
            }
        });

        if (scrollToTopBtn) {
            scrollToTopBtn.addEventListener('click', () => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }

        // Kritik & Saran

 document.addEventListener("DOMContentLoaded", () => {
    const feedbackForm = document.getElementById("feedbackForm");
    const feedbackSuccess = document.getElementById("feedbackSuccess");

    feedbackForm.addEventListener("submit", async function (e) {
        e.preventDefault();

        const formData = new FormData(feedbackForm);

        // Optional: Add loading state
        const submitButton = feedbackForm.querySelector('button[type="submit"]');
        const originalText = submitButton.innerHTML;
        submitButton.innerHTML = 'Mengirim...';
        submitButton.disabled = true;

        try {
            const response = await fetch("{{ route('feedback.store') }}", { // Pastikan route ini benar
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}", // Pastikan ini digenerate oleh Laravel
                },
                body: formData,
            });

            if (response.ok) {
                const data = await response.json(); // Jika server mengembalikan JSON
                // Tampilkan pesan sukses
                feedbackForm.classList.add("hidden");
                feedbackSuccess.classList.remove("hidden");

                // Tutup modal setelah 1.8 detik
                setTimeout(() => {
                    // Menggunakan Alpine.js untuk menutup modal
                    if (typeof Alpine !== 'undefined' && Alpine.store('modals')) {
                         Alpine.store('modals').feedbackModalOpen = false;
                    } else {
                        // Jika tidak menggunakan store, asumsikan variabel global
                        feedbackModalOpen = false;
                    }
                }, 1800);
            } else {
                throw new Error('Gagal mengirim data');
            }
        } catch (error) {
            alert("Terjadi kesalahan saat mengirim. Silakan coba lagi.");
            console.error("Error submitting feedback:", error);
        } finally {
            // Kembalikan tombol ke keadaan semula
            submitButton.innerHTML = originalText;
            submitButton.disabled = false;
        }
    });
});

    </script>
    @stack('scripts')

</body>
</html>
