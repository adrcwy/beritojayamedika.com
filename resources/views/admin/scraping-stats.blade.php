<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Scraping Stats
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <p class="text-sm text-gray-500">Total Produk</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['total_products'] }}</p>
                </div>
                <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <p class="text-sm text-gray-500">Dengan Kategori</p>
                    <p class="text-3xl font-bold text-green-600">{{ $stats['with_category'] }}</p>
                </div>
                <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <p class="text-sm text-gray-500">Tanpa Kategori</p>
                    <p class="text-3xl font-bold text-yellow-600">{{ $stats['without_category'] }}</p>
                </div>
                <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <p class="text-sm text-gray-500">Hari Ini</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $stats['today_count'] }}</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Top Categories</h3>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah Produk</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($stats['top_categories'] as $category)
                                    <tr>
                                        <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $category->name }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-600">{{ $category->products_count }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="px-4 py-8 text-center text-sm text-gray-500">Belum ada kategori.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
