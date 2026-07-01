<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-extrabold text-gray-800">Catalog Book</h2>
                <p class="mt-1 text-sm text-gray-500">Upload buku katalog PDF A4 untuk dibaca pengunjung.</p>
            </div>
            <a href="{{ route('catalog-books.create') }}" class="inline-flex items-center justify-center rounded-xl bg-blue-700 px-5 py-3 text-sm font-bold text-white shadow-lg hover:bg-blue-800">
                Upload Catalog
            </a>
        </div>
    </x-slot>

    <div class="bg-gradient-to-br from-gray-50 via-blue-50/20 to-gray-50 py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 font-semibold text-green-800">{{ session('success') }}</div>
            @endif

            <div class="overflow-hidden rounded-3xl border border-gray-100 bg-white shadow-xl">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-600">Catalog</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-600">Tanggal</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-600">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-600">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($catalogBooks as $catalogBook)
                                <tr>
                                    <td class="px-6 py-5">
                                        <div class="font-extrabold text-gray-900">{{ $catalogBook->title }}</div>
                                        <a href="{{ \App\Support\MediaPath::url($catalogBook->pdf_path) }}" target="_blank" class="text-sm font-semibold text-blue-700 hover:text-blue-900">Buka PDF</a>
                                    </td>
                                    <td class="px-6 py-5 text-sm text-gray-600">{{ optional($catalogBook->published_at)->format('d M Y') ?? '-' }}</td>
                                    <td class="px-6 py-5">
                                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-bold {{ $catalogBook->is_active ? 'bg-green-50 text-green-700 ring-1 ring-green-200' : 'bg-gray-100 text-gray-600 ring-1 ring-gray-200' }}">
                                            {{ $catalogBook->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex flex-wrap gap-2">
                                            <a href="{{ route('catalog-books.edit', $catalogBook) }}" class="rounded-xl bg-blue-50 px-4 py-2 text-sm font-bold text-blue-700 hover:bg-blue-100">Edit</a>
                                            <form action="{{ route('catalog-books.destroy', $catalogBook) }}" method="POST" onsubmit="return confirm('Hapus catalog book ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="rounded-xl bg-red-50 px-4 py-2 text-sm font-bold text-red-700 hover:bg-red-100">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-14 text-center text-gray-500">Belum ada catalog book.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($catalogBooks->hasPages())
                    <div class="border-t border-blue-100 bg-white p-5">
                        {{ $catalogBooks->links('vendor.pagination.berito') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
