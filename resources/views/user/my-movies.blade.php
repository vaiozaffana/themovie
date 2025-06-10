@extends('layouts.dashboard')

@section('content')
<div class="bg-gray-900 min-h-screen py-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <a href="{{ route('dashboard') }}"
            class="inline-flex items-center px-4 py-2 my-6 bg-gray-800 border border-cyan-500/30 rounded-md text-cyan-400 hover:bg-cyan-500/10 hover:text-cyan-300 transition-colors">
            <i class="fas fa-arrow-left mr-2 transition-all"></i>
            <span>Kembali</span>
        </a>
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold font-orbitron mb-2">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-pink-500">
                        YOUR MOVIE LIBRARY
                    </span>
                </h1>
                <p class="text-gray-400">All movies you've purchased</p>
            </div>
            <a href="{{ route('dashboard') }}"
               class="mt-4 md:mt-0 px-6 py-2 bg-gradient-to-r from-cyan-500 to-pink-500 rounded-md text-white font-medium hover:shadow-lg hover:shadow-cyan-500/30 transition-all flex items-center">
                <i class="fas fa-plus mr-2"></i> Add More Movies
            </a>
        </div>

        <!-- Movies Grid -->
        @if($movies->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($movies as $movie)
            <div class="group relative bg-gray-800 rounded-xl overflow-hidden border border-cyan-500/20 hover:border-cyan-500/50 transition-all duration-300 shadow-lg hover:shadow-cyan-500/10">
                <a href="{{ route('detail', $movie->id) }}" class="block">
                    <!-- Movie Poster -->
                    <div class="aspect-w-2 aspect-h-3">
                        @if($movie->poster)
                        <img src="{{ asset('storage/' . $movie->poster) }}"
                             alt="{{ $movie->title }}"
                             class="w-full h-full object-cover group-hover:opacity-90 transition-opacity duration-300">
                        @else
                        <div class="w-full h-full bg-gray-700 flex items-center justify-center">
                            <div class="text-center p-4">
                                <i class="fas fa-film text-gray-500 text-4xl mb-2"></i>
                                <p class="text-gray-500">No poster available</p>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Movie Info -->
                    <div class="p-4">
                        <h3 class="font-bold text-white mb-1 truncate">{{ $movie->title ?? 'Untitled Movie' }}</h3>

                        <div class="flex items-center justify-between mt-2">
                            <div class="flex items-center">
                                <span class="text-sm bg-cyan-500/10 text-cyan-400 px-2 py-1 rounded-full mr-4">
                                    {{ $movie->genre ?? 'Unknown' }}
                                </span>
                            </div>
                            <div class="text-xs text-gray-400" title="{{ \Carbon\Carbon::parse($movie->pivot->purchased_at)->format('M d, Y h:i A') }}">
                                {{ \Carbon\Carbon::parse($movie->pivot->purchased_at)->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $movies->links() }}
        </div>
        @else
        <!-- Empty State -->
        <div class="bg-gray-800/50 border border-cyan-500/30 rounded-xl p-12 text-center max-w-2xl mx-auto">
            <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-r from-cyan-500/10 to-pink-500/10 rounded-full flex items-center justify-center">
                <i class="fas fa-film text-cyan-400 text-3xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-white mb-3">Your Collection is Empty</h3>
            <p class="text-gray-400 mb-6">You haven't purchased any movies yet. Start building your cyberpunk movie library!</p>
            <a href="{{ route('dashboard') }}"
               class="inline-block px-8 py-3 bg-gradient-to-r from-cyan-500 to-pink-500 rounded-full text-white font-bold hover:shadow-lg hover:shadow-cyan-500/30 transition-all">
               Browse Movies
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
