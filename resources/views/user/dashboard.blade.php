@extends('layouts.dashboard')

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
                </div>

                <div class="mt-4 md:mt-0 flex space-x-3">
                    <a href="{{ route('my-movies') }}"
                        class="px-4 py-2 bg-gray-800 border border-cyan-500/30 rounded-md text-cyan-400 hover:bg-cyan-500/10 transition-colors">
                        <i class="fas fa-film mr-2"></i> My Movies
                    </a>
                </div>
            </div>

            <section>
                <h2 id="browse-movies" class="text-2xl font-bold font-orbitron mb-6">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-pink-500">
                        BROWSE NEW MOVIES
                    </span>
                </h2>

                <div class="mb-10">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-4 md:space-y-0">
                        <div class="relative w-full md:w-96">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-cyan-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text"
                                class="block w-full pl-10 pr-3 py-2 bg-gray-800 border border-cyan-500/30 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                                placeholder="Search movies...">
                        </div>

                        <div class="flex space-x-4" x-data="{ open: false }">
                            <button @click="open = !open"
                                class="flex items-center space-x-2 px-4 py-2 bg-gray-800 border border-pink-500/30 rounded-md text-white hover:bg-gray-700 transition-all duration-300">
                                <span>Filter</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                    </path>
                                </svg>
                            </button>

                            <div x-show="open" @click.away="open = false"
                                class="absolute mt-10 z-10 w-48 bg-gray-800 rounded-md shadow-lg border border-pink-500/30">
                                <div class="py-1">
                                    <a href="#" class="block px-4 py-2 text-sm text-white hover:bg-gray-700">New
                                        Releases</a>
                                    <a href="#" class="block px-4 py-2 text-sm text-white hover:bg-gray-700">Top Rated</a>
                                    <a href="#" class="block px-4 py-2 text-sm text-white hover:bg-gray-700">Cyberpunk
                                        Classics</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($movies as $movie)
                        <div
                            class="group relative bg-gray-800 rounded-lg overflow-hidden border border-cyan-500/20 hover:border-cyan-500/50 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg hover:shadow-cyan-500/10">
                            <div class="relative h-80 overflow-hidden">
                                <img src={{ asset('storage/' . $movie->poster) }} alt={{ $movie->title }}
                                    class="w-full max-h-full mx-auto object-scale-down bg-gray-900 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent opacity-80"></div>
                                <div class="absolute bottom-0 left-0 p-4">
                                    <h3 class="text-xl font-bold text-white">{{ $movie->title }}</h3>
                                    <div class="flex items-center mt-1">
                                        <span class="text-cyan-400 text-sm">{{ $movie->review_rating }}</span>
                                        <svg class="w-4 h-4 ml-1 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="p-4 flex flex-col flex-grow">
                                <p class="text-gray-400 text-sm mb-3 flex-grow">{{ $movie->description }}</p>
                                <a href="{{ route('detail', ['id' => $movie['id']]) }}"
                                    class="w-full py-2 bg-gradient-to-r from-cyan-500 to-pink-500 rounded-md text-white font-medium hover:opacity-90 transition-opacity duration-300 mt-auto flex items-center justify-center">
                                    <i class="fas fa-play mr-2"></i> DETAILS
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- @livewire('movie-search', ['exclude_purchased' => true]) --}}
            </section>
        </div>
    </div>
@endsection
