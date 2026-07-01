<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-extrabold leading-tight text-gray-800">Article Management</h2>
                <p class="mt-1 text-sm text-gray-500">Kelola artikel, tanggal publikasi, thumbnail, dan foto konten.</p>
            </div>
            <a href="{{ route('articles.create') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-800 px-5 py-3 text-sm font-bold text-white shadow-sm hover:bg-blue-900">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tulis Artikel Baru
            </a>
        </div>
    </x-slot>

    <div class="bg-gray-50 py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 rounded-xl border border-green-200 bg-green-50 p-4 text-sm font-semibold text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-xl">
                <div class="border-b border-gray-100 bg-blue-950 px-6 py-5">
                    <h3 class="text-xl font-bold text-white">Daftar Artikel</h3>
                    <p class="mt-1 text-sm text-blue-100">Total: {{ $articles->count() }} artikel</p>
                </div>

                <div class="divide-y divide-gray-100">
                    @forelse ($articles as $article)
                        @php
                            $articleDate = $article->published_at ?? $article->created_at;
                            $contentImageCount = count($article->content_images ?? []);
                        @endphp
                        <article class="grid gap-4 p-4 transition hover:bg-blue-50/40 sm:grid-cols-[160px_1fr_auto] sm:p-5">
                            <div class="overflow-hidden rounded-xl border border-gray-200 bg-gray-50">
                                @if ($article->image)
                                    <img src="{{ url('/media/' . ltrim($article->image, '/')) }}" alt="{{ $article->title }}" class="aspect-[16/10] w-full object-cover">
                                @else
                                    <div class="flex aspect-[16/10] items-center justify-center p-4 text-center text-xs font-bold text-gray-400">No Thumbnail</div>
                                @endif
                            </div>

                            <div class="min-w-0">
                                <div class="flex flex-wrap items-center gap-2 text-xs font-bold text-gray-500">
                                    <span>{{ $articleDate->format('d M Y') }}</span>
                                    <span class="h-1 w-1 rounded-full bg-gray-300"></span>
                                    <span>{{ $contentImageCount }} foto konten</span>
                                </div>
                                <h3 class="mt-2 text-lg font-extrabold text-gray-900">{{ $article->title }}</h3>
                                <p class="mt-2 line-clamp-2 text-sm leading-relaxed text-gray-600">{{ Str::limit(strip_tags($article->content), 180) }}</p>
                            </div>

                            <div class="flex items-center gap-2 sm:flex-col sm:items-stretch sm:justify-center">
                                <a href="{{ route('articles.edit', $article->id) }}" class="inline-flex justify-center rounded-xl bg-blue-50 px-4 py-2 text-sm font-bold text-blue-800 hover:bg-blue-100">Edit</a>
                                <form action="{{ route('articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Hapus artikel ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex w-full justify-center rounded-xl bg-red-50 px-4 py-2 text-sm font-bold text-red-700 hover:bg-red-100">Delete</button>
                                </form>
                            </div>
                        </article>
                    @empty
                        <div class="p-10 text-center">
                            <h3 class="text-xl font-bold text-gray-900">Belum Ada Artikel</h3>
                            <p class="mt-2 text-gray-500">Mulai dengan membuat artikel pertama.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
