<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-gradient-to-br from-red-600 to-red-800 rounded-xl flex items-center justify-center shadow-lg">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <div>
                    <h2 class="font-extrabold text-2xl text-gray-800 leading-tight">
                        Product Management
                    </h2>
                    <p class="text-sm text-gray-500 mt-1">Manage all your medical equipment products</p>
                </div>
            </div>
            
            <div class="flex flex-wrap justify-end gap-2">
                <a href="{{ route('products.scrape.log') }}"
                   class="inline-flex items-center gap-2 bg-blue-50 hover:bg-blue-100 text-blue-700 font-bold py-3 px-4 rounded-xl transition-all shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    <span>Scrape Manual</span>
                </a>
                <a href="{{ route('products.bulk-edit') }}"
                   class="inline-flex items-center gap-2 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 font-bold py-3 px-4 rounded-xl transition-all shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5h6M9 12h6m-6 7h6M5 5h.01M5 12h.01M5 19h.01"/>
                    </svg>
                    <span>Bulk Edit</span>
                </a>
                <a href="{{ route('products.create') }}" 
                   class="group inline-flex items-center gap-2 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold py-3 px-5 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5 transform group-hover:rotate-90 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Add New Product</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-gray-50 via-red-50/20 to-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="mb-6 bg-gradient-to-r from-green-50 to-green-100 border-l-4 border-green-600 rounded-xl shadow-lg overflow-hidden transform animate-fade-in">
                    <div class="p-5 flex items-center gap-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-green-600 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-green-900 font-bold text-lg">Success!</h3>
                            <p class="text-green-700">{{ session('success') }}</p>
                        </div>
                        <button onclick="this.closest('div').parentElement.remove()" class="text-green-600 hover:text-green-900 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 bg-gradient-to-r from-red-50 to-red-100 border-l-4 border-red-600 rounded-xl shadow-lg overflow-hidden transform animate-fade-in">
                    <div class="p-5 flex items-center gap-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-red-600 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-red-900 font-bold text-lg">Error</h3>
                            <p class="text-red-700">{{ session('error') }}</p>
                        </div>
                        <button onclick="this.closest('div').parentElement.remove()" class="text-red-600 hover:text-red-900 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
            @endif

            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border-2 border-gray-100">
                
                <div class="bg-gradient-to-r from-red-600 to-red-700 px-8 py-6">
                    <div class="flex items-center justify-between flex-wrap gap-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-white">Product List</h3>
                                <p class="text-red-100 text-sm">Total: {{ $products->total() }} products | Aktif: {{ $activeCount }} | Inaktif: {{ $inactiveCount }}</p>
                            </div>
                        </div>

                        <div class="flex w-full flex-col gap-2 md:w-auto md:flex-row md:items-center">
                        <a href="{{ route('products.repair-images.log') }}" class="w-full rounded-xl bg-white/15 px-4 py-2 text-center text-sm font-bold text-white ring-1 ring-white/25 hover:bg-white/25 md:w-auto">
                                Repair Gambar
                        </a>
                        <a href="{{ route('products.deactivate-dead-links.log') }}" onclick="return confirm('Cek semua link INAPROC aktif dan nonaktifkan produk yang link-nya mati? Proses bisa butuh waktu.');" class="w-full rounded-xl bg-white/15 px-4 py-2 text-center text-sm font-bold text-white ring-1 ring-white/25 hover:bg-white/25 md:w-auto">
                                Cek Link Mati
                        </a>
                        <div class="relative w-full md:w-64">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            </div>
                            <input type="text" 
                                   id="search-input" 
                                   class="w-full pl-10 pr-4 py-2 rounded-xl bg-white/20 border border-white/30 text-white placeholder-red-100 focus:outline-none focus:ring-2 focus:ring-white focus:bg-white/30 transition-all placeholder:text-sm" 
                                   placeholder="Search products..."
                                   autocomplete="off">
                        </div>
                        </div>
                        </div>
                </div>

                <div id="table-wrapper">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                                <tr>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            Image
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                            </svg>
                                            Product Name
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                            </svg>
                                            Link Katalog
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            Actions
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($products as $product)
                                @php
                                    $imageData = \App\Support\MediaPath::data($product->image, asset('image/logo.png'));
                                @endphp
                                <tr class="hover:bg-red-50/50 transition-colors duration-200 group">
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="relative w-20 h-20 rounded-xl overflow-hidden shadow-lg ring-2 ring-gray-200 group-hover:ring-red-400 transition-all duration-300">
                                            @if($imageData['available'])
                                                <img src="{{ $imageData['url'] }}" 
                                                    alt="{{ $product->name }}" 
                                                    class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                                            @else
                                                <div class="w-full h-full bg-blue-50 flex flex-col items-center justify-center text-blue-700 text-[10px] font-bold text-center leading-tight px-2">
                                                    <img src="{{ asset('image/logo.png') }}" alt="" class="mb-1 h-6 w-auto opacity-80">
                                                    Sync gambar
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    
                                    <td class="px-6 py-5">
                                        <div class="flex items-start gap-3">
                                            <div>
                                                <div class="text-sm font-bold text-gray-900 group-hover:text-red-600 transition-colors">
                                                    {{ $product->name }}
                                                </div>
                                                @if($product->category)
                                                    <div class="mt-1 inline-flex items-center gap-1 bg-blue-100 text-blue-700 text-xs font-semibold px-2 py-1 rounded-full">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                                        </svg>
                                                        {{ $product->category->name }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-5">
                                        @if($product->catalog_link)
                                            <a href="{{ $product->catalog_link }}" target="_blank" 
                                            class="inline-flex items-center gap-1 text-indigo-600 hover:text-indigo-800 text-sm font-semibold">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                                </svg>
                                                Link Tersedia
                                            </a>
                                        @else
                                            <span class="text-gray-400 text-sm">-</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-5">
                                        <form action="{{ route('products.toggle-active', $product->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-bold {{ $product->is_active ? 'bg-green-50 text-green-700 ring-1 ring-green-200' : 'bg-gray-100 text-gray-600 ring-1 ring-gray-200' }}">
                                                <span class="h-2 w-2 rounded-full {{ $product->is_active ? 'bg-green-500' : 'bg-gray-400' }}"></span>
                                                {{ $product->is_active ? 'Active' : 'Inactive' }}
                                            </button>
                                        </form>
                                    </td>
                                    
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="flex items-center gap-2 flex-wrap">
                                            @if($product->catalog_link)
                                            <a href="{{ route('products.sync-inaproc.log', $product->id) }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-green-50 to-green-100 hover:from-green-600 hover:to-green-700 text-green-700 hover:text-white font-semibold px-4 py-2 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-sm hover:shadow-md">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v6h6M20 20v-6h-6M20 8a8 8 0 00-14.9-4M4 16a8 8 0 0014.9 4"/>
                                                    </svg>
                                                    <span class="text-sm">Sync</span>
                                            </a>
                                            @endif
                                            <a href="{{ route('products.edit', $product->id) }}" 
                                            class="group/edit inline-flex items-center gap-2 bg-gradient-to-r from-blue-50 to-blue-100 hover:from-blue-600 hover:to-blue-700 text-blue-700 hover:text-white font-semibold px-4 py-2 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-sm hover:shadow-md">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                <span class="text-sm">Edit</span>
                                            </a>

                                            @if($product->image)
                                            <form action="{{ route('products.remove-background', $product->id) }}" method="POST" class="inline-block removebg-form">
                                                @csrf
                                                <button type="submit" title="Hapus background gambar via Remove.bg API" class="group/bg inline-flex items-center gap-2 bg-gradient-to-r from-purple-50 to-purple-100 hover:from-purple-600 hover:to-purple-700 text-purple-700 hover:text-white font-semibold px-4 py-2 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-sm hover:shadow-md">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                    <span class="text-sm removebg-text">Remove BG</span>
                                                </button>
                                            </form>
                                            @endif
                                            
                                            <form action="{{ route('products.destroy', $product->id) }}" 
                                                method="POST" 
                                                class="inline-block" 
                                                onsubmit="return confirm('Are you sure you want to delete this product?\n\nProduct: {{ $product->name }}\n\nThis action cannot be undone.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="group/delete inline-flex items-center gap-2 bg-gradient-to-r from-red-50 to-red-100 hover:from-red-600 hover:to-red-700 text-red-700 hover:text-white font-semibold px-4 py-2 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-sm hover:shadow-md">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                    <span class="text-sm">Delete</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mb-4">
                                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                                </svg>
                                            </div>
                                            <h3 class="text-xl font-bold text-gray-900 mb-2">No Products Found</h3>
                                            <p class="text-gray-500 mb-6">We couldn't find what you are looking for.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    @if($products->hasPages())
                    <div class="bg-white px-6 py-5 border-t border-blue-100">
                        {{ $products->links('vendor.pagination.berito') }}
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            let timer;

            // Fungsi untuk melakukan request
            function fetchProducts(query, url) {
                // Tampilan loading
                $('#icon-search').addClass('hidden');
                $('#icon-loading').removeClass('hidden');
                $('#table-wrapper').addClass('opacity-50 pointer-events-none'); // Efek fade saat loading

                // Default URL
                url = url || "{{ route('products.index') }}";

                $.ajax({
                    url: url,
                    data: { search: query },
                    success: function(response) {
                        // Ambil hanya bagian #table-wrapper dari HTML response dan ganti yg lama
                        let newTable = $(response).find('#table-wrapper').html();
                        $('#table-wrapper').html(newTable);
                        
                        // Kembalikan tampilan normal
                        $('#table-wrapper').removeClass('opacity-50 pointer-events-none');
                        $('#icon-search').removeClass('hidden');
                        $('#icon-loading').addClass('hidden');

                        // Update URL di browser agar history tersimpan
                        let newUrl = url + (url.includes('?') ? '&' : '?') + 'search=' + encodeURIComponent(query);
                        window.history.pushState(null, '', newUrl);
                    },
                    error: function() {
                        alert('Gagal memuat data. Silakan coba lagi.');
                        $('#table-wrapper').removeClass('opacity-50 pointer-events-none');
                    }
                });
            }

            // 1. Event saat mengetik (dengan delay/debounce 500ms agar ringan)
            $('#search-input').on('keyup', function() {
                let query = $(this).val();
                clearTimeout(timer);
                timer = setTimeout(function() {
                    fetchProducts(query);
                }, 500); 
            });

            // 2. Event saat klik pagination (agar tidak refresh halaman)
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                let url = $(this).attr('href');
                let query = $('#search-input').val();
                fetchProducts(query, url);
            });

            // Remove BG button - confirmation + loading
            $(document).on('submit', '.removebg-form', function(e) {
                if (!confirm('Hapus background gambar ini?\n\nProses ini akan memanggil API Remove.bg dan mengganti gambar produk.')) {
                    e.preventDefault();
                    return false;
                }
                const btn = $(this).find('button');
                btn.prop('disabled', true).addClass('opacity-60 cursor-wait');
                btn.find('.removebg-text').text('Processing...');
            });
        });
    </script>

    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in { animation: fade-in 0.5s ease-out; }
    </style>
</x-app-layout>
