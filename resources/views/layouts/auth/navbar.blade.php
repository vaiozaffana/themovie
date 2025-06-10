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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
</head>
<body>

<nav class="fixed w-full z-50 bg-gray-900 bg-opacity-90 backdrop-blur-md border-b border-cyan-500/20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex-shrink-0" x-data="neonText()" x-init="init()">
                <a href="/" class="text-2xl font-orbitron font-bold">
                    <span class="text-cyan-400" x-ref="text">NEURO</span>
                    <span class="text-pink-500" x-ref="text2">FLIX</span>
                </a>
            </div>

            <div class="block">
                <div class="ml-4 flex items-center space-x-4">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-gray-800 border border-pink-500/30 rounded-md text-pink-400 hover:bg-pink-500/10 transition-colors cursor-pointer">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</nav>

<main>
    @yield('auth-content')
</main>

</body>
</html>
