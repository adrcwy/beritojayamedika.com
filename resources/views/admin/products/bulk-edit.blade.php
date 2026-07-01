<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('products.index') }}" class="flex h-10 w-10 items-center justify-center rounded-xl bg-gray-100 text-gray-600 hover:bg-gray-200">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <div>
                    <h2 class="text-2xl font-extrabold text-gray-800">Bulk Edit Produk</h2>
                    <p class="mt-1 text-sm text-gray-500">Pilih banyak produk lalu pasang ke satu kategori.</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="bg-gradient-to-br from-gray-50 via-indigo-50/20 to-gray-50 py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 font-semibold text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-red-700">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="mb-5 rounded-2xl border border-blue-100 bg-white p-4 shadow-sm">
                <form action="{{ route('products.bulk-edit') }}" method="GET" class="flex flex-col gap-3 sm:flex-row">
                    <input type="search" name="search" value="{{ request('search') }}" placeholder="Cari nama produk..." class="min-h-11 flex-1 rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500">
                    <button class="rounded-xl bg-blue-700 px-5 py-3 text-sm font-bold text-white hover:bg-blue-800">Cari</button>
                    <a href="{{ route('products.bulk-edit') }}" class="rounded-xl border border-gray-200 px-5 py-3 text-center text-sm font-bold text-gray-600 hover:bg-gray-50">Reset</a>
                </form>
            </div>

            <form action="{{ route('products.bulk-update-category') }}" method="POST" class="rounded-3xl border border-gray-100 bg-white shadow-xl">
                @csrf

                <div class="flex flex-col gap-4 border-b border-gray-100 p-5 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <h3 class="text-lg font-extrabold text-gray-900">Daftar Produk</h3>
                        <p class="text-sm text-gray-500">Menampilkan {{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }} dari {{ $products->total() }} produk.</p>
                    </div>
                    <div class="flex flex-col gap-3 sm:flex-row">
                        <select name="category_id" class="min-h-11 rounded-xl border-gray-200 text-gray-700 focus:border-indigo-500 focus:ring-indigo-500" required>
                            <option value="">Pilih kategori tujuan</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <button class="rounded-xl bg-indigo-700 px-5 py-3 text-sm font-bold text-white hover:bg-indigo-800">Apply Category</button>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="w-14 px-5 py-4 text-left">
                                    <input id="select-all-products" type="checkbox" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                </th>
                                <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-600">Produk</th>
                                <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-600">Kategori Saat Ini</th>
                                <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-600">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($products as $product)
                                <tr class="hover:bg-indigo-50/40">
                                    <td class="px-5 py-4">
                                        <input type="checkbox" name="product_ids[]" value="{{ $product->id }}" class="product-checkbox rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    </td>
                                    <td class="px-5 py-4">
                                        <div class="font-bold text-gray-900">{{ $product->name }}</div>
                                        @if($product->catalog_link)
                                            <a href="{{ $product->catalog_link }}" target="_blank" class="text-xs font-semibold text-blue-700 hover:text-blue-900">Lihat INAPROC</a>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4 text-sm text-gray-600">{{ $product->category->name ?? '-' }}</td>
                                    <td class="px-5 py-4">
                                        <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-bold {{ $product->is_active ? 'bg-green-50 text-green-700 ring-1 ring-green-200' : 'bg-gray-100 text-gray-600 ring-1 ring-gray-200' }}">
                                            {{ $product->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-5 py-14 text-center text-gray-500">Produk tidak ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($products->hasPages())
                    <div class="border-t border-blue-100 bg-white p-5">
                        {{ $products->links('vendor.pagination.berito') }}
                    </div>
                @endif
            </form>
        </div>
    </div>

    <script>
        document.getElementById('select-all-products')?.addEventListener('change', function () {
            document.querySelectorAll('.product-checkbox').forEach((checkbox) => {
                checkbox.checked = this.checked;
            });
        });
    </script>
</x-app-layout>
