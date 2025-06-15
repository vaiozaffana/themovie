@vite(['resources/css/app.css', 'resources/js/app.js'])

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Rajdhani:wght@300;500;700&display=swap"
    rel="stylesheet">

@foreach ($movies as $movie)
    <div
        class="group relative bg-gray-800 rounded-lg overflow-hidden border border-cyan-500/20 hover:border-cyan-500/50 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg hover:shadow-cyan-500/10 min-w-0">
        <!-- Movie content remains the same -->
        <div class="relative h-80 overflow-hidden">
            <img src="{{ asset('storage/' . $movie->poster) }}" alt="{{ $movie->title }}"
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
                <div class="flex flex-wrap mt-2">
                        <span class="genre-bubble">
                            {{ $movie->genre }}
                        </span>
                </div>
            </div>
        </div>
        <div class="p-4 flex flex-col flex-grow">
            <p class="text-gray-400 text-sm mb-3 flex-grow">{{ Str::limit($movie->description, 50) }}</p>
            <a href="{{ route('detail', $movie->id) }}"
                class="w-full py-2 bg-gradient-to-r from-cyan-500 to-pink-500 rounded-md text-white font-medium hover:opacity-90 transition-opacity duration-300 mt-auto flex items-center justify-center">
                <i class="fas fa-play mr-2"></i> DETAILS
            </a>
        </div>
    </div>
@endforeach
