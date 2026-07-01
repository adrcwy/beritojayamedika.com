@extends('layouts.public')

@section('title', 'Produk Alkes Surabaya | Katalog Alat Kesehatan - PT. Berito Jaya Medika')
@section('meta_description', 'Lihat katalog produk alat kesehatan PT. Berito Jaya Medika: alat medis, alat laboratorium, instrumen bedah, habis pakai medis, dan produk alkes INAPROC dari distributor alkes Surabaya.')
@section('meta_keywords', 'produk alkes surabaya, katalog alat kesehatan, jual alat kesehatan surabaya, alat medis surabaya, alat laboratorium surabaya, distributor alkes, katalog inaproc alkes')
@section('canonical', route('products'))

@push('structured_data')
@php
    $productsPageSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'CollectionPage',
        'name' => 'Katalog Produk Alat Kesehatan PT. Berito Jaya Medika',
        'description' => 'Katalog alat kesehatan dan alat medis dari distributor alkes Surabaya.',
        'url' => route('products'),
        'breadcrumb' => [
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                [
                    '@type' => 'ListItem',
                    'position' => 1,
                    'name' => 'Beranda',
                    'item' => route('home'),
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 2,
                    'name' => 'Produk Alkes',
                    'item' => route('products'),
                ],
            ],
        ],
    ];
@endphp
<script type="application/ld+json">
@json($productsPageSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
</script>
@endpush

@section('content')
@php
    $selectedCategory = request('category', 'all');
    $selectedInaproc = request('inaproc', 'all');
    $fallbackImage = asset('image/logo.png');

    $productImage = function (?string $image) use ($fallbackImage) {
        return \App\Support\MediaPath::data($image, $fallbackImage);
    };
@endphp

<div
    x-data="{
        detailOpen: false,
        selectedProduct: null,
        fallbackImage: '{{ $fallbackImage }}',
        openProduct(product) {
            this.selectedProduct = product;
            this.detailOpen = true;
            document.body.classList.add('overflow-hidden');
        },
        closeProduct() {
            this.detailOpen = false;
            document.body.classList.remove('overflow-hidden');
        }
    }"
    @keydown.escape.window="closeProduct()"
>
<div id="products-page-content" data-products-region>
<section class="relative bg-gradient-to-br from-blue-50 via-white to-blue-50 overflow-hidden">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 lg:py-20">
        <div class="max-w-4xl mx-auto text-center">
            <span class="inline-flex items-center justify-center px-4 py-2 rounded-full bg-yellow-400 text-blue-900 text-xs sm:text-sm font-bold shadow-sm">
                Katalog Produk Medis
            </span>

            <h1 class="mt-5 text-3xl sm:text-5xl lg:text-6xl font-extrabold text-blue-900 leading-tight">
                Produk Berkualitas untuk Kebutuhan Medis
            </h1>

            <p class="mt-4 text-base sm:text-lg text-gray-600 leading-relaxed">
                Temukan alat kesehatan dan kebutuhan medis dari brand terpercaya.
            </p>
        </div>

        <form action="{{ route('products') }}" method="GET" data-products-filter class="mt-8 max-w-5xl mx-auto bg-white border border-blue-100 rounded-2xl shadow-xl p-4 sm:p-6">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-3 sm:gap-4">
                <div class="md:col-span-6">
                    <label for="search" class="sr-only">Cari produk</label>
                    <input
                        id="search"
                        name="search"
                        type="search"
                        value="{{ request('search') }}"
                        placeholder="Cari produk..."
                        class="w-full rounded-xl border-gray-200 py-3 px-4 text-gray-800 focus:border-blue-500 focus:ring-blue-500"
                    >
                </div>

                <div class="md:col-span-3">
                    <label for="category" class="sr-only">Brand</label>
                    <select id="category" name="category" class="w-full rounded-xl border-gray-200 py-3 px-4 text-gray-700 focus:border-blue-500 focus:ring-blue-500">
                        <option value="all">Semua Brand</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category['id'] }}" @selected((string) $selectedCategory === (string) $category['id'])>
                                {{ $category['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="md:col-span-3">
                    <label for="inaproc" class="sr-only">Status INAPROC</label>
                    <select id="inaproc" name="inaproc" class="w-full rounded-xl border-gray-200 py-3 px-4 text-gray-700 focus:border-blue-500 focus:ring-blue-500">
                        <option value="all" @selected($selectedInaproc === 'all')>Semua Status</option>
                        <option value="registered" @selected($selectedInaproc === 'registered')>Terdaftar INAPROC</option>
                        <option value="unregistered" @selected($selectedInaproc === 'unregistered')>Belum Terdaftar</option>
                    </select>
                </div>
            </div>

            <div class="mt-4 flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between">
                <p class="text-sm text-gray-500">
                    Menampilkan {{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }} dari {{ $products->total() }} produk
                </p>

                <div class="flex gap-2">
                    <a href="{{ route('products') }}" class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-bold text-gray-600 hover:bg-gray-50">
                        Reset
                    </a>
                    <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-blue-700 px-5 py-2.5 text-sm font-bold text-white hover:bg-blue-800">
                        Terapkan
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>

<section class="bg-gradient-to-b from-white to-gray-50 py-10 sm:py-14 lg:py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        @if ($products->count() > 0)
            <div class="grid grid-cols-1 min-[430px]:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 sm:gap-5 lg:gap-6">
                @foreach ($products as $product)
                    @php
                        $imageData = $productImage($product->image);
                        $imageUrl = $imageData['url'];
                        $productPayload = [
                            'name' => $product->name ?: 'Produk Tanpa Nama',
                            'description' => $product->description ?: '',
                            'description_is_truncated' => $product->description_is_truncated ?? false,
                            'image_url' => $imageUrl,
                            'image_available' => $imageData['available'],
                            'category_name' => $product->category_name ?: '-',
                            'catalog_link' => $product->catalog_link ?: '',
                        ];
                    @endphp
                    <article
                        class="group bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 cursor-pointer"
                        role="button"
                        tabindex="0"
                        @click="openProduct(@js($productPayload))"
                        @keydown.enter.prevent="openProduct(@js($productPayload))"
                    >
                        <div class="relative aspect-[4/3] bg-gray-50" data-product-image-wrap>
                            @if ($imageData['available'])
                                <img
                                    src="{{ $imageUrl }}"
                                    alt="{{ $product->name }}"
                                    loading="lazy"
                                    class="h-full w-full bg-white object-contain p-4"
                                    onerror="this.classList.add('hidden'); this.closest('[data-product-image-wrap]').querySelector('[data-product-image-placeholder]').classList.remove('hidden');"
                                    data-product-image
                                >
                            @endif
                            <div class="{{ $imageData['available'] ? 'hidden' : '' }} flex h-full w-full flex-col items-center justify-center gap-3 bg-blue-50/60 p-6 text-center" data-product-image-placeholder>
                                <img src="{{ $fallbackImage }}" alt="" class="h-14 w-auto opacity-75">
                                <div>
                                    <p class="text-sm font-extrabold text-blue-900">Gambar sedang disinkronkan</p>
                                    <p class="mt-1 text-xs font-medium text-blue-700">Akan diperbaiki lewat repair INAPROC</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 sm:p-5">
                            <h2 class="min-h-[48px] text-base sm:text-lg font-extrabold text-gray-900 leading-snug line-clamp-2 group-hover:text-blue-700">
                                {{ $product->name ?: 'Produk Tanpa Nama' }}
                            </h2>

                            <p class="mt-2 text-xs font-semibold text-gray-500">
                                {{ $product->category_name ?: '-' }}
                            </p>

                            @if ($product->catalog_link)
                                <div class="mt-3 inline-flex items-center gap-1.5 rounded-full border border-green-200 bg-green-50 px-3 py-1.5 text-[11px] sm:text-xs font-bold text-green-700">
                                    <span class="h-2 w-2 rounded-full bg-green-600"></span>
                                    Terdaftar INAPROC
                                </div>
                            @endif

                            @if ($product->description)
                                <p class="mt-4 text-sm text-gray-600 line-clamp-3 leading-relaxed">
                                    {{ $product->description }}
                                </p>
                            @endif

                            <div class="mt-5 flex items-center justify-between gap-3">
                                @if ($product->catalog_link)
                                    <a href="{{ $product->catalog_link }}" target="_blank" rel="noopener" @click.stop class="text-sm font-bold text-blue-700 hover:text-blue-900">
                                        Lihat INAPROC
                                    </a>
                                @else
                                    <button type="button" @click.stop="contactModalOpen = true" class="text-sm font-bold text-blue-700 hover:text-blue-900">
                                        Tanya Produk
                                    </button>
                                @endif

                                <button type="button" @click.stop="openProduct(@js($productPayload))" class="inline-flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-700 hover:bg-blue-100" aria-label="Lihat detail produk">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $products->onEachSide(1)->links('vendor.pagination.berito') }}
            </div>
        @else
            <div class="max-w-2xl mx-auto text-center rounded-2xl border border-blue-100 bg-white p-8 sm:p-10 shadow-sm">
                <div class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-2xl bg-blue-50 text-blue-700">
                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293L6.293 13.293A1 1 0 005.586 13H4" />
                    </svg>
                </div>
                <h2 class="text-2xl font-extrabold text-blue-900">Produk belum tersedia</h2>
                <p class="mt-3 text-gray-600">Coba ubah filter atau kata kunci pencarian.</p>
            </div>
        @endif
    </div>
</section>
</div>

<div
    x-show="detailOpen"
    x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-5"
    style="display: none;"
>
    <div class="absolute inset-0 bg-blue-950/65 backdrop-blur-sm" @click="closeProduct()"></div>

    <section
        x-show="detailOpen"
        x-transition
        class="relative z-10 w-full max-w-5xl max-h-[92vh] overflow-hidden rounded-2xl bg-white shadow-2xl"
    >
        <button
            type="button"
            @click="closeProduct()"
            class="absolute right-3 top-3 z-20 inline-flex h-11 w-11 items-center justify-center rounded-full bg-white/95 text-gray-600 shadow-lg hover:text-red-600"
            aria-label="Tutup detail produk"
        >
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <template x-if="selectedProduct">
            <div class="grid max-h-[92vh] grid-cols-1 overflow-y-auto lg:grid-cols-2">
                <div class="bg-gray-50 p-5 sm:p-8 lg:p-10">
                    <div class="rounded-2xl border border-gray-100 bg-white p-4 shadow-sm">
                        <template x-if="selectedProduct.image_available">
                            <img
                                :src="selectedProduct.image_url || fallbackImage"
                                :alt="selectedProduct.name"
                                class="h-64 w-full object-contain sm:h-80 lg:h-[420px]"
                                x-on:error="selectedProduct.image_available = false"
                            >
                        </template>
                        <template x-if="!selectedProduct.image_available">
                            <div class="flex h-64 w-full flex-col items-center justify-center gap-3 rounded-xl bg-blue-50/70 p-6 text-center sm:h-80 lg:h-[420px]">
                                <img :src="fallbackImage" alt="" class="h-16 w-auto opacity-75">
                                <div>
                                    <p class="text-base font-extrabold text-blue-900">Gambar sedang disinkronkan</p>
                                    <p class="mt-1 text-sm font-medium text-blue-700">Jalankan repair gambar untuk mengunduh ulang dari INAPROC.</p>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <div class="flex flex-col p-5 sm:p-8 lg:p-10">
                    <span class="inline-flex w-fit items-center rounded-full bg-blue-50 px-3 py-1 text-xs font-bold text-blue-700" x-text="selectedProduct.category_name"></span>
                    <h2 class="mt-4 text-2xl font-extrabold leading-tight text-blue-950 sm:text-3xl" x-text="selectedProduct.name"></h2>

                    <div x-show="selectedProduct.catalog_link" class="mt-4 inline-flex w-fit items-center gap-2 rounded-full border border-green-200 bg-green-50 px-3 py-1.5 text-xs font-bold text-green-700">
                        <span class="h-2 w-2 rounded-full bg-green-600"></span>
                        Terdaftar INAPROC
                    </div>

                    <div class="mt-6 max-h-56 overflow-y-auto rounded-2xl border border-gray-100 bg-gray-50 p-4 text-sm leading-relaxed text-gray-700 sm:max-h-72 sm:text-base">
                        <p class="whitespace-pre-line" x-text="selectedProduct.description || 'Deskripsi produk belum tersedia.'"></p>
                        <p x-show="selectedProduct.description_is_truncated && selectedProduct.catalog_link" class="mt-3 border-t border-gray-200 pt-3 text-xs font-semibold text-blue-700">
                            Deskripsi lengkap tersedia di katalog INAPROC.
                        </p>
                    </div>

                    <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                        <a
                            x-show="selectedProduct.catalog_link"
                            :href="selectedProduct.catalog_link"
                            target="_blank"
                            rel="noopener"
                            class="inline-flex flex-1 items-center justify-center rounded-xl bg-blue-700 px-5 py-3 text-sm font-bold text-white hover:bg-blue-800"
                        >
                            Lihat INAPROC
                        </a>
                        <button
                            type="button"
                            @click="closeProduct(); contactModalOpen = true"
                            class="inline-flex flex-1 items-center justify-center rounded-xl bg-red-600 px-5 py-3 text-sm font-bold text-white hover:bg-red-700"
                        >
                            Hubungi Sales
                        </button>
                    </div>
                </div>
            </div>
        </template>
    </section>
</div>

<script>
    (() => {
        const regionSelector = '[data-products-region]';
        const filterSelector = '[data-products-filter]';
        let requestController = null;

        const normalizeUrl = (url) => {
            const nextUrl = new URL(url, window.location.href);

            if (nextUrl.origin !== window.location.origin || nextUrl.pathname !== '{{ parse_url(route('products'), PHP_URL_PATH) }}') {
                return null;
            }

            return nextUrl;
        };

        const setLoading = (region, loading) => {
            region.style.opacity = loading ? '0.55' : '';
            region.style.pointerEvents = loading ? 'none' : '';
            region.setAttribute('aria-busy', loading ? 'true' : 'false');
        };

        const loadProducts = async (url, pushState = true, scrollToList = true) => {
            const nextUrl = normalizeUrl(url);
            const region = document.querySelector(regionSelector);

            if (!nextUrl || !region) {
                window.location.href = url;
                return;
            }

            if (requestController) {
                requestController.abort();
            }

            requestController = new AbortController();
            setLoading(region, true);

            try {
                const response = await fetch(nextUrl.href, {
                    headers: {
                        'Accept': 'text/html',
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    signal: requestController.signal,
                });

                if (!response.ok) {
                    throw new Error(`HTTP ${response.status}`);
                }

                const page = new DOMParser().parseFromString(await response.text(), 'text/html');
                const nextRegion = page.querySelector(regionSelector);

                if (!nextRegion) {
                    throw new Error('Region produk tidak ditemukan');
                }

                region.replaceWith(nextRegion);

                if (page.title) {
                    document.title = page.title;
                }

                if (pushState) {
                    window.history.pushState({ productsUrl: nextUrl.href }, '', nextUrl.href);
                }

                if (window.Alpine) {
                    window.Alpine.initTree(nextRegion);
                }

                if (scrollToList) {
                    nextRegion.querySelector('section:last-child')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            } catch (error) {
                if (error.name !== 'AbortError') {
                    window.location.href = nextUrl.href;
                }
            } finally {
                requestController = null;
                document.querySelector(regionSelector)?.removeAttribute('aria-busy');
            }
        };

        document.addEventListener('click', (event) => {
            const link = event.target.closest(`${regionSelector} nav a, ${filterSelector} a[href]`);

            if (!link) {
                return;
            }

            const nextUrl = normalizeUrl(link.href);

            if (!nextUrl) {
                return;
            }

            event.preventDefault();
            loadProducts(nextUrl.href);
        });

        document.addEventListener('submit', (event) => {
            const form = event.target.closest(filterSelector);

            if (!form) {
                return;
            }

            event.preventDefault();

            const nextUrl = new URL(form.action, window.location.href);
            const formData = new FormData(form);

            formData.forEach((value, key) => {
                if (value !== '' && value !== 'all') {
                    nextUrl.searchParams.set(key, value);
                } else {
                    nextUrl.searchParams.delete(key);
                }
            });

            loadProducts(nextUrl.href);
        });

        window.addEventListener('popstate', () => {
            loadProducts(window.location.href, false, false);
        });
    })();
</script>
</div>
@endsection
