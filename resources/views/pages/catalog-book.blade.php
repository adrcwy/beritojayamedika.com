@extends('layouts.public')

@section('title', 'Catalog Book Alkes | PT. Berito Jaya Medika')
@section('meta_description', 'Baca catalog book alat kesehatan PT. Berito Jaya Medika dalam mode PDF reader atau flip book.')
@section('canonical', route('catalog-book'))

@section('content')
@php
    $pdfUrl = $featuredCatalog ? \App\Support\MediaPath::url($featuredCatalog->pdf_path) : null;
    $coverUrl = $featuredCatalog && $featuredCatalog->cover_image
        ? \App\Support\MediaPath::url($featuredCatalog->cover_image)
        : asset('image/logo.png');
@endphp

<section class="bg-gradient-to-br from-blue-50 via-white to-blue-50">
    <div class="container mx-auto px-4 py-12 sm:px-6 lg:px-8 lg:py-16">
        <div class="grid gap-8 lg:grid-cols-[0.9fr_1.1fr] lg:items-center">
            <div>
                <span class="inline-flex rounded-full bg-yellow-400 px-4 py-2 text-xs font-extrabold text-blue-900 shadow-sm">Catalog Book</span>
                <h1 class="mt-5 text-3xl font-extrabold leading-tight text-blue-950 sm:text-5xl">
                    Baca katalog alat kesehatan kami secara online
                </h1>
                <p class="mt-4 max-w-2xl text-base leading-relaxed text-gray-600 sm:text-lg">
                    Pilih mode PDF reader untuk membaca langsung, atau mode flip book untuk pengalaman seperti membuka buku katalog.
                </p>
            </div>

            <div class="overflow-hidden rounded-3xl border border-blue-100 bg-white shadow-xl">
                @if($featuredCatalog)
                    <div class="grid gap-0 sm:grid-cols-[180px_1fr]">
                        <div class="flex min-h-52 items-center justify-center bg-blue-50 p-6">
                            <img src="{{ $coverUrl }}" alt="{{ $featuredCatalog->title }}" class="max-h-52 max-w-full rounded-xl object-contain">
                        </div>
                        <div class="p-6">
                            <p class="text-sm font-bold text-red-600">{{ optional($featuredCatalog->published_at)->format('d M Y') ?? 'Catalog terbaru' }}</p>
                            <h2 class="mt-2 text-2xl font-extrabold text-blue-950">{{ $featuredCatalog->title }}</h2>
                            @if($featuredCatalog->description)
                                <p class="mt-3 text-sm leading-relaxed text-gray-600">{{ $featuredCatalog->description }}</p>
                            @endif
                            <a href="{{ $pdfUrl }}" target="_blank" class="mt-5 inline-flex rounded-xl bg-blue-700 px-5 py-3 text-sm font-bold text-white shadow-lg hover:bg-blue-800">
                                Buka PDF di Tab Baru
                            </a>
                        </div>
                    </div>
                @else
                    <div class="p-8 text-center">
                        <h2 class="text-2xl font-extrabold text-blue-950">Catalog belum tersedia</h2>
                        <p class="mt-2 text-gray-600">Admin dapat upload PDF melalui menu Catalog Book.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@if($featuredCatalog)
<section class="bg-white py-10 sm:py-14">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div x-data="{ mode: 'pdf' }" class="space-y-6">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-2xl font-extrabold text-blue-950 sm:text-3xl">{{ $featuredCatalog->title }}</h2>
                    <p class="mt-1 text-sm text-gray-500">Mode baca bisa diganti kapan saja.</p>
                </div>
                <div class="inline-flex rounded-2xl border border-blue-100 bg-white p-1 shadow-sm">
                    <button type="button" @click="mode = 'pdf'" :class="mode === 'pdf' ? 'bg-blue-800 text-white' : 'text-gray-600 hover:bg-blue-50'" class="rounded-xl px-4 py-2 text-sm font-bold transition">PDF Reader</button>
                    <button type="button" @click="mode = 'flip'; window.dispatchEvent(new CustomEvent('catalog-flip-open'))" :class="mode === 'flip' ? 'bg-blue-800 text-white' : 'text-gray-600 hover:bg-blue-50'" class="rounded-xl px-4 py-2 text-sm font-bold transition">Flip Book</button>
                </div>
            </div>

            <div x-show="mode === 'pdf'" class="overflow-hidden rounded-3xl border border-blue-100 bg-gray-100 shadow-xl">
                <iframe src="{{ $pdfUrl }}#toolbar=1&navpanes=0" title="{{ $featuredCatalog->title }}" class="h-[72vh] min-h-[560px] w-full bg-white"></iframe>
            </div>

            <div x-show="mode === 'flip'" x-cloak class="rounded-3xl border border-blue-100 bg-slate-900 p-3 shadow-xl sm:p-5">
                <div id="flipbook-reader" data-pdf-url="{{ $pdfUrl }}" class="space-y-4">
                    <div class="flex flex-wrap items-center justify-between gap-3 text-white">
                        <button type="button" data-prev class="rounded-xl bg-white/10 px-4 py-2 text-sm font-bold hover:bg-white/20">Prev</button>
                        <div class="text-center text-sm font-bold">
                            <span data-page-label>Memuat catalog...</span>
                        </div>
                        <button type="button" data-next class="rounded-xl bg-white/10 px-4 py-2 text-sm font-bold hover:bg-white/20">Next</button>
                    </div>
                    <div class="flex min-h-[60vh] items-center justify-center overflow-hidden rounded-2xl bg-slate-800 p-2 sm:p-5">
                        <div data-book class="grid w-full max-w-6xl grid-cols-1 gap-3 md:grid-cols-2 md:gap-0">
                            <canvas data-left class="mx-auto max-h-[72vh] w-full max-w-[520px] rounded-l-lg bg-white shadow-2xl"></canvas>
                            <canvas data-right class="mx-auto hidden max-h-[72vh] w-full max-w-[520px] rounded-r-lg bg-white shadow-2xl md:block"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            @if($catalogBooks->count() > 1)
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($catalogBooks->skip(1) as $catalogBook)
                        <a href="{{ \App\Support\MediaPath::url($catalogBook->pdf_path) }}" target="_blank" class="rounded-2xl border border-blue-100 bg-blue-50/50 p-5 hover:bg-blue-50">
                            <p class="text-xs font-bold text-red-600">{{ optional($catalogBook->published_at)->format('d M Y') ?? 'Catalog' }}</p>
                            <h3 class="mt-2 font-extrabold text-blue-950">{{ $catalogBook->title }}</h3>
                            <p class="mt-2 text-sm text-gray-600">Buka PDF catalog</p>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>
@endif
@endsection

@if($featuredCatalog)
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script>
    (() => {
        const root = document.getElementById('flipbook-reader');
        if (!root || !window.pdfjsLib) return;

        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

        const pdfUrl = root.dataset.pdfUrl;
        const leftCanvas = root.querySelector('[data-left]');
        const rightCanvas = root.querySelector('[data-right]');
        const label = root.querySelector('[data-page-label]');
        const prev = root.querySelector('[data-prev]');
        const next = root.querySelector('[data-next]');
        let pdfDoc = null;
        let page = 1;
        let loaded = false;

        const isDesktop = () => window.matchMedia('(min-width: 768px)').matches;

        async function renderPage(pageNumber, canvas) {
            if (!canvas || pageNumber > pdfDoc.numPages) {
                if (canvas) canvas.classList.add('hidden');
                return;
            }

            canvas.classList.remove('hidden');
            const pdfPage = await pdfDoc.getPage(pageNumber);
            const viewport = pdfPage.getViewport({ scale: 1 });
            const availableWidth = Math.min(canvas.parentElement.clientWidth, 520);
            const scale = Math.max(0.6, availableWidth / viewport.width);
            const scaled = pdfPage.getViewport({ scale });
            const context = canvas.getContext('2d');

            canvas.width = scaled.width;
            canvas.height = scaled.height;

            await pdfPage.render({ canvasContext: context, viewport: scaled }).promise;
        }

        async function renderSpread() {
            if (!pdfDoc) return;
            const desktop = isDesktop();
            const leftPage = desktop && page > 1 ? page : page;
            const rightPage = desktop ? leftPage + 1 : page + 1;

            await renderPage(leftPage, leftCanvas);
            if (desktop && rightPage <= pdfDoc.numPages) {
                await renderPage(rightPage, rightCanvas);
            } else {
                rightCanvas.classList.add('hidden');
            }

            label.textContent = desktop
                ? `${leftPage}${rightPage <= pdfDoc.numPages ? '-' + rightPage : ''} / ${pdfDoc.numPages}`
                : `${leftPage} / ${pdfDoc.numPages}`;
        }

        async function loadPdf() {
            if (loaded) return;
            loaded = true;
            pdfDoc = await pdfjsLib.getDocument(pdfUrl).promise;
            await renderSpread();
        }

        prev?.addEventListener('click', async () => {
            page = Math.max(1, page - (isDesktop() ? 2 : 1));
            await renderSpread();
        });

        next?.addEventListener('click', async () => {
            page = Math.min(pdfDoc?.numPages || 1, page + (isDesktop() ? 2 : 1));
            await renderSpread();
        });

        window.addEventListener('catalog-flip-open', loadPdf);
        window.addEventListener('resize', () => {
            if (loaded) renderSpread();
        });
    })();
</script>
@endpush
@endif
