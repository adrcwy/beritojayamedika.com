<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-gradient-to-br from-purple-600 to-purple-800 rounded-xl flex items-center justify-center shadow-lg">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="font-extrabold text-2xl text-gray-800 leading-tight">
                        Client Feedback Management
                    </h2>
                    <p class="text-sm text-gray-500 mt-1">Manage client testimonials and feedback</p>
                </div>
            </div>
            
            <a href="{{ route('feedbackclient.create') }}" 
               class="group inline-flex items-center gap-2 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                <svg class="w-5 h-5 transform group-hover:rotate-90 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span>Add New Feedback</span>
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-gray-50 via-purple-50/20 to-gray-50">
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

            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border-2 border-gray-100">
                
                <div class="bg-gradient-to-r from-purple-600 to-purple-700 px-8 py-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-white">Feedback List</h3>
                                <p class="text-purple-100 text-sm">Total: {{ $feedbacks->count() }} feedbacks</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Company Info</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Feedback</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Rating</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($feedbacks as $feedback)
                            <tr class="hover:bg-purple-50/50 transition-colors duration-200 group">
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        @if($feedback->client_photo)
                                            <img src="{{ $feedback->client_photo }}" alt="{{ $feedback->client_company }}" class="w-12 h-12 rounded-full object-cover border-2 border-purple-200">
                                        @else
                                            <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                                                <span class="text-purple-600 font-bold text-lg">{{ substr($feedback->client_company, 0, 1) }}</span>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="text-xs text-purple-600 font-medium">{{ $feedback->client_company }}</div>
                                        </div>
                                    </div>
                                </td>
                                
                                <td class="px-6 py-5 max-w-md">
                                    <p class="text-sm text-gray-600 line-clamp-2">{{ $feedback->feedback }}</p>
                                </td>
                                
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="flex items-center gap-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-5 h-5 {{ $i <= $feedback->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        @endfor
                                    </div>
                                </td>
                                
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('feedbackclient.edit', $feedback->id) }}" 
                                           class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-50 to-blue-100 hover:from-blue-600 hover:to-blue-700 text-blue-700 hover:text-white font-semibold px-4 py-2 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-sm hover:shadow-md">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            <span class="text-sm">Edit</span>
                                        </a>
                                        
                                        <form action="{{ route('feedbackclient.destroy', $feedback->id) }}" 
                                              method="POST" 
                                              class="inline-block" 
                                              onsubmit="return confirm('Are you sure you want to delete this feedback?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="inline-flex items-center gap-2 bg-gradient-to-r from-red-50 to-red-100 hover:from-red-600 hover:to-red-700 text-red-700 hover:text-white font-semibold px-4 py-2 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-sm hover:shadow-md">
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
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                                            </svg>
                                        </div>
                                        <h3 class="text-xl font-bold text-gray-900 mb-2">No Feedback Yet</h3>
                                        <p class="text-gray-500 mb-6">Start by adding your first client feedback.</p>
                                        <a href="{{ route('feedbackclient.create') }}" 
                                           class="inline-flex items-center gap-2 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                            </svg>
                                            <span>Add Your First Feedback</span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
