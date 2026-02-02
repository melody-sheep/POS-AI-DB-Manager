<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'POS AI System') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
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
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-900">
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
                {{ $slot }}
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