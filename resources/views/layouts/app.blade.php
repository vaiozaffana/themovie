<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movify - Cyberpunk Cinema</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Rajdhani:wght@300;500;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-900 font-rajdhani text-gray-300 antialiased">
    <nav class="fixed w-full z-50 bg-gray-900 bg-opacity-90 backdrop-blur-md border-b border-cyan-500/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex-shrink-0" x-data="neonText()" x-init="init()">
                    <a href="/" class="text-2xl font-orbitron font-bold">
                        <span class="text-cyan-400" x-ref="text">MOVI</span>
                        <span class="text-pink-500" x-ref="text2">FY</span>
                    </a>
                </div>

                <div class="block">
                    <div class="ml-4 flex items-center space-x-4">
                        <a href="{{ route('login') }}" class="px-4 py-2 rounded-md text-sm font-medium hover:text-cyan-400 transition-all duration-300"
                           x-data="{ glow: false }"
                           @mouseenter="glow = true"
                           @mouseleave="glow = false"
                           :class="glow ? 'shadow-lg shadow-cyan-500/20 text-cyan-400' : 'text-gray-300'">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-gradient-to-r from-cyan-500 to-pink-500 rounded-md text-sm font-medium text-white hover:shadow-lg hover:shadow-cyan-500/40 transition-all duration-300">
                            Register
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bg-gray-900 border-t border-pink-500/20 mt-20">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col items-center">
                <div class="flex space-x-6 mb-8">
                    <a href="#" class="text-gray-400 hover:text-cyan-400 transition-all duration-300 transform hover:rotate-12">
                        <i class="fab fa-linkedin text-2xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-pink-500 transition-all duration-300 transform hover:-rotate-12">
                        <i class="fab fa-instagram text-2xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-cyan-400 transition-all duration-300 transform hover:rotate-12">
                        <i class="fab fa-github text-2xl"></i>
                    </a>
                </div>

                <div class="mb-8">
                    <a href="mailto:contact@neuroflix.cyber" class="font-mono text-sm text-gray-400 hover:text-pink-500 transition-all duration-300">
                        <span class="terminal-text">contact@neuroflix.cyber</span>
                    </a>
                </div>

                <div class="text-center">
                    <p class="text-xs text-gray-500" x-data="typingAnimation()" x-init="init('© 2023 NEUROFLIX - ALL RIGHTS RESERVED', 50)"></p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
