@extends('layouts.app')

@section('content')
<div class="bg-gray-900 min-h-screen pt-16">
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-8">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold font-orbitron mb-2">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-pink-500">
                        WELCOME, {{ strtoupper(auth()->user()->name) }}
                    </span>
                </h1>
                <p class="text-gray-400">Your cyberpunk movie collection</p>
            </div>

            <div class="mt-4 md:mt-0 flex space-x-3">
                <a href="{{ route('my-movies') }}" class="px-4 py-2 bg-gray-800 border border-cyan-500/30 rounded-md text-cyan-400 hover:bg-cyan-500/10 transition-colors">
                    <i class="fas fa-film mr-2"></i> My Movies
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-gray-800 border border-pink-500/30 rounded-md text-pink-400 hover:bg-pink-500/10 transition-colors">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <section class="mb-12">
            <h2 class="text-2xl font-bold font-orbitron mb-6">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-pink-500">
                    YOUR RECENT PURCHASES
                </span>
            </h2>

            @if($movies->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($movies as $movie)
                <a href="{{ route('movies.show', $movie->id) }}" class="group">
                    <div class="relative bg-gray-800 rounded-lg overflow-hidden border border-cyan-500/20 hover:border-cyan-500/50 transition-all duration-300">
                        @if($movie->poster)
                        <img src="{{ asset('storage/' . $movie->poster) }}"
                             alt="{{ $movie->title }}"
                             class="w-full h-64 object-cover group-hover:opacity-80 transition-opacity">
                        @else
                        <div class="w-full h-64 bg-gray-700 flex items-center justify-center">
                            <span class="text-gray-500">No poster</span>
                        </div>
                        @endif
                        <div class="p-4">
                            <h3 class="font-bold text-white mb-1 truncate">{{ $movie->title }}</h3>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-cyan-400">{{ $movie->genre }}</span>
                                <span class="text-xs text-gray-400">
                                    Purchased {{ $movie->pivot->purchased_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            @else
            <div class="bg-gray-800/50 border border-cyan-500/20 rounded-xl p-8 text-center">
                <div class="w-16 h-16 mx-auto mb-4 bg-cyan-500/10 rounded-full flex items-center justify-center">
                    <i class="fas fa-film text-cyan-400 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">You haven't purchased any movies yet</h3>
                <p class="text-gray-400 mb-4">Browse our collection and start building your cyberpunk movie library</p>
                <a href="/" class="inline-block px-6 py-2 bg-gradient-to-r from-cyan-500 to-pink-500 rounded-md text-white font-medium hover:shadow-lg hover:shadow-cyan-500/30 transition-all">
                    Browse Movies
                </a>
            </div>
            @endif
        </section>

        <section>
            <h2 class="text-2xl font-bold font-orbitron mb-6">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-pink-500">
                    BROWSE NEW MOVIES
                </span>
            </h2>

            {{-- @livewire('movie-search', ['exclude_purchased' => true]) --}}
        </section>
    </div>
</div>
@endsection
