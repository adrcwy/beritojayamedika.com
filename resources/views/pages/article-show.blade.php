@extends('layouts.public')

@php
    $articleDate = $article->published_at ?? $article->created_at;
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
    $contentImages = collect($article->content_images ?? []);
    $paragraphs = collect(preg_split('/\R{2,}/', trim((string) $article->content)) ?: [])
        ->map(fn ($paragraph) => trim($paragraph))
        ->filter();
@endphp

@section('title', $article->title . ' - PT. Berito Jaya Medika')
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($article->content), 155))
@section('canonical', route('articles.show', $article))
@section('og_image', $articleImage($article->image))

@section('content')
<article class="bg-white">
    <header class="border-b border-blue-100 bg-blue-50/50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14">
            <a href="{{ route('articles') }}" class="inline-flex items-center gap-2 text-sm font-bold text-blue-800 hover:text-red-600">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Artikel
            </a>

            <div class="mt-6 grid gap-8 lg:grid-cols-[0.9fr_1.1fr] lg:items-center">
                <div>
                    <p class="text-sm font-extrabold uppercase tracking-wide text-red-600">{{ $articleDate->format('d F Y') }}</p>
                    <h1 class="mt-3 text-3xl font-extrabold leading-tight text-blue-950 sm:text-5xl">
                        {{ $article->title }}
                    </h1>
                    <p class="mt-5 text-base leading-relaxed text-gray-600 sm:text-lg">
                        {{ \Illuminate\Support\Str::limit(strip_tags($article->content), 190) }}
                    </p>
                </div>

                <div class="overflow-hidden rounded-xl border border-blue-100 bg-white shadow-sm">
                    <img src="{{ $articleImage($article->image) }}" alt="{{ $article->title }}" class="aspect-[16/10] w-full object-cover">
                </div>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14 lg:py-16">
        <div class="grid gap-10 lg:grid-cols-[minmax(0,720px)_280px] lg:justify-center">
            <main class="min-w-0">
                <div class="space-y-5 text-lg leading-8 text-gray-700">
                    @forelse ($paragraphs as $paragraph)
                        <p>{!! nl2br(e($paragraph)) !!}</p>
                    @empty
                        <p>Konten artikel belum tersedia.</p>
                    @endforelse
                </div>

                @if ($contentImages->count() > 0)
                    <section class="mt-10 border-t border-blue-100 pt-8">
                        <h2 class="text-2xl font-extrabold text-blue-950">Dokumentasi Foto</h2>
                        <p class="mt-2 text-sm leading-relaxed text-gray-600">Foto pendukung artikel disusun sebagai galeri agar tetap nyaman dilihat, termasuk saat jumlah foto banyak.</p>

                        <div class="mt-6 grid gap-3 sm:grid-cols-2">
                            @foreach ($contentImages as $image)
                                <figure class="{{ $loop->first && $contentImages->count() > 2 ? 'sm:col-span-2' : '' }} overflow-hidden rounded-xl border border-gray-100 bg-gray-50">
                                    <img src="{{ $articleImage($image) }}" alt="Dokumentasi {{ $article->title }}" loading="lazy" class="w-full {{ $loop->first && $contentImages->count() > 2 ? 'max-h-[560px]' : 'aspect-[4/3]' }} object-cover">
                                </figure>
                            @endforeach
                        </div>
                    </section>
                @endif
            </main>

            <aside class="lg:sticky lg:top-28 lg:self-start">
                <div class="rounded-xl border border-blue-100 bg-white p-5 shadow-sm">
                    <h2 class="text-lg font-extrabold text-blue-950">Artikel Lainnya</h2>
                    <div class="mt-4 space-y-4">
                        @forelse ($relatedArticles as $relatedArticle)
                            @php $relatedDate = $relatedArticle->published_at ?? $relatedArticle->created_at; @endphp
                            <a href="{{ route('articles.show', $relatedArticle) }}" class="group block">
                                <img src="{{ $articleImage($relatedArticle->image) }}" alt="{{ $relatedArticle->title }}" class="aspect-[16/10] w-full rounded-lg bg-gray-50 object-cover">
                                <p class="mt-2 text-xs font-bold text-gray-500">{{ $relatedDate->format('d M Y') }}</p>
                                <h3 class="mt-1 line-clamp-2 text-sm font-extrabold leading-snug text-blue-950 group-hover:text-red-600">{{ $relatedArticle->title }}</h3>
                            </a>
                        @empty
                            <p class="text-sm text-gray-500">Belum ada artikel lain.</p>
                        @endforelse
                    </div>
                </div>
            </aside>
        </div>
    </div>
</article>
@endsection
