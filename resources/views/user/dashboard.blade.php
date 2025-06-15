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
                        <!-- Search Input -->
                        <div class="relative w-full md:w-96">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-cyan-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <form x-data='movieSearch' action="{{ route('movies.search') }}" method="GET">
                                <input type="text" id="search-input" x-model="searchQuery"
                                    class="block w-full pl-10 pr-10 py-2 bg-gray-800 border border-cyan-500/30 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                                    placeholder="Search movies...">
                                <!-- Tombol clear -->
                                <button x-show="searchQuery" @click="clearSearch()" type="button"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer text-gray-400 hover:text-white">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>

                        <!-- Filter Button with Genre Popup -->
                        <div class="flex space-x-4" x-data="movieFilter()">
                            <div class="relative">
                                <button @click="filterOpen = !filterOpen"
                                    class="flex items-center space-x-2 px-4 py-2 bg-gray-800 border rounded-md text-white hover:bg-gray-700 transition-all duration-300"
                                    :class="currentFilter ? 'border-pink-500' : 'border-pink-500/30'">
                                    <span>Filter</span>
                                    <template x-if="!currentFilter">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </template>
                                    <template x-if="currentFilter">
                                        <svg @click.stop="resetFilter()" class="w-4 h-4 text-pink-500 hover:text-pink-300"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </template>
                                </button>

                                <!-- Filter Dropdown -->
                                <div x-show="filterOpen" @click.away="filterOpen = false"
                                    class="cursor-pointer absolute mt-1 z-20 w-[90px] bg-gray-800 rounded-md shadow-lg border border-pink-500/30">
                                    <div class="py-1">
                                        <a @click.prevent="applyFilter('new')"
                                            class="block px-4 py-2 text-sm text-white hover:bg-gray-700">New Releases</a>
                                        <a @click.prevent="applyFilter('top')"
                                            class="block px-4 py-2 text-sm text-white hover:bg-gray-700">Top Rated</a>
                                        <a @click.prevent="applyFilter('az')"
                                            class="block px-4 py-2 text-sm text-white hover:bg-gray-700">A-Z</a>
                                        <a @click.prevent="applyFilter('za')"
                                            class="block px-4 py-2 text-sm text-white hover:bg-gray-700">Z-A</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 px-4" id="movies-container">
                    @include('partials.movies', ['movies' => $movies])
                </div>

                <!-- Load More Button -->
                <!-- Di bagian Load More Button, tambahkan class conditional -->
                <div class="mt-10 text-center">
                    <button id="load-more" data-next-page="{{ $movies->nextPageUrl() }}"
                        class="px-6 py-2 border border-cyan-500 text-cyan-400 rounded-md hover:bg-cyan-500/10 transition-all duration-300 cursor-pointer {{ request()->has('query') || request()->has('filter') ? 'hidden' : '' }}">
                        LOAD MORE
                    </button>
                    <button id="show-less"
                        class="mt-4 px-6 py-2 border border-pink-500 text-pink-400 rounded-md hover:bg-pink-500/10 transition-all duration-300 cursor-pointer hidden">
                        SHOW LESS
                    </button>
                </div>
            </div>

            </section>
        </div>
    </div>

    <script>
        const container = document.getElementById('movies-container');
        const loadMoreBtn = document.getElementById('load-more');
        const showLessBtn = document.getElementById('show-less');

        let originalMovies = container.innerHTML;

        // Filter update
        function movieFilter() {
            return {
                filterOpen: false,
                currentFilter: '',
                init() {
                    // Inisialisasi filter dari URL jika ada
                    const urlParams = new URLSearchParams(window.location.search);
                    if (urlParams.has('filter')) {
                        this.currentFilter = urlParams.get('filter');
                        this.applyFilter(this.currentFilter, true);
                    }
                },
                applyFilter(filter, skipHistory = false) {
                    this.filterOpen = false;
                    this.currentFilter = filter;

                    fetch(`/movies/filter?filter=${filter}`)
                        .then(response => response.json())
                        .then(data => {
                            container.innerHTML = data.html;
                            if (loadMoreBtn) loadMoreBtn.classList.add('hidden');
                            if (showLessBtn) showLessBtn.classList.add('hidden');

                            // Update URL tanpa reload
                            if (!skipHistory && window.history.replaceState) {
                                const url = new URL(window.location);
                                url.searchParams.set('filter', filter);
                                window.history.replaceState(null, '', url);
                            }
                        });
                },
                resetFilter() {
                    this.currentFilter = '';
                    container.innerHTML = originalMovies;
                    if (loadMoreBtn) loadMoreBtn.classList.remove('hidden');
                    if (showLessBtn) showLessBtn.classList.add('hidden');

                    // Hapus parameter filter dari URL
                    if (window.history.replaceState) {
                        const url = new URL(window.location);
                        url.searchParams.delete('filter');
                        window.history.replaceState(null, '', url);
                    }
                }
            }
        }

        // Load More functionality
        if (loadMoreBtn) {
            loadMoreBtn.addEventListener('click', function() {
                const nextPage = this.getAttribute('data-next-page');
                this.disabled = true;
                this.innerHTML = 'Loading...';

                fetch(nextPage)
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        const newMovies = doc.getElementById('movies-container').innerHTML;

                        container.innerHTML += newMovies;

                        const newButton = doc.getElementById('load-more');
                        if (newButton) {
                            loadMoreBtn.setAttribute('data-next-page', newButton.getAttribute(
                                'data-next-page'));
                            loadMoreBtn.innerHTML = 'LOAD MORE';
                            loadMoreBtn.disabled = false;
                        } else {
                            loadMoreBtn.remove();
                        }

                        if (showLessBtn) showLessBtn.classList.remove('hidden');
                    });
            });
        }

        // Show Less functionality
        if (showLessBtn) {
            showLessBtn.addEventListener('click', function() {
                container.innerHTML = originalMovies;
                showLessBtn.classList.add('hidden');
                if (loadMoreBtn) loadMoreBtn.classList.remove('hidden');
            });
        }

        // Search functionality (hide all buttons)
        document.addEventListener('alpine:init', () => {
            Alpine.data('movieSearch', () => ({
                searchQuery: '',
                init() {
                    const searchInput = document.getElementById('search-input');
                    const debouncedSearch = debounce(() => {
                        this.performSearch();
                    }, 300);

                    searchInput.addEventListener('input', debouncedSearch);

                    // Inisialisasi searchQuery dari URL jika ada
                    const urlParams = new URLSearchParams(window.location.search);
                    if (urlParams.has('query')) {
                        this.searchQuery = urlParams.get('query');
                        searchInput.value = this.searchQuery;
                    }
                },
                performSearch() {
                    if (this.searchQuery.trim() === '') {
                        this.clearSearch();
                        return;
                    }

                    fetch(`/movies/search?query=${this.searchQuery}`, {
                            cache: "no-store"
                        })
                        .then(response => response.json())
                        .then(data => {
                            Alpine.mutateDom(() => {
                                container.innerHTML = data.html;
                                if (loadMoreBtn) loadMoreBtn.classList.add('hidden');
                                if (showLessBtn) showLessBtn.classList.add('hidden');
                            });
                        });
                },
                clearSearch() {
                    this.searchQuery = '';
                    document.getElementById('search-input').value = '';

                    // Periksa apakah ada filter aktif
                    const urlParams = new URLSearchParams(window.location.search);
                    const hasFilter = urlParams.has('filter');

                    if (!hasFilter) {
                        container.innerHTML = originalMovies;
                        if (loadMoreBtn) loadMoreBtn.classList.remove('hidden');
                    }
                    if (showLessBtn) showLessBtn.classList.add('hidden');

                    // Hapus query parameter dari URL tanpa reload
                    if (window.history.replaceState) {
                        const url = new URL(window.location);
                        url.searchParams.delete('query');
                        window.history.replaceState(null, '', url);
                    }

                    // Jika ada filter, biarkan filter yang mengontrol tampilan
                    if (hasFilter) {
                        // Trigger filter untuk memperbarui tampilan
                        const filterComponent = Alpine.store('filter');
                        if (filterComponent) {
                            filterComponent.applyFilter(urlParams.get('filter'), true);
                        }
                    }
                }
            }));
        });

        function debounce(func, wait) {
            let timeout;
            return function() {
                const context = this,
                    args = arguments;
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(context, args), wait);
            };
        }
    </script>
@endsection
