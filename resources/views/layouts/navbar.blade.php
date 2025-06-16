<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movify - Cyberpunk Cinema</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Rajdhani:wght@300;500;700&display=swap" rel="stylesheet">
</head>
<body>

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

</body>
</html>
