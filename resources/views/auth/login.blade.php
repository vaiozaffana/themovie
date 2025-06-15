@extends('layouts.auth', [
    'title' => 'Login',
    'header' => 'WELCOME BACK',
    'footer' => 'Don\'t have an account? <a href="' . route('register') . '" class="text-cyan-400 hover:text-pink-500 transition-colors">Sign Up</a>',
])

@section('content')
    @if (session('success'))
        <div class="bg-green-500 text-white px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-500 text-white px-4 py-2 rounded mb-4">
            {{ $errors->first() }}
        </div>
    @endif
    <form class="space-y-6" action="{{ route('login') }}" method="POST">
        @csrf
        <div>
            <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email Address</label>
            <div class="relative">
                <input id="email" name="email" type="email" required
                    class="w-full px-4 py-2 bg-gray-700 border border-cyan-500/30 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                    placeholder="john@example.com">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-cyan-400">
                    <i class="fas fa-envelope"></i>
                </div>
            </div>
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Password</label>
            <div class="relative">
                <input id="password" name="password" type="password" required
                    class="w-full px-4 py-2 bg-gray-700 border border-cyan-500/30 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                    placeholder="••••••••">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-cyan-400">
                    <i class="fas fa-lock"></i>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input id="remember" name="remember" type="checkbox"
                    class="h-4 w-4 bg-gray-700 border-cyan-500/30 rounded focus:ring-cyan-500 text-cyan-500">
                <label for="remember" class="ml-2 block text-sm text-gray-300">
                    Remember me
                </label>
            </div>
        </div>

        <div>
            <button type="submit"
                class="w-full py-2 px-4 cursor-pointer bg-gradient-to-r from-cyan-500 to-pink-500 rounded-md text-white font-medium hover:shadow-lg hover:shadow-cyan-500/30 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 focus:ring-offset-gray-800">
                LOGIN
            </button>
        </div>


    </form>
@endsection
