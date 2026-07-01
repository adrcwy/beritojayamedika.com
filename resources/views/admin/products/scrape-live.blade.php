<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('products.index') }}" class="flex h-10 w-10 items-center justify-center rounded-xl bg-gray-100 text-gray-600 hover:bg-gray-200">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h2 class="text-2xl font-extrabold text-gray-800">Scrape Manual INAPROC</h2>
                <p class="mt-1 text-sm text-gray-500">Masukkan URL produk, lalu log proses akan tampil live.</p>
            </div>
        </div>
    </x-slot>

    <div class="bg-gradient-to-br from-gray-50 via-blue-50/20 to-gray-50 py-10">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <form action="{{ route('products.scrape.log') }}" method="GET" class="rounded-3xl border border-gray-100 bg-white p-6 shadow-xl sm:p-8">
                <div class="space-y-5">
                    <div>
                        <label for="url" class="mb-2 block text-sm font-bold text-gray-700">URL Produk INAPROC</label>
                        <input id="url" name="url" type="url" required placeholder="https://katalog.inaproc.id/..." class="w-full rounded-xl border-gray-200 px-4 py-3 focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <label class="flex items-center gap-3 rounded-2xl border border-blue-100 bg-blue-50/60 px-4 py-3">
                        <input type="checkbox" name="auto_category" value="1" checked class="rounded border-gray-300 text-blue-700 focus:ring-blue-500">
                        <span>
                            <span class="block text-sm font-bold text-gray-800">Auto Category</span>
                            <span class="block text-xs text-gray-500">Kategori dicoba dicocokkan otomatis dari nama produk.</span>
                        </span>
                    </label>

                    <div class="flex justify-end gap-3 border-t border-gray-100 pt-5">
                        <a href="{{ route('products.index') }}" class="rounded-xl bg-gray-100 px-5 py-3 text-sm font-bold text-gray-700 hover:bg-gray-200">Cancel</a>
                        <button class="rounded-xl bg-blue-700 px-6 py-3 text-sm font-bold text-white shadow-lg hover:bg-blue-800">Mulai Scrape</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
