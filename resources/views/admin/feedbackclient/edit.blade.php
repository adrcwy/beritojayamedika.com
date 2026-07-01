<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('feedbackclient.index') }}" 
               class="w-10 h-10 bg-gray-100 hover:bg-gray-200 rounded-xl flex items-center justify-center transition-colors group">
                <svg class="w-5 h-5 text-gray-600 group-hover:text-gray-900 transform group-hover:-translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div class="w-12 h-12 bg-gradient-to-br from-green-600 to-green-800 rounded-xl flex items-center justify-center shadow-lg">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5"/>
                </svg>
            </div>
            <div>
                <h2 class="font-extrabold text-2xl text-gray-800 leading-tight">
                    Edit Feedback
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-gray-50 via-green-50/20 to-gray-50">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border-2 border-gray-100">

                <div class="bg-gradient-to-r from-green-600 to-green-700 px-8 py-6">
                    <h3 class="text-xl font-bold text-white">Update Feedback</h3>
                    <p class="text-green-100 text-sm">Modify feedback details</p>
                </div>

                <form action="{{ route('feedbackclient.update', $feedbackclient->id) }}" method="POST" enctype="multipart/form-data" class="p-8">
                    @csrf
                    @method('PUT')

                    <!-- Company -->
                    <div class="mb-6">
                        <label for="client_company" class="flex items-center gap-2 text-sm font-bold text-gray-700 mb-2">
                            Company/Institution <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="client_company" 
                               id="client_company" 
                               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-4 focus:ring-green-100 transition-all duration-300" 
                               value="{{ old('client_company', $feedbackclient->client_company) }}"
                               required>
                        @error('client_company')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    @if($feedbackclient->client_photo)
                        <div class="mb-4">
                            <label class="flex items-center gap-2 text-sm font-bold text-gray-700 mb-2">Current Photo</label>
                            <img src="{{ $feedbackclient->client_photo }}" class="w-32 h-32 rounded-xl object-cover border-2 border-gray-200">
                        </div>
                    @endif

                    <!-- Change Photo -->
                    <div class="mb-6">
                        <label for="client_photo" class="flex items-center gap-2 text-sm font-bold text-gray-700 mb-2">
                            Change Photo (optional)
                        </label>
                <input type="text" 
                    name="client_photo" 
                    id="client_photo"
                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-4 focus:ring-green-100 transition-all duration-300"
                    placeholder="https://example.com/photo.jpg"
                    value="{{ old('client_photo', $feedbackclient->client_photo) }}">
                        @error('client_photo')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Feedback -->
                    <div class="mb-6">
                        <label for="feedback" class="flex items-center gap-2 text-sm font-bold text-gray-700 mb-2">
                            Feedback/Testimonial <span class="text-red-500">*</span>
                        </label>
                        <textarea name="feedback" 
                                  id="feedback" 
                                  rows="5" 
                                  class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-4 focus:ring-green-100 transition-all duration-300" 
                                  required>{{ old('feedback', $feedbackclient->feedback) }}</textarea>
                        @error('feedback')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Rating -->
                        <div>
                            <label for="rating" class="flex items-center gap-2 text-sm font-bold text-gray-700 mb-2">
                                Rating <span class="text-red-500">*</span>
                            </label>
                            <select name="rating" 
                                    id="rating" 
                                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-4 focus:ring-green-100 transition-all duration-300"
                                    required>
                                @for($i = 5; $i >= 1; $i--)
                                    <option value="{{ $i }}" {{ old('rating', $feedbackclient->rating) == $i ? 'selected' : '' }}>
                                        {{ $i }} Star{{ $i > 1 ? 's' : '' }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-end gap-3 pt-6 border-t-2 border-gray-100">
                        <a href="{{ route('feedbackclient.index') }}" 
                           class="inline-flex items-center gap-2 px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl transition-all duration-300 transform hover:scale-105">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="group inline-flex items-center gap-2 px-8 py-3 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-bold rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            Update Feedback
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
