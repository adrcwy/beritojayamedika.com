@extends('layouts.public')

@section('title', 'Artikel Alkes dan Kesehatan - PT. Berito Jaya Medika')
@section('meta_description', 'Baca artikel PT. Berito Jaya Medika tentang alat kesehatan, uji fungsi produk, event medis, pengadaan alkes, dan informasi produk untuk fasilitas kesehatan.')
@section('meta_keywords', 'artikel alkes, artikel alat kesehatan, uji fungsi alkes, info alat medis, event kesehatan surabaya, pt. berito jaya medika')
@section('canonical', route('articles'))

@section('content')
@php
    $fallbackImage = asset('image/logo.png');
    $articleImage = function (?string $image) use ($fallbackImage) {
        $image = ltrim((string) $image, '/');

        if (
            $image === ''
            || str_contains($image, '..')
            || (!is_file(storage_path('app/public/' . $image)) && !is_file(public_path('storage/' . $image)))
        ) {
            return $fallbackImage;
        }

        return url('/media/' . $image);
    };

    $articleItems = $articles->getCollection();
    $featuredArticle = $articleItems->first();
    $remainingArticles = $articleItems->skip(1);
@endphp

<section class="bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 lg:py-20">
        <div class="max-w-3xl">
            <h1 class="text-4xl font-extrabold leading-tight text-blue-950 sm:text-5xl lg:text-6xl">
                Artikel dan Dokumentasi PT. Berito Jaya Medika
            </h1>
            <p class="mt-5 text-base leading-relaxed text-gray-600 sm:text-lg">
                Kumpulan berita, dokumentasi uji fungsi, referensi produk, dan aktivitas distribusi alat kesehatan.
            </p>
        </div>
    </div>
</section>

<section class="border-y border-blue-100 bg-blue-50/50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14">
        @if ($featuredArticle)
            @php
                $featuredDate = $featuredArticle->published_at ?? $featuredArticle->created_at;
            @endphp
            <div class="grid gap-6 lg:grid-cols-[1.35fr_0.65fr] lg:items-stretch">
                <a href="{{ route('articles.show', $featuredArticle) }}" class="group grid overflow-hidden rounded-xl border border-blue-100 bg-white shadow-sm transition hover:shadow-lg md:grid-cols-[1.05fr_0.95fr]">
                    <div class="overflow-hidden bg-gray-50">
                        <img src="{{ $articleImage($featuredArticle->image) }}" alt="{{ $featuredArticle->title }}" class="aspect-[16/10] h-full w-full object-cover transition duration-500 group-hover:scale-105">
                    </div>
                    <div class="flex flex-col justify-center p-5 sm:p-7 lg:p-8">
                        <p class="text-sm font-bold text-red-600">{{ $featuredDate->format('d F Y') }}</p>
                        <h2 class="mt-3 text-2xl font-extrabold leading-tight text-blue-950 sm:text-3xl">
                            {{ $featuredArticle->title }}
                        </h2>
                        <p class="mt-4 line-clamp-4 text-sm leading-relaxed text-gray-600 sm:text-base">
                            {{ \Illuminate\Support\Str::limit(strip_tags($featuredArticle->content), 260) }}
                        </p>
                        <span class="mt-6 inline-flex w-fit items-center gap-2 rounded-lg bg-blue-800 px-4 py-2.5 text-sm font-bold text-white">
                            Baca Artikel
                            <svg class="h-4 w-4 transition group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </span>
                    </div>
                </a>

                <aside class="rounded-xl border border-blue-100 bg-white p-5 shadow-sm">
                    <h2 class="text-lg font-extrabold text-blue-950">Artikel Terbaru</h2>
                    <div class="mt-4 space-y-4">
                        @foreach ($remainingArticles->take(3) as $article)
                            @php $articleDate = $article->published_at ?? $article->created_at; @endphp
                            <a href="{{ route('articles.show', $article) }}" class="group grid grid-cols-[92px_1fr] gap-3">
                                <img src="{{ $articleImage($article->image) }}" alt="{{ $article->title }}" class="aspect-[16/10] w-full rounded-lg bg-gray-50 object-cover">
                                <span>
                                    <span class="block text-xs font-bold text-gray-500">{{ $articleDate->format('d M Y') }}</span>
                                    <span class="mt-1 line-clamp-2 block text-sm font-extrabold leading-snug text-blue-950 group-hover:text-red-600">{{ $article->title }}</span>
                                </span>
                            </a>
                        @endforeach
                    </div>
                </aside>
            </div>
        @else
            <div class="rounded-xl border border-blue-100 bg-white p-8 text-center shadow-sm">
                <h2 class="text-2xl font-extrabold text-blue-950">Belum Ada Artikel</h2>
                <p class="mt-2 text-gray-600">Silakan cek kembali nanti untuk update terbaru.</p>
            </div>
        @endif
    </div>
</section>

@if ($remainingArticles->count() > 0)
    <section class="bg-white py-12 sm:py-16 lg:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <h2 class="text-2xl font-extrabold text-blue-950 sm:text-3xl">Semua Artikel</h2>
                    <p class="mt-2 text-sm text-gray-600">Diurutkan berdasarkan tanggal artikel yang dipilih admin.</p>
                </div>
            </div>

            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($remainingArticles as $article)
                    @php
                        $articleDate = $article->published_at ?? $article->created_at;
                        $contentImageCount = count($article->content_images ?? []);
                    @endphp
                    <a href="{{ route('articles.show', $article) }}" class="group overflow-hidden rounded-xl border border-gray-100 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                        <div class="overflow-hidden bg-gray-50">
                            <img src="{{ $articleImage($article->image) }}" alt="{{ $article->title }}" class="aspect-[16/10] w-full object-cover transition duration-500 group-hover:scale-105">
                        </div>
                        <div class="p-5">
                            <div class="flex flex-wrap items-center gap-2 text-xs font-bold text-gray-500">
                                <span>{{ $articleDate->format('d M Y') }}</span>
                                @if ($contentImageCount > 0)
                                    <span class="h-1 w-1 rounded-full bg-gray-300"></span>
                                    <span>{{ $contentImageCount }} foto</span>
                                @endif
                            </div>
                            <h3 class="mt-3 line-clamp-2 min-h-[56px] text-xl font-extrabold leading-tight text-blue-950 group-hover:text-red-600">
                                {{ $article->title }}
                            </h3>
                            <p class="mt-3 line-clamp-3 text-sm leading-relaxed text-gray-600">
                                {{ \Illuminate\Support\Str::limit(strip_tags($article->content), 150) }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $articles->onEachSide(1)->links('vendor.pagination.berito') }}
            </div>
        </div>
    </section>
@endif
@endsection
