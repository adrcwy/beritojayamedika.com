<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Admin Login - {{ config('app.name', 'PT. BERITO JAYA MEDIKA') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700&family=Poppins:wght@800&display=swap" rel="stylesheet">
        
        <link rel="icon" href="{{ asset('image/logo.png') }}" type="image/x-icon">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body {
                font-family: 'Manrope', sans-serif;
            }
            
            .font-poppins {
                font-family: 'Poppins', sans-serif;
            }
            
            /* Animated gradient background */
            @keyframes gradient-shift {
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }

            .animate-gradient {
                background-size: 200% 200%;
                animation: gradient-shift 15s ease infinite;
            }

            /* Floating animation */
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
            }

            .animate-float {
                animation: float 6s ease-in-out infinite;
            }

            /* Blob animations */
            @keyframes blob {
                0% { transform: translate(0px, 0px) scale(1); }
                33% { transform: translate(30px, -50px) scale(1.1); }
                66% { transform: translate(-20px, 20px) scale(0.9); }
                100% { transform: translate(0px, 0px) scale(1); }
            }

            .animate-blob {
                animation: blob 7s infinite;
            }

            .animation-delay-2000 {
                animation-delay: 2s;
            }

            .animation-delay-4000 {
                animation-delay: 4s;
            }
            
            /* Enhanced glass input */
            .glass-input {
                width: 100%;
                border-radius: 0.75rem;
                border: 2px solid rgba(255, 255, 255, 0.2);
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                padding: 1rem 1.25rem;
                color: white;
                font-weight: 500;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }
            
            .glass-input::placeholder {
                color: rgba(255, 255, 255, 0.5);
            }
            
            .glass-input:focus {
                outline: none;
                border-color: rgba(251, 191, 36, 0.8);
                background: rgba(255, 255, 255, 0.15);
                box-shadow: 0 0 0 4px rgba(251, 191, 36, 0.2), 0 8px 16px rgba(0, 0, 0, 0.2);
                transform: translateY(-2px);
            }

            /* Shimmer effect */
            @keyframes shimmer {
                0% { background-position: -1000px 0; }
                100% { background-position: 1000px 0; }
            }

            .shimmer {
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
                background-size: 1000px 100%;
                animation: shimmer 3s infinite;
            }
        </style>
    </head>
    <body class="antialiased">

        <div class="min-h-screen flex items-center justify-center p-4 relative overflow-hidden">
            
            <!-- Animated Background Image -->
            <img src="https://images.unsplash.com/photo-1551884170-09fb70a3a2ed?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" 
                 class="absolute inset-0 h-full w-full object-cover transform scale-105 transition-transform duration-[20s]" 
                 alt="Medical Technology Background">
            
            <!-- Animated Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-br from-blue-900/80 via-blue-800/70 to-purple-900/80 animate-gradient"></div>

            <!-- Decorative Blobs -->
            <div class="absolute top-0 left-0 w-96 h-96 bg-yellow-400/20 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob"></div>
            <div class="absolute top-0 right-0 w-96 h-96 bg-red-500/20 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-8 left-20 w-96 h-96 bg-blue-500/20 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-4000"></div>

            <!-- Login Card Container -->
            <div class="relative z-10 w-full max-w-md">
                
                <!-- Main Card -->
                <div class="relative p-8 md:p-10 bg-white/10 backdrop-blur-2xl border-2 border-white/20 shadow-2xl rounded-3xl transform hover:scale-[1.02] transition-transform duration-300">
                    
                    <!-- Shimmer Effect -->
                    <div class="absolute inset-0 shimmer rounded-3xl pointer-events-none"></div>
                    
                    <!-- Header -->
                    <div class="flex flex-col items-center mb-8 relative">
                        <!-- Logo Container -->
                        <div class="mb-6 relative animate-float">
                            <div class="absolute inset-0 bg-gradient-to-br from-yellow-400 to-red-500 rounded-2xl blur-xl opacity-50"></div>
                            <a href="{{ route('home') }}" class="relative block p-4 bg-white rounded-2xl shadow-xl transform hover:scale-110 transition-transform duration-300">
                                <img src="{{ asset('image/logo.png') }}" 
                                     alt="Logo PT. Berito Jaya Medika" 
                                     class="h-14 w-auto">
                            </a>
                        </div>
                        
                        <!-- Title with gradient -->
                        <div class="relative">
                            <div class="absolute inset-0 bg-gradient-to-r from-yellow-400 via-red-500 to-yellow-400 blur-lg opacity-50"></div>
                            <h1 class="relative font-poppins font-extrabold text-4xl text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 via-white to-yellow-400 drop-shadow-lg">
                                Admin Portal
                            </h1>
                        </div>
                        
                        <!-- Subtitle with icon -->
                        <div class="flex items-center gap-2 mt-3">
                            <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            <p class="text-blue-200 font-semibold">Secure Login System</p>
                        </div>
                    </div>

                    <!-- Status Message -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Login Form -->
                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf

                        <!-- Email Input -->
                        <div class="group">
                            <div class="flex items-center gap-2 mb-2">
                                <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                </svg>
                                <x-input-label for="email" value="Email Address" class="!text-white font-bold" />
                            </div>
                            <div class="relative">
                                <input id="email" 
                                       class="glass-input" 
                                       type="email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       required 
                                       autofocus 
                                       autocomplete="username" 
                                       placeholder="admin@beritojaya.com">
                                <div class="absolute right-4 top-1/2 -translate-y-1/2 text-white/50">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password Input -->
                        <div class="group">
                            <div class="flex items-center gap-2 mb-2">
                                <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                                <x-input-label for="password" value="Password" class="!text-white font-bold" />
                            </div>
                            <div class="relative">
                                <input id="password" 
                                       class="glass-input"
                                       type="password"
                                       name="password"
                                       required 
                                       autocomplete="current-password"
                                       placeholder="••••••••••••">
                                <div class="absolute right-4 top-1/2 -translate-y-1/2 text-white/50">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center justify-between">
                            <label for="remember_me" class="inline-flex items-center cursor-pointer group/remember">
                                <input id="remember_me" 
                                       type="checkbox" 
                                       class="rounded-lg border-2 border-white/30 bg-white/10 text-yellow-400 shadow-sm focus:ring-yellow-400 focus:ring-offset-0 focus:ring-2 w-5 h-5 cursor-pointer transition-all" 
                                       name="remember">
                                <span class="ms-3 text-sm font-semibold text-white group-hover/remember:text-yellow-400 transition-colors">Remember me</span>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-8">
                            <button type="submit" 
                                    class="group/btn relative w-full overflow-hidden">
                                <!-- Button background -->
                                <div class="absolute inset-0 bg-gradient-to-r from-red-600 via-red-500 to-red-600 rounded-xl"></div>
                                <div class="absolute inset-0 bg-gradient-to-r from-yellow-400 via-red-500 to-yellow-400 rounded-xl opacity-0 group-hover/btn:opacity-100 transition-opacity duration-500"></div>
                                
                                <!-- Button content -->
                                <div class="relative flex items-center justify-center gap-3 py-4 px-6">
                                    <svg class="w-5 h-5 text-white transform group-hover/btn:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                                    </svg>
                                    <span class="text-white font-bold text-lg">Sign In to Dashboard</span>
                                    <svg class="w-5 h-5 text-white transform group-hover/btn:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                    </svg>
                                </div>
                            </button>
                        </div>
                    </form>
                    
                    <!-- Back to Website Link -->
                    <div class="text-center mt-8 pt-6 border-t border-white/20">
                        <a href="{{ route('home') }}" 
                           class="group/back inline-flex items-center gap-2 text-sm font-semibold text-blue-200 hover:text-white transition-colors duration-300">
                            <svg class="w-5 h-5 transform group-hover/back:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            <span>Back to Main Website</span>
                        </a>
                    </div>

                </div>

                <!-- Security Badge -->
                <div class="mt-6 flex items-center justify-center gap-3 text-white/70 text-sm">
                    <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    <span class="font-semibold">Secured by SSL Encryption</span>
                </div>
            </div>
        </div>

        <script>
            // Add subtle parallax effect to background
            document.addEventListener('mousemove', (e) => {
                const moveX = (e.clientX - window.innerWidth / 2) * 0.01;
                const moveY = (e.clientY - window.innerHeight / 2) * 0.01;
                document.querySelector('img').style.transform = `scale(1.05) translate(${moveX}px, ${moveY}px)`;
            });
        </script>
    </body>
</html>
