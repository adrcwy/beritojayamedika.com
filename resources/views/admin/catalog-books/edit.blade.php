<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('catalog-books.index') }}" class="flex h-10 w-10 items-center justify-center rounded-xl bg-gray-100 text-gray-600 hover:bg-gray-200">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <div>
                <h2 class="text-2xl font-extrabold text-gray-800">Edit Katalog</h2>
                <p class="mt-1 text-sm text-gray-500">{{ $catalogBook->title }}</p>
            </div>
        </div>
    </x-slot>

    <div class="bg-gradient-to-br from-gray-50 via-blue-50/20 to-gray-50 py-10">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            @if($errors->any())
                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-red-700">{{ $errors->first() }}</div>
            @endif

            <form action="{{ route('catalog-books.update', $catalogBook) }}" method="POST" enctype="multipart/form-data" class="rounded-3xl border border-gray-100 bg-white p-6 shadow-xl sm:p-8">
                @csrf
                @method('PUT')
                @include('admin.catalog-books.form', ['catalogBook' => $catalogBook])
            </form>
        </div>
    </div>
</x-app-layout>
