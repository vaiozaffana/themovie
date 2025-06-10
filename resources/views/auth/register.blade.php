@extends('layouts.auth', [
    'title' => 'Register',
    'header' => 'CREATE ACCOUNT',
    'footer' => 'Already have an account? <a href="' . route('login') . '" class="text-cyan-400 hover:text-pink-500 transition-colors">Sign In</a>',
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
    <form class="space-y-6" action="{{ route('register') }}" method="POST">
        @csrf
        <div>
            <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Full Name</label>
            <div class="relative">
                <input id="name" name="name" type="text" required
                    class="w-full px-4 py-2 bg-gray-700 border border-cyan-500/30 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                    placeholder="John Doe">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-cyan-400">
                    <i class="fas fa-user"></i>
                </div>
            </div>
        </div>

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

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-1">Confirm Password</label>
            <div class="relative">
                <input id="password_confirmation" name="password_confirmation" type="password" required
                    class="w-full px-4 py-2 bg-gray-700 border border-cyan-500/30 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                    placeholder="••••••••">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-cyan-400">
                    <i class="fas fa-lock"></i>
                </div>
            </div>
        </div>

        <div class="flex items-center">
            <input id="terms" name="terms" type="checkbox"
                class="h-4 w-4 bg-gray-700 border-cyan-500/30 rounded focus:ring-cyan-500 text-cyan-500">
            <label for="terms" class="ml-2 block text-sm text-gray-300">
                I agree to the <a href="#" class="text-cyan-400 hover:text-pink-500 transition-colors">Terms</a> and
                <a href="#" class="text-cyan-400 hover:text-pink-500 transition-colors">Privacy Policy</a>
            </label>
        </div>
        <div>
            <button type="submit"
                class="w-full py-2 px-4 cursor-pointer bg-gradient-to-r from-cyan-500 to-pink-500 rounded-md text-white font-medium hover:shadow-lg hover:shadow-cyan-500/30 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 focus:ring-offset-gray-800">
                REGISTER
            </button>
        </div>
    </form>
@endsection
