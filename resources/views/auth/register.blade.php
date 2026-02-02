<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - POS AI System</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        gray: {
                            900: '#0f172a',
                            800: '#1e293b',
                            700: '#334155',
                            600: '#475569',
                            500: '#64748b',
                            400: '#94a3b8',
                            300: '#cbd5e1',
                            200: '#e2e8f0',
                            100: '#f1f5f9',
                            50: '#f8fafc',
                        },
                        purple: {
                            600: '#8b5cf6',
                            700: '#7c3aed',
                        },
                        pink: {
                            600: '#ec4899',
                        },
                        blue: {
                            500: '#3b82f6',
                        },
                        emerald: {
                            500: '#10b981',
                            600: '#059669',
                        }
                    },
                    fontFamily: {
                        sans: ['Figtree', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    
    <!-- Atom Animation Styles -->
    <style>
        .atom-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }
        
        .atom {
            position: absolute;
            border-radius: 50%;
            opacity: 0.4;
            filter: blur(40px);
            animation: float 20s infinite linear;
        }
        
        .atom-1 {
            width: 400px;
            height: 400px;
            background: rgba(99, 102, 241, 0.4);
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .atom-2 {
            width: 300px;
            height: 300px;
            background: rgba(139, 92, 246, 0.4);
            bottom: 20%;
            right: 15%;
            animation-delay: -5s;
            animation-duration: 25s;
        }

        .atom-3 {
            width: 350px;
            height: 350px;
            background: rgba(236, 72, 153, 0.4);
            top: 40%;
            right: 25%;
            animation-delay: -10s;
            animation-duration: 30s;
        }

        .atom-4 {
            width: 250px;
            height: 250px;
            background: rgba(16, 185, 129, 0.4);
            bottom: 30%;
            left: 20%;
            animation-delay: -15s;
            animation-duration: 22s;
        }
        
        @keyframes float {
            0% {
                transform: translate(0, 0) rotate(0deg);
            }
            25% {
                transform: translate(50px, 50px) rotate(90deg);
            }
            50% {
                transform: translate(0, 100px) rotate(180deg);
            }
            75% {
                transform: translate(-50px, 50px) rotate(270deg);
            }
            100% {
                transform: translate(0, 0) rotate(360deg);
            }
        }
        
        .particle {
            position: absolute;
            width: 6px;
            height: 6px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            animation: particle-float 15s infinite linear;
        }
        
        @keyframes particle-float {
            0%, 100% {
                transform: translate(0, 0);
                opacity: 0.3;
            }
            50% {
                transform: translate(100px, -100px);
                opacity: 0.1;
            }
        }
        
        .glass-card {
            background: rgba(30, 41, 59, 0.4);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(100, 116, 139, 0.2);
        }
    </style>
</head>
<body class="bg-gray-900 text-white font-sans antialiased">
    <!-- Moving Atom Background -->
    <div class="atom-container">
        <div class="atom atom-1"></div>
        <div class="atom atom-2"></div>
        <div class="atom atom-3"></div>
        <div class="atom atom-4"></div>
        
        <!-- Particles -->
        @for ($i = 0; $i < 20; $i++)
            <div class="particle" style="
                top: {{ rand(0, 100) }}%;
                left: {{ rand(0, 100) }}%;
                animation-delay: -{{ $i * 0.5 }}s;
                animation-duration: {{ rand(10, 20) }}s;
            "></div>
        @endfor
    </div>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4">
        <div class="w-full max-w-md">
            <!-- Logo Header -->
            <div class="text-center mb-8">
                <!-- Triangle Logo -->
                <div class="flex justify-center mb-4">
                    <div class="w-16 h-16">
                        <svg viewBox="0 0 100 100" class="w-full h-full">
                            <polygon 
                                points="50,15 85,75 15,75" 
                                fill="none" 
                                stroke="url(#gradient)" 
                                stroke-width="3"
                            />
                            <defs>
                                <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" style="stop-color:#6366f1;stop-opacity:1" />
                                    <stop offset="100%" style="stop-color:#ec4899;stop-opacity:1" />
                                </linearGradient>
                            </defs>
                        </svg>
                    </div>
                </div>
                
                <h1 class="text-2xl font-bold text-white mb-1">
                    @php
                        $role = session('role', 'cashier');
                        echo ucfirst($role) . ' Registration';
                    @endphp
                </h1>
                <p class="text-gray-400 text-sm">
                    Complete your registration as a 
                    <span class="font-semibold text-purple-400">
                        {{ ucfirst(session('role', 'cashier')) }}
                    </span>
                </p>
            </div>

            @if(!session()->has('role'))
                <div class="glass-card rounded-2xl p-6 text-center">
                    <p class="text-gray-300 mb-4">Please select a role first</p>
                    <a href="{{ route('select-role') }}" 
                       class="inline-block px-6 py-2 bg-purple-600 hover:bg-purple-700 rounded-lg transition">
                        Select Role
                    </a>
                </div>
            @else
                <div class="glass-card rounded-2xl shadow-2xl shadow-black/20 p-8">
                    <form method="POST" action="{{ route('register') }}" class="space-y-5">
                        @csrf
                        <input type="hidden" name="role" value="{{ session('role') }}">

                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-300 mb-2">
                                Full Name
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input id="name" 
                                       type="text" 
                                       name="name" 
                                       value="{{ old('name') }}" 
                                       required 
                                       autofocus 
                                       autocomplete="name"
                                       class="w-full pl-10 pr-4 py-3 bg-gray-800/60 border border-gray-700 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500/50 focus:border-purple-500/30 transition-all duration-200"
                                       placeholder="John Doe">
                            </div>
                            @error('name')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-300 mb-2">
                                Email Address
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                    </svg>
                                </div>
                                <input id="email" 
                                       type="email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       required 
                                       autocomplete="email"
                                       class="w-full pl-10 pr-4 py-3 bg-gray-800/60 border border-gray-700 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500/50 focus:border-purple-500/30 transition-all duration-200"
                                       placeholder="you@example.com">
                            </div>
                            @error('email')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-300 mb-2">
                                Password
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <input id="password" 
                                       type="password" 
                                       name="password" 
                                       required 
                                       autocomplete="new-password"
                                       class="w-full pl-10 pr-4 py-3 bg-gray-800/60 border border-gray-700 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500/50 focus:border-purple-500/30 transition-all duration-200"
                                       placeholder="••••••••">
                            </div>
                            @error('password')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">
                                Confirm Password
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <input id="password_confirmation" 
                                       type="password" 
                                       name="password_confirmation" 
                                       required 
                                       autocomplete="new-password"
                                       class="w-full pl-10 pr-4 py-3 bg-gray-800/60 border border-gray-700 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500/50 focus:border-purple-500/30 transition-all duration-200"
                                       placeholder="••••••••">
                            </div>
                            @error('password_confirmation')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Role Info -->
                        <div class="p-4 bg-gray-800/30 rounded-xl border border-gray-700">
                            <div class="flex items-center">
                                @php
                                    $role = session('role', 'cashier');
                                    $iconColor = $role == 'cashier' ? 'blue' : 'emerald';
                                    $iconBg = $role == 'cashier' ? 'bg-blue-500/20' : 'bg-emerald-500/20';
                                    $iconText = $role == 'cashier' ? 'text-blue-400' : 'text-emerald-400';
                                @endphp
                                
                                <div class="mr-3 p-2 {{ $iconBg }} rounded-lg">
                                    @if($role == 'cashier')
                                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                        </svg>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-white">
                                        Registering as {{ ucfirst($role) }}
                                    </p>
                                    <p class="text-xs text-gray-400 mt-1">
                                        {{ $role == 'cashier' 
                                            ? 'You will be able to process transactions and manage sales' 
                                            : 'You will have access to reports, inventory, and staff management' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Register Button -->
                        <button type="submit" 
                                class="w-full py-3 px-4 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold rounded-xl hover:from-purple-700 hover:to-pink-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-gray-900 transition-all duration-300 transform hover:-translate-y-0.5 shadow-lg hover:shadow-purple-500/25">
                            Complete Registration
                        </button>

                        <!-- Back Link -->
                        <div class="text-center">
                            <a href="{{ route('select-role') }}" 
                               class="inline-flex items-center text-sm text-gray-400 hover:text-white transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Choose different role
                            </a>
                        </div>
                    </form>
                </div>
            @endif

            <!-- Footer -->
            <div class="mt-8 pt-6 border-t border-gray-800/50">
                <p class="text-center text-gray-500 text-sm">
                    By registering, you agree to our Terms of Service and Privacy Policy
                </p>
            </div>
        </div>
    </div>

    <script>
        // Add interactive particles on mouse move
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.querySelector('.atom-container');
            
            document.addEventListener('mousemove', function(e) {
                const particles = document.querySelectorAll('.particle');
                
                particles.forEach(particle => {
                    const x = (e.clientX / window.innerWidth - 0.5) * 20;
                    const y = (e.clientY / window.innerHeight - 0.5) * 20;
                    
                    particle.style.transform = `translate(${x}px, ${y}px)`;
                });
            });
        });
    </script>
</body>
</html>