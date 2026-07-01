<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('products.index') }}" 
               class="w-10 h-10 bg-gray-100 hover:bg-gray-200 rounded-xl flex items-center justify-center transition-colors group">
                <svg class="w-5 h-5 text-gray-600 group-hover:text-gray-900 transform group-hover:-translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-800 rounded-xl flex items-center justify-center shadow-lg">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </div>
            <div>
                <h2 class="font-extrabold text-2xl text-gray-800 leading-tight">
                    Edit Product
                </h2>
                <p class="text-sm text-gray-500 mt-1">Update product: <span class="font-semibold text-blue-600">{{ $product->name }}</span></p>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-gray-50 via-blue-50/20 to-gray-50">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border-2 border-gray-100">
                
                <!-- Card Header -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-8 py-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white">Product Information</h3>
                            <p class="text-blue-100 text-sm">Update product details</p>
                        </div>
                    </div>
                </div>

                <!-- Form Content -->
                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="p-8">
                    @csrf
                    @method('PUT')

                    <!-- Product Name -->
                    <div class="mb-6">
                        <label for="name" class="flex items-center gap-2 text-sm font-bold text-gray-700 mb-2">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            Product Name
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-300" 
                               value="{{ $product->name }}"
                               required>
                    </div>

                    <!-- Category -->
                    <div class="mb-6">
                        <label for="category_id" class="flex items-center gap-2 text-sm font-bold text-gray-700 mb-2">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            Category
                        </label>
                        <select name="category_id" 
                                id="category_id" 
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-4 focus:ring-green-100 transition-all duration-300">
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if($product->category_id == $category->id) selected @endif>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <label for="description" class="flex items-center gap-2 text-sm font-bold text-gray-700 mb-2">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                            </svg>
                            Description
                        </label>
                        <textarea name="description" 
                                  id="description" 
                                  rows="5" 
                                  placeholder="Enter detailed product description..."
                                  class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-purple-500 focus:ring-4 focus:ring-purple-100 transition-all duration-300">{{ $product->description }}</textarea>
                    </div>

                    <!-- Catalog Link - TAMBAHKAN INI -->
                    <div class="mb-6">
                        <label for="catalog_link" class="flex items-center gap-2 text-sm font-bold text-gray-700 mb-2">
                            <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                            </svg>
                            Link Catalog
                        </label>
                        <input type="url" 
                            name="catalog_link" 
                            id="catalog_link" 
                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all duration-300" 
                            placeholder="https://example.com/product-catalog.pdf"
                            value="{{ old('catalog_link', $product->catalog_link) }}">
                        <div class="mt-2 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                            <p class="text-xs text-gray-500">Isi URL INAPROC, lalu klik sync untuk refresh data dan gambar produk ini.</p>
                            @if($product->catalog_link)
                                <a href="{{ route('products.sync-inaproc.log', $product->id) }}" class="inline-flex items-center justify-center rounded-lg bg-green-50 px-3 py-2 text-xs font-bold text-green-700 hover:bg-green-100">
                                    Sync INAPROC
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="flex items-center gap-3 rounded-2xl border-2 border-green-100 bg-green-50/60 px-4 py-3">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300 text-green-600 focus:ring-green-500" @checked(old('is_active', $product->is_active))>
                            <span>
                                <span class="block text-sm font-bold text-gray-800">Produk Active</span>
                                <span class="block text-xs text-gray-500">Produk inactive tidak tampil di halaman publik.</span>
                            </span>
                        </label>
                    </div>

                    <!-- Product Image -->
                    <div class="mb-8">
                        <label for="image" class="flex items-center gap-2 text-sm font-bold text-gray-700 mb-2">
                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Product Image
                        </label>
                        
                        <!-- Current Image Preview -->
                        @if ($product->image)
                            <div class="mb-4 relative group">
                                <div class="relative w-full max-w-xs rounded-2xl overflow-hidden shadow-lg ring-4 ring-gray-200 group-hover:ring-blue-400 transition-all duration-300">
                                    <img src="{{ \App\Support\MediaPath::url($product->image, asset('image/logo.png')) }}" 
                                         alt="Current image" 
                                         class="w-full h-48 object-cover">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                                        <div class="p-4 text-white">
                                            <p class="font-semibold text-sm">Current Image</p>
                                            <p class="text-xs text-gray-200">Upload new to replace</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- File Input -->
                        <div class="relative">
                            <input type="file" 
                                   name="image" 
                                   id="image" 
                                   class="w-full px-4 py-3 rounded-xl border-2 border-dashed border-gray-300 hover:border-red-400 focus:border-red-500 focus:ring-4 focus:ring-red-100 transition-all duration-300
                                          file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold 
                                          file:bg-gradient-to-r file:from-red-50 file:to-red-100 file:text-red-700 
                                          hover:file:from-red-100 hover:file:to-red-200 file:transition-all file:cursor-pointer">
                        </div>
                        <p class="mt-2 text-xs text-gray-500">Leave empty to keep current image. Recommended: JPG, PNG or WebP (max 2MB)</p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-end gap-3 pt-6 border-t-2 border-gray-100">
                        <a href="{{ route('products.index') }}" 
                           class="inline-flex items-center gap-2 px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl transition-all duration-300 transform hover:scale-105">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Cancel
                        </a>
                        <button type="submit" 
                                class="group inline-flex items-center gap-2 px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5 transform group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Update Product
                        </button>
                    </div>
                </form>
                @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-xl">
                    <strong>Terjadi kesalahan:</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
