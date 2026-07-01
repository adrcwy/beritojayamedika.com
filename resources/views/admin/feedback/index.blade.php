<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-gradient-to-br from-purple-600 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-comments text-white text-xl"></i>
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 10h.01M12 10h.01M16 10h.01M9 16h6m2 5l-4-4H8a4 4 0 01-4-4V7a4 4 0 014-4h8a4 4 0 014 4v6a4 4 0 01-4 4h-1l-4 4" />
                </svg>
                </div>
                <div>
                    <h2 class="font-extrabold text-2xl text-gray-800 leading-tight">
                        Kritik & Saran
                    </h2>
                    <p class="text-sm text-gray-500 mt-1">Kelola feedback dari pelanggan</p>
                </div>
            </div>

            @if($unreadCount > 0)
                <span class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white font-bold rounded-xl shadow-md">
                    <i class="fas fa-bell mr-2"></i> {{ $unreadCount }} Belum Dibaca
                </span>
            @endif
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-gray-50 via-blue-50/20 to-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="mb-6 bg-gradient-to-r from-green-50 to-green-100 border-l-4 border-green-600 rounded-xl shadow-lg overflow-hidden transform animate-fade-in">
                    <div class="p-5 flex items-center gap-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-green-600 rounded-xl flex items-center justify-center shadow-lg">
                                <i class="fas fa-check text-white text-xl"></i>
                                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 10h.01M12 10h.01M16 10h.01M9 16h6m2 5l-4-4H8a4 4 0 01-4-4V7a4 4 0 014-4h8a4 4 0 014 4v6a4 4 0 01-4 4h-1l-4 4" />
                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-green-900 font-bold text-lg">Berhasil!</h3>
                            <p class="text-green-700">{{ session('success') }}</p>
                        </div>
                        <button onclick="this.closest('div').parentElement.remove()" class="text-green-600 hover:text-green-900 transition-colors">
                            <i class="fas fa-times text-lg"></i>
                        </button>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-gradient-to-r from-red-50 to-red-100 border-l-4 border-red-600 rounded-xl shadow-lg overflow-hidden transform animate-fade-in">
                    <div class="p-5 flex items-center gap-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-red-600 rounded-xl flex items-center justify-center shadow-lg">
                                <i class="fas fa-exclamation text-white text-xl"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-red-900 font-bold text-lg">Error!</h3>
                            <p class="text-red-700">{{ session('error') }}</p>
                        </div>
                        <button onclick="this.closest('div').parentElement.remove()" class="text-red-600 hover:text-red-900 transition-colors">
                            <i class="fas fa-times text-lg"></i>
                        </button>
                    </div>
                </div>
            @endif

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white shadow-xl">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm font-medium mb-1">Total Feedback</p>
                            <h3 class="text-4xl font-bold">{{ $feedbacks->total() }}</h3>
                        </div>
                        <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-comments text-2xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-2xl p-6 text-white shadow-xl">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-red-100 text-sm font-medium mb-1">Belum Dibaca</p>
                            <h3 class="text-4xl font-bold">{{ $unreadCount }}</h3>
                        </div>
                        <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-envelope text-2xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white shadow-xl">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100 text-sm font-medium mb-1">Sudah Dibaca</p>
                            <h3 class="text-4xl font-bold">{{ $feedbacks->total() - $unreadCount }}</h3>
                        </div>
                        <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-check-circle text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Feedback List -->
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border-2 border-gray-100">
                <div class="bg-gradient-to-r from-purple-600 to-blue-600 px-8 py-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center">
                                <i class="fas fa-inbox text-white text-lg"></i>
                                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 10h.01M12 10h.01M16 10h.01M9 16h6m2 5l-4-4H8a4 4 0 01-4-4V7a4 4 0 014-4h8a4 4 0 014 4v6a4 4 0 01-4 4h-1l-4 4" />
                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-white">Daftar Feedback</h3>
                                <p class="text-purple-100 text-sm">Total: {{ $feedbacks->total() }} pesan</p>
                            </div>
                        </div>
                    </div>
                </div>

                @if($feedbacks->count() > 0)
                    <div class="divide-y divide-gray-200">
                        @foreach($feedbacks as $feedback)
                        <div class="p-6 hover:bg-blue-50/40 transition-colors group">
                            <div class="flex items-start justify-between">
                                <!-- Left: Info + Message -->
                                <div class="flex-1">
                                    <div class="flex items-center space-x-3 mb-3">
                                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500 to-blue-500 flex items-center justify-center text-white font-bold text-lg flex-shrink-0">
                                            {{ strtoupper(substr($feedback->sender_name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="flex items-center space-x-2">
                                                <h3 class="font-bold text-gray-900 text-lg">{{ $feedback->sender_name }}</h3>
                                                @if(!$feedback->is_read)
                                                    <span class="px-2 py-1 bg-gradient-to-r from-red-500 to-red-600 text-white text-xs font-semibold rounded-full animate-pulse">
                                                        Baru
                                                    </span>
                                                @endif
                                            </div>
                                            <p class="text-sm text-gray-500">
                                                <i class="far fa-clock mr-1"></i>
                                                {{ $feedback->created_at->format('d M Y, H:i') }} WIB
                                            </p>
                                        </div>
                                    </div>
                                    <div class="ml-15 pl-3 border-l-4 {{ $feedback->is_read ? 'border-gray-200' : 'border-blue-400' }}">
                                        <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $feedback->message }}</p>
                                    </div>
                                </div>

                                <!-- Right: Actions -->
                                <div class="flex flex-col space-y-3 ml-4">
                                    @if(!$feedback->is_read)
                                        <form action="{{ route('admin.feedback.read', $feedback->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="group/edit inline-flex items-center gap-2 bg-gradient-to-r from-green-50 to-green-100 hover:from-green-600 hover:to-green-700 text-green-700 hover:text-white font-semibold px-4 py-2 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-sm">
                                                <i class="fas fa-check mr-1"></i>
                                                <span class="text-sm">Tandai Dibaca</span>
                                            </button>
                                        </form>
                                    @else
                                        <span class="inline-flex items-center gap-2 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-600 font-semibold px-4 py-2 rounded-xl">
                                            <i class="fas fa-check-double mr-1"></i>
                                            <span class="text-sm">Dibaca</span>
                                        </span>
                                    @endif

                                    <form action="{{ route('admin.feedback.destroy', $feedback->id) }}" method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus feedback ini?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="group/delete inline-flex items-center gap-2 bg-gradient-to-r from-red-50 to-red-100 hover:from-red-600 hover:to-red-700 text-red-700 hover:text-white font-semibold px-4 py-2 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-sm">
                                            <i class="fas fa-trash mr-1"></i>
                                            <span class="text-sm">Hapus</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                        {{ $feedbacks->links() }}
                    </div>
                @else
                    <div class="p-16 text-center">
                        <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-inbox text-4xl text-gray-400"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Feedback</h3>
                        <p class="text-gray-500 mb-6">Feedback dari pelanggan akan muncul di sini.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-in {
            animation: fade-in 0.5s ease-out;
        }
    </style>
</x-app-layout>