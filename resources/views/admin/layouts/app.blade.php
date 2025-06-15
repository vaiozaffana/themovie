<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - NeuroFlix</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Rajdhani:wght@300;500;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-900 text-gray-300">
            <div class="p-4 border-b border-gray-800">
                <h1 class="text-xl font-bold font-orbitron">
                    <span class="text-cyan-400">NEURO</span><span class="text-pink-500">FLIX</span>
                    <span class="text-xs block mt-1 text-gray-400">Admin Panel</span>
                </h1>
            </div>
            <nav class="p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800 text-cyan-400' : '' }}">
                    <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                </a>
                <a href="{{ route('admin.users') }}" class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->routeIs('admin.users*') ? 'bg-gray-800 text-cyan-400' : '' }}">
                    <i class="fas fa-users mr-2"></i> Users
                </a>
                <a href="{{ route('admin.movies') }}" class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->routeIs('admin.movies*') ? 'bg-gray-800 text-cyan-400' : '' }}">
                    <i class="fas fa-film mr-2"></i> Movies
                </a>
                <form method="POST" action="{{ route('logout') }}" class="pt-4 border-t border-gray-800">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 rounded hover:bg-gray-800">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <header class="bg-white shadow-sm p-4">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">@yield('title')</h2>
                    <div class="text-sm text-gray-500">
                        Welcome, {{ auth()->user()->name }}
                    </div>
                </div>
            </header>

            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
