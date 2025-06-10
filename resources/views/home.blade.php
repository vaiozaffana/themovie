@extends('layouts.app')

@section('content')
    <section class="relative h-screen flex items-center justify-center overflow-hidden pt-16">
        <canvas
            class="absolute inset-0 bg-gradient-to-br pointer-events-none from-gray-900 via-purple-900 to-gray-900 opacity-90"
            id="particle-canvas"></canvas>

        <div class="relative z-10 text-center px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 font-orbitron">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-pink-500">
                    DIVE INTO THE NEON FUTURE
                </span>
                <br>
                <span class="text-white">OF CINEMA</span>
            </h1>

            <p class="text-lg md:text-xl max-w-3xl mx-auto mb-10 text-gray-300">
                Experience movie like never before with our cyber-enhanced streaming platform.
                AI-curated, blockchain-secured, and neuro-optimized for your pleasure.
            </p>

            <a href="#movie-title">
                <button
                    class="px-8 py-3 bg-gradient-to-r from-cyan-500 to-pink-500 rounded-full text-white font-bold text-lg hover:shadow-xl hover:shadow-cyan-500/30 transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:ring-opacity-50 cursor-pointer"
                    id="explore-button">
                    EXPLORE NOW
                </button>
            </a>
        </div>

        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </section>

    <section class="py-20 bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-16 font-orbitron">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-pink-500">
                    CYBER-ENHANCED FEATURES
                </span>
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8" id="feature-cards">
                <div
                    class="bg-gray-800 rounded-xl p-6 border border-cyan-500/20 hover:border-cyan-500/40 transition-all duration-300 transform hover:-translate-y-2 hover:shadow-lg hover:shadow-cyan-500/10">
                    <div class="text-cyan-400 mb-4">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-white">4K HOLOGRAM</h3>
                    <p class="text-gray-400">Experience movies in stunning 4K holographic projection with neural sync
                        technology.</p>
                </div>

                <div
                    class="bg-gray-800 rounded-xl p-6 border border-pink-500/20 hover:border-pink-500/40 transition-all duration-300 transform hover:-translate-y-2 hover:shadow-lg hover:shadow-pink-500/10">
                    <div class="text-pink-500 mb-4">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-white">AI RECOMMENDATIONS</h3>
                    <p class="text-gray-400">Our neural network learns your preferences to suggest perfect cinematic
                        experiences.</p>
                </div>

                <div
                    class="bg-gray-800 rounded-xl p-6 border border-cyan-500/20 hover:border-cyan-500/40 transition-all duration-300 transform hover:-translate-y-2 hover:shadow-lg hover:shadow-cyan-500/10">
                    <div class="text-cyan-400 mb-4">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-white">DARKNET DOWNLOADS</h3>
                    <p class="text-gray-400">Secure, anonymous downloads through our decentralized darknet distribution
                        network.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-gray-900 border-t border-pink-500/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold mb-10 font-orbitron">
                <span id="movie-title" class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-pink-500">
                    CYBERPUNK CINEMA COLLECTION
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
                            <img src={{ asset('storage/' . $movie['poster']) }} alt={{ $movie['title'] }}
                                class="w-full max-h-full mx-auto object-scale-down bg-gray-900 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent opacity-80"></div>
                            <div class="absolute bottom-0 left-0 p-4">
                                <h3 class="text-xl font-bold text-white">{{ $movie['title'] }}</h3>
                                <div class="flex items-center mt-1">
                                    <span class="text-cyan-400 text-sm">{{ $movie['review_rating'] }}</span>
                                    <svg class="w-4 h-4 ml-1 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 flex flex-col flex-grow">
                            <p class="text-gray-400 text-sm mb-3 flex-grow">{{ $movie['description'] }}</p>
                            <a href="{{ route('detail', ['id' => $movie['id']]) }}"
                                class="w-full py-2 bg-gradient-to-r from-cyan-500 to-pink-500 rounded-md text-white font-medium hover:opacity-90 transition-opacity duration-300 mt-auto flex items-center justify-center">
                                <i class="fas fa-play mr-2"></i> DETAILS
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-10 text-center">
                <button
                    class="px-6 py-2 border border-cyan-500 text-cyan-400 rounded-md hover:bg-cyan-500/10 transition-all duration-300">
                    LOAD MORE
                </button>
            </div>
        </div>
    </section>
@endsection
