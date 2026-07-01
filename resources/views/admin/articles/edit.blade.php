<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('articles.index') }}" class="flex h-10 w-10 items-center justify-center rounded-xl bg-gray-100 text-gray-600 transition hover:bg-gray-200 hover:text-gray-900">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h2 class="text-2xl font-extrabold leading-tight text-gray-800">Edit Artikel</h2>
                <p class="mt-1 text-sm text-gray-500">{{ Str::limit($article->title, 70) }}</p>
            </div>
        </div>
    </x-slot>

    <div class="bg-gray-50 py-10">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <form id="articleForm" action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data" class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-xl">
                @csrf
                @method('PUT')

                <div class="border-b border-gray-100 bg-blue-950 px-6 py-5 sm:px-8">
                    <h3 class="text-xl font-bold text-white">Update Konten Artikel</h3>
                    <p class="mt-1 text-sm text-blue-100">Tambah foto baru atau hapus foto konten yang tidak dipakai.</p>
                </div>

                <div class="grid gap-8 p-6 sm:p-8 lg:grid-cols-[1.25fr_0.75fr]">
                    <div class="space-y-6">
                        <div>
                            <label for="title" class="mb-2 block text-sm font-bold text-gray-700">Judul Artikel <span class="text-red-600">*</span></label>
                            <input id="title" name="title" type="text" value="{{ old('title', $article->title) }}" required class="w-full rounded-xl border-gray-200 px-4 py-3 text-gray-900 focus:border-blue-600 focus:ring-blue-600">
                            @error('title') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="content" class="mb-2 block text-sm font-bold text-gray-700">Isi Artikel <span class="text-red-600">*</span></label>
                            <textarea id="content" name="content" rows="14" required class="w-full rounded-xl border-gray-200 px-4 py-3 leading-relaxed text-gray-900 focus:border-blue-600 focus:ring-blue-600">{{ old('content', $article->content) }}</textarea>
                            @error('content') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        @if (!empty($article->content_images))
                            <div>
                                <p class="mb-3 text-sm font-bold text-gray-700">Foto Konten Saat Ini</p>
                                <div class="grid grid-cols-2 gap-3 sm:grid-cols-3">
                                    @foreach ($article->content_images as $contentImage)
                                        <label class="group relative overflow-hidden rounded-xl border border-gray-200 bg-white">
                                            <img src="{{ url('/media/' . ltrim($contentImage, '/')) }}" alt="Foto konten artikel" class="aspect-[4/3] w-full object-cover">
                                            <span class="flex items-center gap-2 px-3 py-2 text-xs font-bold text-gray-700">
                                                <input type="checkbox" name="remove_content_images[]" value="{{ $contentImage }}" class="rounded border-gray-300 text-red-600 focus:ring-red-600">
                                                Hapus foto
                                            </span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <aside class="space-y-6">
                        <div>
                            <label for="published_at" class="mb-2 block text-sm font-bold text-gray-700">Tanggal Artikel</label>
                            <input id="published_at" name="published_at" type="date" value="{{ old('published_at', optional($article->published_at ?? $article->created_at)->format('Y-m-d')) }}" class="w-full rounded-xl border-gray-200 px-4 py-3 text-gray-900 focus:border-blue-600 focus:ring-blue-600">
                            <p class="mt-2 text-xs text-gray-500">Urutan artikel publik mengikuti tanggal ini.</p>
                            @error('published_at') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="image" class="mb-2 block text-sm font-bold text-gray-700">Thumbnail Artikel</label>
                            @if ($article->image)
                                <img src="{{ url('/media/' . ltrim($article->image, '/')) }}" alt="Thumbnail saat ini" class="mb-3 aspect-[16/10] w-full rounded-xl border border-gray-200 bg-gray-50 object-cover">
                            @endif
                            <input id="image" name="image" type="file" accept="image/*" class="w-full rounded-xl border-2 border-dashed border-gray-200 px-4 py-3 text-sm file:mr-4 file:rounded-lg file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:font-bold file:text-blue-800 hover:border-blue-300">
                            <div class="mt-3 grid grid-cols-1 gap-2 text-sm sm:grid-cols-2">
                                <label class="flex cursor-pointer items-start gap-2 rounded-xl border border-blue-100 bg-blue-50/60 p-3">
                                    <input type="radio" name="thumbnail_mode" value="contain" class="mt-1 text-blue-700 focus:ring-blue-700" checked>
                                    <span>
                                        <span class="block font-bold text-blue-950">Ngepasin utuh</span>
                                        <span class="block text-xs text-gray-600">Tidak kepotong, area kosong diisi putih.</span>
                                    </span>
                                </label>
                                <label class="flex cursor-pointer items-start gap-2 rounded-xl border border-gray-200 bg-white p-3">
                                    <input type="radio" name="thumbnail_mode" value="cover" class="mt-1 text-blue-700 focus:ring-blue-700">
                                    <span>
                                        <span class="block font-bold text-blue-950">Crop penuh</span>
                                        <span class="block text-xs text-gray-600">Penuh 1200 x 750, sisi berlebih dipotong tengah.</span>
                                    </span>
                                </label>
                            </div>
                            <p class="mt-2 text-xs text-gray-500">Kosongkan jika thumbnail tidak diganti. Gambar baru otomatis dibuat 1200 x 750 px.</p>
                            @error('image') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="content_images" class="mb-2 block text-sm font-bold text-gray-700">Tambah Foto Konten</label>
                            <input id="content_images" name="content_images[]" type="file" accept="image/*" multiple class="w-full rounded-xl border-2 border-dashed border-gray-200 px-4 py-3 text-sm file:mr-4 file:rounded-lg file:border-0 file:bg-red-50 file:px-4 file:py-2 file:font-bold file:text-red-700 hover:border-red-300">
                            <p class="mt-2 text-xs text-gray-500">Foto baru akan ditambahkan ke galeri artikel dan dikompres otomatis.</p>
                            @error('content_images.*') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </aside>
                </div>

                <div class="flex flex-col-reverse gap-3 border-t border-gray-100 bg-gray-50 px-6 py-5 sm:flex-row sm:justify-end sm:px-8">
                    <a href="{{ route('articles.index') }}" class="inline-flex justify-center rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-bold text-gray-700 hover:bg-gray-100">Batal</a>
                    <span id="uploadStatus" class="hidden text-sm font-semibold text-blue-800"></span>
                    <button id="articleSubmitButton" type="submit" class="inline-flex justify-center rounded-xl bg-blue-800 px-6 py-3 text-sm font-bold text-white shadow-sm hover:bg-blue-900">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    @include('admin.articles.partials.image-compression-script')
</x-app-layout>
