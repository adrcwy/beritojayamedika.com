<nav x-data="{ open: false, scrolled: false }" 
     @scroll.window="scrolled = window.pageYOffset > 20"
     :class="scrolled ? 'shadow-xl bg-white/95 backdrop-blur-xl' : 'bg-white shadow-md'"
     class="border-b border-gray-100 sticky top-0 z-50 transition-all duration-300">
    
    <!-- Primary Navigation Menu -->
    <div class="w-full px-4 sm:px-6 lg:px-10 2xl:px-12">
        <div class="flex h-20 items-center justify-between gap-6">
            <div class="flex min-w-0 flex-1 items-center gap-8">
                
                <!-- Logo Section with Enhanced Design -->
                <div class="shrink-0 flex items-center group">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 transition-all duration-300 hover:scale-105">
                        <!-- Logo Container -->
                        <div class="relative">
                            <div class="absolute inset-0 bg-gradient-to-br from-blue-600 to-blue-800 rounded-xl blur-lg opacity-0 group-hover:opacity-50 transition-opacity duration-300"></div>
                            <div class="relative w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-800 rounded-xl flex items-center justify-center shadow-lg transform group-hover:rotate-6 transition-transform duration-300">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                        </div>
                        <!-- Text -->
                        <div class="hidden md:block">
                            <h1 class="text-lg font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-900 to-blue-700">
                                BJM Admin
                            </h1>
                            <p class="text-xs text-gray-500 font-semibold">Management Panel</p>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links with Icons -->
                <div class="hidden min-w-0 flex-1 justify-center gap-1 overflow-x-auto sm:-my-px sm:flex xl:gap-2">
                    <a href="{{ route('dashboard') }}" 
                       class="group inline-flex items-center gap-2 px-4 py-2 border-b-2 {{ request()->routeIs('dashboard') ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-600 hover:text-blue-600 hover:border-blue-300' }} text-sm font-bold leading-5 focus:outline-none transition-all duration-300">
                        <svg class="w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-blue-600' : 'text-gray-400 group-hover:text-blue-600' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('products.index') }}" 
                       class="group inline-flex items-center gap-2 px-4 py-2 border-b-2 {{ request()->routeIs('products.*') ? 'border-red-600 text-red-600' : 'border-transparent text-gray-600 hover:text-red-600 hover:border-red-300' }} text-sm font-bold leading-5 focus:outline-none transition-all duration-300">
                        <svg class="w-5 h-5 {{ request()->routeIs('products.*') ? 'text-red-600' : 'text-gray-400 group-hover:text-red-600' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        <span>Products</span>
                    </a>

                    <a href="{{ route('catalog-books.index') }}" 
                       class="group inline-flex items-center gap-2 px-4 py-2 border-b-2 {{ request()->routeIs('catalog-books.*') ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-600 hover:text-blue-600 hover:border-blue-300' }} text-sm font-bold leading-5 focus:outline-none transition-all duration-300">
                        <svg class="w-5 h-5 {{ request()->routeIs('catalog-books.*') ? 'text-blue-600' : 'text-gray-400 group-hover:text-blue-600' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5S19.832 5.477 21 6.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253"/>
                        </svg>
                        <span>Catalog Book</span>
                    </a>

                    <a href="{{ route('categories.index') }}" 
                       class="group inline-flex items-center gap-2 px-4 py-2 border-b-2 {{ request()->routeIs('categories.*') ? 'border-green-600 text-green-600' : 'border-transparent text-gray-600 hover:text-green-600 hover:border-green-300' }} text-sm font-bold leading-5 focus:outline-none transition-all duration-300">
                        <svg class="w-5 h-5 {{ request()->routeIs('categories.*') ? 'text-green-600' : 'text-gray-400 group-hover:text-green-600' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        <span>Categories</span>
                    </a>

                    <a href="{{ route('articles.index') }}" 
                       class="group inline-flex items-center gap-2 px-4 py-2 border-b-2 {{ request()->routeIs('articles.*') ? 'border-purple-600 text-purple-600' : 'border-transparent text-gray-600 hover:text-purple-600 hover:border-purple-300' }} text-sm font-bold leading-5 focus:outline-none transition-all duration-300">
                        <svg class="w-5 h-5 {{ request()->routeIs('articles.*') ? 'text-purple-600' : 'text-gray-400 group-hover:text-purple-600' }} transition-colors" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                        </svg>
                        <span>Articles</span>
                    </a>

                <a href="{{ route('admin.feedback.index') }}"
                class="group inline-flex items-center gap-2 px-4 py-2 border-b-2 {{ request()->routeIs('admin.feedback.*') ? 'border-yellow-600 text-yellow-600' : 'border-transparent text-gray-600 hover:text-yellow-600 hover:border-yellow-300' }} text-sm font-bold leading-5 transition-all duration-300">
                    <svg class="w-5 h-5 {{ request()->routeIs('admin.feedback.*') ? 'text-yellow-600' : 'text-gray-400 group-hover:text-yellow-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 10h.01M12 10h.01M16 10h.01M9 16h6m2 5l-4-4H8a4 4 0 01-4-4V7a4 4 0 014-4h8a4 4 0 014 4v6a4 4 0 01-4 4h-1l-4 4" />
                    </svg>
                    <span>Kritik & Saran</span>
                </a>

                <a href="{{ route('feedbackclient.index') }}"
                class="group inline-flex items-center gap-2 px-4 py-2 border-b-2 {{ request()->routeIs('feedbackclient.*') ? 'border-orange-600 text-orange-600' : 'border-transparent text-gray-600 hover:text-orange-600 hover:border-orange-300' }} text-sm font-bold leading-5 transition-all duration-300">
                    <svg class="w-5 h-5 {{ request()->routeIs('feedbackclient.*') ? 'text-orange-600' : 'text-gray-400 group-hover:text-orange-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 8h10M7 12h6m-3 8a9 9 0 110-18 9 9 0 010 18z" />
                    </svg>
                    <span>Feedback Klien</span>
                </a>

                </div>
            </div>

            <!-- Right Side - Settings & Notifications -->
            <div class="hidden shrink-0 sm:flex sm:items-center sm:gap-4">
                
                <!-- Quick Actions Button -->
                <!-- <a href="{{ route('home') }}" 
                   target="_blank"
                   class="group inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-50 to-blue-100 hover:from-blue-100 hover:to-blue-200 text-blue-700 font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 shadow-sm hover:shadow-md">
                    <svg class="w-4 h-4 transform group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    <span class="text-sm">View Site</span>
                </a> -->

                <!-- User Dropdown -->
                <x-dropdown align="right" width="56">
                    <x-slot name="trigger">
                        <button class="group inline-flex items-center gap-3 px-4 py-2 border-2 border-gray-200 hover:border-blue-400 text-sm font-semibold rounded-xl text-gray-700 bg-white hover:bg-blue-50 focus:outline-none transition-all duration-300 transform hover:scale-105 shadow-sm hover:shadow-md">
                            <!-- Avatar -->
                            <div class="w-9 h-9 bg-gradient-to-br from-blue-600 to-blue-800 rounded-lg flex items-center justify-center text-white font-bold shadow-md">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            
                            <div class="hidden lg:block text-left">
                                <div class="text-sm font-bold text-gray-900">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-gray-500">Administrator</div>
                            </div>

                            <svg class="w-4 h-4 text-gray-400 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- User Info Header -->
                        <div class="px-4 py-3 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-blue-100">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-800 rounded-xl flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="font-bold text-gray-900">{{ Auth::user()->name }}</div>
                                    <div class="text-sm text-gray-600">{{ Auth::user()->email }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Menu Items -->
                        <div class="py-2">
                            <!-- <a href="{{ route('profile.edit') }}" 
                               class="group flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-colors duration-200">
                                <div class="w-8 h-8 bg-gray-100 group-hover:bg-blue-100 rounded-lg flex items-center justify-center transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold">Profile Settings</div>
                                    <div class="text-xs text-gray-500">Update your information</div>
                                </div>
                            </a> -->

                            <a href="{{ route('dashboard') }}" 
                               class="group flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-colors duration-200">
                                <div class="w-8 h-8 bg-gray-100 group-hover:bg-blue-100 rounded-lg flex items-center justify-center transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold">Dashboard</div>
                                    <div class="text-xs text-gray-500">View statistics</div>
                                </div>
                            </a>

                            <a href="{{ route('home') }}" 
                               target="_blank"
                               class="group flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-colors duration-200">
                                <div class="w-8 h-8 bg-gray-100 group-hover:bg-blue-100 rounded-lg flex items-center justify-center transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold">View Website</div>
                                    <div class="text-xs text-gray-500">Open in new tab</div>
                                </div>
                            </a>
                        </div>

                        <!-- Logout Section -->
                        <div class="border-t border-gray-100">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="group w-full flex items-center gap-3 px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                    <div class="w-8 h-8 bg-red-50 group-hover:bg-red-100 rounded-lg flex items-center justify-center transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-left">Sign Out</div>
                                        <div class="text-xs text-red-500 text-left">Logout from account</div>
                                    </div>
                                </button>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Mobile Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" 
                        class="inline-flex items-center justify-center p-2 rounded-xl text-gray-600 hover:text-blue-600 hover:bg-blue-50 focus:outline-none transition-all duration-300">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-gray-100 bg-gradient-to-b from-white to-gray-50">
        
        <!-- Navigation Links -->
        <div class="pt-2 pb-3 space-y-1 px-2">
            <a href="{{ route('dashboard') }}" 
               class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700 border-l-4 border-blue-600' : 'text-gray-600 hover:bg-gray-100 border-l-4 border-transparent' }} text-sm font-bold rounded-r-xl transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('products.index') }}" 
               class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('products.*') ? 'bg-red-50 text-red-700 border-l-4 border-red-600' : 'text-gray-600 hover:bg-gray-100 border-l-4 border-transparent' }} text-sm font-bold rounded-r-xl transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                <span>Products</span>
            </a>

            <a href="{{ route('catalog-books.index') }}" 
               class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('catalog-books.*') ? 'bg-blue-50 text-blue-700 border-l-4 border-blue-600' : 'text-gray-600 hover:bg-gray-100 border-l-4 border-transparent' }} text-sm font-bold rounded-r-xl transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5S19.832 5.477 21 6.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253"/>
                </svg>
                <span>Catalog Book</span>
            </a>

            <a href="{{ route('categories.index') }}" 
               class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('categories.*') ? 'bg-green-50 text-green-700 border-l-4 border-green-600' : 'text-gray-600 hover:bg-gray-100 border-l-4 border-transparent' }} text-sm font-bold rounded-r-xl transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
                <span>Categories</span>
            </a>

            <a href="{{ route('articles.index') }}" 
               class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('articles.*') ? 'bg-purple-50 text-purple-700 border-l-4 border-purple-600' : 'text-gray-600 hover:bg-gray-100 border-l-4 border-transparent' }} text-sm font-bold rounded-r-xl transition-all duration-200">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                </svg>
                <span>Articles</span>
            </a>

            <a href="{{ route('admin.feedback.index') }}" 
               class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('articles.*') ? 'bg-purple-50 text-purple-700 border-l-4 border-purple-600' : 'text-gray-600 hover:bg-gray-100 border-l-4 border-transparent' }} text-sm font-bold rounded-r-xl transition-all duration-200">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                </svg>
                <span>Kritik & Saran</span>
            </a>

            <a href="{{ route('articles.index') }}" 
               class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('articles.*') ? 'bg-purple-50 text-purple-700 border-l-4 border-purple-600' : 'text-gray-600 hover:bg-gray-100 border-l-4 border-transparent' }} text-sm font-bold rounded-r-xl transition-all duration-200">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                </svg>
                <span>Feedback Klien</span>
            </a>

            <a href="{{ route('home') }}" 
               target="_blank"
               class="flex items-center gap-3 px-4 py-3 text-blue-700 bg-blue-50 border-l-4 border-blue-600 text-sm font-bold rounded-r-xl transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                <span>View Website</span>
            </a>
        </div>

        <!-- User Info & Settings -->
        <div class="pt-4 pb-3 border-t border-gray-200 px-2">
            <!-- User Card -->
            <div class="px-4 py-3 bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl mb-3">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-800 rounded-xl flex items-center justify-center text-white font-bold text-lg shadow-lg">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <div class="font-bold text-gray-900">{{ Auth::user()->name }}</div>
                        <div class="text-sm text-gray-600">{{ Auth::user()->email }}</div>
                    </div>
                </div>
            </div>

            <!-- Settings Links -->
            <div class="space-y-1">
                <a href="{{ route('profile.edit') }}"
                   class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-100 border-l-4 border-transparent hover:border-yellow-600 text-sm font-bold rounded-r-xl transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span>Profile Settings</span>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="w-full flex items-center gap-3 px-4 py-3 text-red-600 hover:bg-red-50 border-l-4 border-transparent hover:border-red-600 text-sm font-bold rounded-r-xl transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span>Sign Out</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
