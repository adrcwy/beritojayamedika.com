<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-800 rounded-xl flex items-center justify-center shadow-lg">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="font-extrabold text-2xl text-gray-800 leading-tight">
                        Admin Dashboard
                    </h2>
                    <p class="text-sm text-gray-500 mt-1">Manage your medical equipment business</p>
                </div>
            </div>
            
            <!-- Date & Time Badge -->
            <div class="hidden md:flex items-center gap-2 bg-gradient-to-r from-blue-50 to-blue-100 px-4 py-2 rounded-xl shadow-sm">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span class="text-sm font-semibold text-gray-700" id="current-date"></span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-gray-50 via-blue-50/30 to-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Welcome Card with Enhanced Design -->
            <div class="relative overflow-hidden bg-gradient-to-br from-blue-900 via-blue-800 to-blue-900 rounded-3xl shadow-2xl mb-8">
                <!-- Decorative Elements -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-yellow-400/20 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-red-500/20 rounded-full blur-3xl"></div>
                
                <div class="relative p-8 md:p-12">
                    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                        <div class="flex-1">
                            <div class="inline-flex items-center gap-2 bg-yellow-400/20 backdrop-blur-sm px-4 py-2 rounded-full mb-4">
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <span class="text-yellow-400 font-bold text-sm">Admin Panel</span>
                            </div>
                            
                            <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-3">
                                Welcome back, <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-yellow-200">{{ Auth::user()->name }}</span>!
                            </h2>
                            <p class="text-blue-200 text-lg max-w-2xl leading-relaxed">
                                Manage products, categories, articles, and monitor your PT. Berito Jaya Medika business operations from this centralized dashboard.
                            </p>
                        </div>
                        
                        <!-- Quick Stats -->
                        <div class="flex gap-4">
                            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20 shadow-lg hover:scale-105 transition-transform">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-green-600 rounded-xl flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-white/70 text-xs font-semibold">System Status</p>
                                        <p class="text-white font-bold text-lg">All Good</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Header -->
            <div class="flex items-center gap-3 mb-6">
                <div class="w-1 h-8 bg-gradient-to-b from-red-600 to-red-800 rounded-full"></div>
                <h3 class="text-2xl font-extrabold text-gray-900">Quick Actions</h3>
                <div class="flex-1 h-px bg-gradient-to-r from-gray-300 to-transparent"></div>
            </div>
            
            <!-- Enhanced Action Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Product Management Card -->
                <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl border-2 border-transparent hover:border-red-400 overflow-hidden transition-all duration-300 transform hover:-translate-y-2">
                    <!-- Background Gradient -->
                    <div class="absolute inset-0 bg-gradient-to-br from-red-50 to-red-100 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <div class="relative p-8">
                        <!-- Icon Container -->
                        <div class="mb-6 relative">
                            <div class="absolute inset-0 bg-red-600 blur-xl opacity-0 group-hover:opacity-50 transition-opacity duration-300"></div>
                            <div class="relative w-16 h-16 bg-gradient-to-br from-red-500 to-red-700 rounded-2xl flex items-center justify-center shadow-lg transform group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                            </div>
                        </div>
                        
                        <!-- Content -->
                        <h4 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-red-600 transition-colors">
                            Product Management
                        </h4>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Add, edit, or remove medical equipment products and marketplace links.
                        </p>
                        
                        <!-- Divider -->
                        <div class="h-1 w-12 bg-gradient-to-r from-red-600 to-red-400 rounded-full mb-6 group-hover:w-full transition-all duration-500"></div>
                        
                        <!-- Action Button -->
                        <a href="{{ route('products.index') }}" 
                           class="group/btn inline-flex items-center gap-2 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 transform group-hover:scale-105 shadow-lg hover:shadow-xl">
                            <span>Manage Products</span>
                            <svg class="w-5 h-5 transform group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                    </div>
                    
                    <!-- Corner Decoration -->
                    <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-red-400/20 to-transparent rounded-bl-3xl"></div>
                </div>

                <!-- Category Management Card -->
                <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl border-2 border-transparent hover:border-blue-400 overflow-hidden transition-all duration-300 transform hover:-translate-y-2">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-blue-100 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <div class="relative p-8">
                        <div class="mb-6 relative">
                            <div class="absolute inset-0 bg-blue-600 blur-xl opacity-0 group-hover:opacity-50 transition-opacity duration-300"></div>
                            <div class="relative w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl flex items-center justify-center shadow-lg transform group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                            </div>
                        </div>
                        
                        <h4 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors">
                            Category Management
                        </h4>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Organize and manage product categories for better navigation.
                        </p>
                        
                        <div class="h-1 w-12 bg-gradient-to-r from-blue-600 to-blue-400 rounded-full mb-6 group-hover:w-full transition-all duration-500"></div>
                        
                        <a href="{{ route('categories.index') }}" 
                           class="group/btn inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 transform group-hover:scale-105 shadow-lg hover:shadow-xl">
                            <span>Manage Categories</span>
                            <svg class="w-5 h-5 transform group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                    </div>
                    
                    <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-blue-400/20 to-transparent rounded-bl-3xl"></div>
                </div>

                <!-- Article Management Card -->
                <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl border-2 border-transparent hover:border-green-400 overflow-hidden transition-all duration-300 transform hover:-translate-y-2">
                    <div class="absolute inset-0 bg-gradient-to-br from-green-50 to-green-100 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <div class="relative p-8">
                        <div class="mb-6 relative">
                            <div class="absolute inset-0 bg-green-600 blur-xl opacity-0 group-hover:opacity-50 transition-opacity duration-300"></div>
                            <div class="relative w-16 h-16 bg-gradient-to-br from-green-500 to-green-700 rounded-2xl flex items-center justify-center shadow-lg transform group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                        
                        <h4 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-green-600 transition-colors">
                            Article Management
                        </h4>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Create, edit, and publish articles and company news updates.
                        </p>
                        
                        <div class="h-1 w-12 bg-gradient-to-r from-green-600 to-green-400 rounded-full mb-6 group-hover:w-full transition-all duration-500"></div>
                        
                        <a href="{{ route('articles.index') }}" 
                           class="group/btn inline-flex items-center gap-2 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 transform group-hover:scale-105 shadow-lg hover:shadow-xl">
                            <span>Manage Articles</span>
                            <svg class="w-5 h-5 transform group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                    </div>
                    
                    <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-green-400/20 to-transparent rounded-bl-3xl"></div>
                </div>

                <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl border-2 border-transparent hover:border-yellow-400 overflow-hidden transition-all duration-300 transform hover:-translate-y-2">
    <div class="absolute inset-0 bg-gradient-to-br from-yellow-50 to-yellow-100 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

    <div class="relative p-8">
        <div class="mb-6 relative">
            <div class="absolute inset-0 bg-yellow-600 blur-xl opacity-0 group-hover:opacity-50 transition-opacity duration-300"></div>
            <div class="relative w-16 h-16 bg-gradient-to-br from-yellow-500 to-yellow-700 rounded-2xl flex items-center justify-center shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 10h.01M12 10h.01M16 10h.01M9 16h6m2 5l-4-4H8a4 4 0 01-4-4V7a4 4 0 014-4h8a4 4 0 014 4v6a4 4 0 01-4 4h-1l-4 4" />
                </svg>
            </div>
        </div>

        <h4 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-yellow-600 transition-colors">
            Kritik & Saran
        </h4>
        <p class="text-gray-600 mb-6">Membaca kritik & saran.</p>

        <div class="h-1 w-12 bg-gradient-to-r from-yellow-600 to-yellow-400 rounded-full mb-6 group-hover:w-full transition-all duration-500"></div>

        <a href="{{ route('admin.feedback.index') }}"
           class="group/btn inline-flex items-center gap-2 bg-gradient-to-r from-yellow-600 to-yellow-700 hover:from-yellow-700 hover:to-yellow-800 text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 transform group-hover:scale-105 shadow-lg hover:shadow-xl">
            <span>Lihat Data</span>
        </a>
    </div>
</div>


                <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl border-2 border-transparent hover:border-orange-400 overflow-hidden transition-all duration-300 transform hover:-translate-y-2">
    <div class="absolute inset-0 bg-gradient-to-br from-amber-50 to-amber-100 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

    <div class="relative p-8">
        <div class="mb-6 relative">
            <div class="absolute inset-0 bg-amber-600 blur-xl opacity-0 group-hover:opacity-50 transition-opacity duration-300"></div>
            <div class="relative w-16 h-16 bg-gradient-to-br from-orange-500 to-orange-700 rounded-2xl flex items-center justify-center shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M7 8h10M7 12h6m-3 8a9 9 0 110-18 9 9 0 010 18z" />
                </svg>
            </div>
        </div>

        <h4 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-orange-600 transition-colors">
            Feedback Klien
        </h4>
        <p class="text-gray-600 mb-6">Feedback yang tampil di halaman publik.</p>

        <div class="h-1 w-12 bg-gradient-to-r from-orange-600 to-orange-400 rounded-full mb-6 group-hover:w-full transition-all duration-500"></div>

        <a href="{{ route('feedbackclient.index') }}"
           class="group/btn inline-flex items-center gap-2 bg-gradient-to-r from-yellow-600 to-yellow-700 hover:from-yellow-700 hover:to-yellow-800 text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 transform group-hover:scale-105 shadow-lg hover:shadow-xl">
            <span>Lihat Data</span>
        </a>
    </div>
</div>


                <!-- View Website Card -->
                <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl border-2 border-transparent hover:border-purple-400 overflow-hidden transition-all duration-300 transform hover:-translate-y-2">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-50 to-purple-100 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <div class="relative p-8">
                        <div class="mb-6 relative">
                            <div class="absolute inset-0 bg-purple-600 blur-xl opacity-0 group-hover:opacity-50 transition-opacity duration-300"></div>
                            <div class="relative w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-700 rounded-2xl flex items-center justify-center shadow-lg transform group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        
                        <h4 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-purple-600 transition-colors">
                            View Public Website
                        </h4>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Preview your live website and see how visitors experience it.
                        </p>
                        
                        <div class="h-1 w-12 bg-gradient-to-r from-purple-600 to-purple-400 rounded-full mb-6 group-hover:w-full transition-all duration-500"></div>
                        
                        <a href="{{ route('home') }}" 
                           target="_blank"
                           class="group/btn inline-flex items-center gap-2 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 transform group-hover:scale-105 shadow-lg hover:shadow-xl">
                            <span>Open Website</span>
                            <svg class="w-5 h-5 transform group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                        </a>
                    </div>
                    
                    <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-purple-400/20 to-transparent rounded-bl-3xl"></div>
                </div>

                <!-- Logout Card -->
                <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl border-2 border-transparent hover:border-gray-400 overflow-hidden transition-all duration-300 transform hover:-translate-y-2">
                    <div class="absolute inset-0 bg-gradient-to-br from-gray-50 to-gray-100 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <div class="relative p-8">
                        <div class="mb-6 relative">
                            <div class="absolute inset-0 bg-gray-600 blur-xl opacity-0 group-hover:opacity-50 transition-opacity duration-300"></div>
                            <div class="relative w-16 h-16 bg-gradient-to-br from-gray-500 to-gray-700 rounded-2xl flex items-center justify-center shadow-lg transform group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                            </div>
                        </div>
                        
                        <h4 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-gray-600 transition-colors">
                            Sign Out
                        </h4>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Safely logout from your admin session and secure your account.
                        </p>
                        
                        <div class="h-1 w-12 bg-gradient-to-r from-gray-600 to-gray-400 rounded-full mb-6 group-hover:w-full transition-all duration-500"></div>
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="group/btn w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 transform group-hover:scale-105 shadow-lg hover:shadow-xl">
                                <span>Logout Now</span>
                                <svg class="w-5 h-5 transform group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                    
                    <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-gray-400/20 to-transparent rounded-bl-3xl"></div>
                </div>

            </div>
        </div>
    </div>

    <script>
        // Display current date
        function updateDate() {
            const dateElement = document.getElementById('current-date');
            if (dateElement) {
                const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                const today = new Date();
                dateElement.textContent = today.toLocaleDateString('en-US', options);
            }
        }
        
        updateDate();
    </script>
</x-app-layout>