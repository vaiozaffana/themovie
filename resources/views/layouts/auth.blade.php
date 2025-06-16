<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NeuroFlix - {{ $title ?? 'Auth' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Rajdhani:wght@300;500;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-gray-900 via-purple-900 to-gray-900 font-rajdhani text-gray-300 antialiased">
    <div class="absolute inset-0 z-[-2]"></div>
    <canvas class="fixed top-0 left-0 w-full h-full opacity-90 z-0" id="particle-canvas"></canvas>

    <div class="relative min-h-screen flex items-center justify-center px-4 py-12 z-10">
        <div class="w-full max-w-md relative z-10">
            <div class="text-center mb-8" x-data="neonText()" x-init="init()">
                <a href="/" class="text-3xl font-orbitron font-bold inline-block">
                    <span class="text-cyan-400" x-ref="text">MOVI</span>
                    <span class="text-pink-500" x-ref="text2">FY</span>
                </a>
            </div>

            <div class="bg-gray-800 rounded-xl p-8 border border-cyan-500/30 shadow-lg shadow-cyan-500/10">
                <h2 class="text-2xl font-bold text-center mb-6 font-orbitron">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-pink-500">
                        {{ $header }}
                    </span>
                </h2>

                @yield('content')

                <div class="mt-6 text-center text-sm text-gray-400">
                    {!! $footer !!}
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/components/particles.js') }}"></script>
</body>
</html>
