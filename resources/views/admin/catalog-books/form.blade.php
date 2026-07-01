<div class="space-y-6">
    <div>
        <label for="title" class="mb-2 block text-sm font-bold text-gray-700">Judul Katalog</label>
        <input id="title" name="title" value="{{ old('title', $catalogBook->title ?? '') }}" required class="w-full rounded-xl border-gray-200 px-4 py-3 focus:border-blue-500 focus:ring-blue-500" placeholder="Katalog PT. Berito Jaya Medika 2026">
    </div>

    <div>
        <label for="description" class="mb-2 block text-sm font-bold text-gray-700">Deskripsi</label>
        <textarea id="description" name="description" rows="4" class="w-full rounded-xl border-gray-200 px-4 py-3 focus:border-blue-500 focus:ring-blue-500" placeholder="Ringkasan isi katalog...">{{ old('description', $catalogBook->description ?? '') }}</textarea>
    </div>

    <div class="grid gap-6 sm:grid-cols-2">
        <div>
            <label for="published_at" class="mb-2 block text-sm font-bold text-gray-700">Tanggal Publish</label>
            <input id="published_at" type="date" name="published_at" value="{{ old('published_at', optional($catalogBook->published_at ?? null)->format('Y-m-d')) }}" class="w-full rounded-xl border-gray-200 px-4 py-3 focus:border-blue-500 focus:ring-blue-500">
        </div>
        <label class="flex items-center gap-3 rounded-2xl border border-green-100 bg-green-50/70 px-4 py-3">
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300 text-green-600 focus:ring-green-500" @checked(old('is_active', $catalogBook->is_active ?? true))>
            <span>
                <span class="block text-sm font-bold text-gray-800">Active</span>
                <span class="block text-xs text-gray-500">Tampil di halaman publik.</span>
            </span>
        </label>
    </div>

    <div>
        <label for="pdf_path" class="mb-2 block text-sm font-bold text-gray-700">File PDF Katalog</label>
        @if($catalogBook?->pdf_path)
            <a href="{{ \App\Support\MediaPath::url($catalogBook->pdf_path) }}" target="_blank" class="mb-3 inline-flex rounded-xl bg-blue-50 px-4 py-2 text-sm font-bold text-blue-700 hover:bg-blue-100">Lihat PDF saat ini</a>
        @endif
        <input id="pdf_path" type="file" name="pdf_path" accept="application/pdf" @if(!$catalogBook) required @endif class="w-full rounded-xl border-2 border-dashed border-gray-300 px-4 py-3 file:mr-4 file:rounded-lg file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-sm file:font-bold file:text-blue-700">
        <p class="mt-2 text-xs text-gray-500">PDF maksimal 500MB. Kalau masih kena 413, naikkan limit di hosting/cPanel juga.</p>
    </div>

    <div>
        <label for="cover_image" class="mb-2 block text-sm font-bold text-gray-700">Cover Image Opsional</label>
        @if($catalogBook?->cover_image)
            <img src="{{ \App\Support\MediaPath::url($catalogBook->cover_image) }}" alt="Cover saat ini" class="mb-3 h-40 rounded-xl border border-gray-100 object-cover">
        @endif
        <input id="cover_image" type="file" name="cover_image" accept="image/*" class="w-full rounded-xl border-2 border-dashed border-gray-300 px-4 py-3 file:mr-4 file:rounded-lg file:border-0 file:bg-indigo-50 file:px-4 file:py-2 file:text-sm file:font-bold file:text-indigo-700">
    </div>

    <div class="flex justify-end gap-3 border-t border-gray-100 pt-6">
        <a href="{{ route('catalog-books.index') }}" class="rounded-xl bg-gray-100 px-5 py-3 text-sm font-bold text-gray-700 hover:bg-gray-200">Cancel</a>
        <button class="rounded-xl bg-blue-700 px-6 py-3 text-sm font-bold text-white shadow-lg hover:bg-blue-800">Simpan Katalog</button>
    </div>
</div>
