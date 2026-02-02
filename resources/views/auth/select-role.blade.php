<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Select Role - POS AI System</title>
    
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
        
        /* Glass effect */
        .glass-card {
            background: rgba(30, 41, 59, 0.4);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(100, 116, 139, 0.2);
        }
        
        /* Role Card Styles */
        .role-card {
            width: 100%;
            padding: 1.5rem;
            background: linear-gradient(135deg, rgba(30, 41, 59, 0.5), rgba(15, 23, 42, 0.3));
            backdrop-filter: blur(10px);
            border: 1px solid rgba(100, 116, 139, 0.3);
            border-radius: 1rem;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .role-card:hover {
            transform: translateY(-2px);
            border-color: rgba(139, 92, 246, 0.5);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
        }
        
        .role-icon {
            width: 4rem;
            height: 4rem;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            border: 1px solid rgba(100, 116, 139, 0.2);
        }
        
        .role-card:hover .role-icon {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.3);
        }
        
        .cashier-icon {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.2), rgba(99, 102, 241, 0.3));
            border-color: rgba(59, 130, 246, 0.3);
        }
        
        .manager-icon {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.2), rgba(5, 150, 105, 0.3));
            border-color: rgba(16, 185, 129, 0.3);
        }
        
        .cashier-card:hover {
            border-color: rgba(59, 130, 246, 0.5);
        }
        
        .manager-card:hover {
            border-color: rgba(16, 185, 129, 0.5);
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
            <!-- Logo -->
            <div class="flex justify-center mb-8">
                <div class="relative">
                    <!-- Triangle Logo -->
                    <div class="w-20 h-20">
                        <svg viewBox="0 0 100 100" class="w-full h-full">
                            <polygon 
                                points="50,10 90,80 10,80" 
                                fill="none" 
                                stroke="url(#gradient)" 
                                stroke-width="3"
                                class="animate-pulse"
                            />
                            <defs>
                                <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" style="stop-color:#6366f1;stop-opacity:1" />
                                    <stop offset="50%" style="stop-color:#8b5cf6;stop-opacity:1" />
                                    <stop offset="100%" style="stop-color:#ec4899;stop-opacity:1" />
                                </linearGradient>
                            </defs>
                            <text x="50" y="52" text-anchor="middle" dy=".3em" 
                                  class="text-sm font-bold fill-white">POS</text>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Title -->
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-white mb-2">Join Our Platform</h2>
                <p class="text-gray-400">Select your role to get started</p>
            </div>

            <!-- Role Selection Cards -->
            <div class="space-y-4">
                <!-- Cashier Card -->
                <form method="POST" action="{{ route('register.with-role') }}" class="w-full">
                    @csrf
                    <input type="hidden" name="role" value="cashier">
                    
                    <button type="submit" class="role-card cashier-card">
                        <div class="flex items-center">
                            <!-- Icon -->
                            <div class="mr-4">
                                <div class="role-icon cashier-icon">
                                    <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                            
                            <!-- Content -->
                            <div class="flex-1 text-left">
                                <h3 class="text-lg font-bold text-white mb-1">Cashier</h3>
                                <p class="text-gray-400 text-xs mb-2">
                                    Process transactions, manage sales, handle customer payments and generate receipts
                                </p>
                                <div class="flex items-center text-blue-400 font-medium text-sm">
                                    <span>Proceed as Cashier</span>
                                    <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" 
                                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </button>
                </form>

                <!-- Manager Card -->
                <form method="POST" action="{{ route('register.with-role') }}" class="w-full">
                    @csrf
                    <input type="hidden" name="role" value="manager">
                    
                    <button type="submit" class="role-card manager-card">
                        <div class="flex items-center">
                            <!-- Icon -->
                            <div class="mr-4">
                                <div class="role-icon manager-icon">
                                    <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                </div>
                            </div>
                            
                            <!-- Content -->
                            <div class="flex-1 text-left">
                                <h3 class="text-lg font-bold text-white mb-1">Manager</h3>
                                <p class="text-gray-400 text-xs mb-2">
                                    Monitor sales, manage inventory, generate reports, and oversee staff operations
                                </p>
                                <div class="flex items-center text-emerald-400 font-medium text-sm">
                                    <span>Proceed as Manager</span>
                                    <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" 
                                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </button>
                </form>
            </div>

            <!-- Footer -->
            <div class="mt-8 text-center">
                <p class="text-gray-500 text-sm">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="text-purple-400 hover:text-purple-300 font-medium transition-colors">
                        Sign in here
                    </a>
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
            
            // Add hover effects
            const roleCards = document.querySelectorAll('.role-card');
            roleCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</body>
</html>