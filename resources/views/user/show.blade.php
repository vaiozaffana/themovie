@auth
    @extends('layouts.auth.navbar')

    @section('auth-content')
        <div class="bg-gray-900 min-h-screen pt-16">
            <div class="container mx-auto px-4 py-8">
                <a href="{{ route('my-movies') }}"
                    class="inline-flex items-center px-4 py-2 my-6 bg-gray-800 border border-cyan-500/30 rounded-md text-cyan-400 hover:bg-cyan-500/10 hover:text-cyan-300 transition-colors">
                    <i class="fas fa-arrow-left mr-2 transition-all"></i>
                    <span>Kembali</span>
                </a>
                <div class="flex flex-col md:flex-row gap-8">
                    <!-- Poster -->
                    <div class="w-full md:w-1/3">
                        <div class="rounded-xl overflow-hidden border-2 border-cyan-500/50 shadow-lg shadow-cyan-500/20">
                            @if ($movie->poster)
                                <img src="{{ asset('storage/' . $movie->poster) }}" alt="{{ $movie->title }}"
                                    class="w-full h-auto object-cover">
                            @else
                                <div class="w-full h-96 bg-gray-700 flex items-center justify-center">
                                    <span class="text-gray-500">No poster available</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="w-full md:w-2/3 text-white">
                        <h1 class="text-3xl font-bold font-orbitron mb-2">
                            {{ $movie->title }}
                        </h1>

                        <!-- Rating and Genre -->
                        <div class="flex items-center gap-4 mb-6">
                            <div class="flex items-center bg-gray-800/80 px-3 py-1 rounded-full">
                                <i class="fas fa-star text-yellow-400 mr-2"></i>
                                <span>
                                    @if ($movie->userReviews->count() > 0)
                                        {{ number_format($movie->review_rating, 1) }}/10
                                        <span class="text-gray-400 ml-1">({{ $movie->userReviews->count() }} reviews)</span>
                                    @else
                                        No ratings yet
                                    @endif
                                </span>
                            </div>

                            <!-- Tambahkan bintang visual -->
                            <div class="flex items-center">
                                @php
                                    $rating = $movie->review_rating ?? 0;
                                    $fullStars = floor($rating);
                                    $hasHalfStar = $rating - $fullStars >= 0.5;
                                @endphp

                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $fullStars)
                                        <i class="fas fa-star text-yellow-400 mx-0.5"></i>
                                    @elseif($i == $fullStars + 1 && $hasHalfStar)
                                        <i class="fas fa-star-half-alt text-yellow-400 mx-0.5"></i>
                                    @else
                                        <i class="far fa-star text-yellow-400 mx-0.5"></i>
                                    @endif
                                @endfor
                            </div>
                        </div>

                        <!-- Purchase/Watch Button -->
                        <div class="mb-8">
                            @auth
                                @if (auth()->user()->hasAlreadyPurchased($movie->id))
                                    <div class="flex gap-4">
                                        <a href="#"
                                            class="inline-block px-6 py-3 bg-gradient-to-r from-green-500 to-cyan-500 rounded-md text-white font-bold hover:shadow-lg hover:shadow-green-500/30 transition-all">
                                            <i class="fas fa-play mr-2"></i> Watch Now
                                        </a>
                                        <div class="flex items-center bg-gray-800/80 px-4 rounded-full border border-cyan-500/30">
                                            <i class="fas fa-check-circle text-green-400 mr-2"></i>
                                            <span>Purchased</span>
                                        </div>
                                    </div>
                                @else
                                    <a href="{{ route('checkout-show', $movie->id) }}"
                                        class="inline-block px-6 py-3 bg-gradient-to-r from-cyan-500 to-pink-500 rounded-md text-white font-bold hover:shadow-lg hover:shadow-cyan-500/30 transition-all">
                                        <i class="fas fa-shopping-cart mr-2"></i> Buy for {{ number_format($movie->price, 2) }} CR
                                    </a>
                                @endif
                            @else
                                <a href="{{ route('login') }}"
                                    class="inline-block px-6 py-3 bg-gradient-to-r from-cyan-500 to-pink-500 rounded-md text-white font-bold hover:shadow-lg hover:shadow-cyan-500/30 transition-all">
                                    <i class="fas fa-shopping-cart mr-2"></i> Buy for {{ number_format($movie->price, 2) }} CR
                                </a>
                            @endauth
                        </div>

                        <!-- Description -->
                        <div class="mb-8">
                            <h2 class="text-xl font-bold font-orbitron mb-2 text-cyan-400">
                                DESCRIPTION
                            </h2>
                            <p class="text-gray-300">
                                {{ $movie->description }}
                            </p>
                        </div>

                        <!-- Additional Info for Purchased Users -->
                        @auth
                            @if (auth()->user()->hasAlreadyPurchased($movie->id))
                                <div class="mb-8">
                                    <h2 class="text-xl font-bold font-orbitron mb-2 text-pink-500">
                                        YOUR ACCESS
                                    </h2>
                                    <div class="bg-gray-800/50 border border-cyan-500/20 rounded-xl p-4">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="text-gray-300">Purchase Date</p>
                                                <p class="text-cyan-400">{{ auth()->user()->getPurchaseDate($movie->id) }}</p>
                                            </div>
                                            <div>
                                                <p class="text-gray-300">License</p>
                                                <p class="text-cyan-400">Permanent</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endauth

                        <!-- Writer -->
                        <div class="mb-8">
                            <h2 class="text-xl font-bold font-orbitron mb-2 text-pink-500">
                                WRITTEN BY
                            </h2>
                            <p class="text-gray-300">
                                {{ $movie->writer ?? 'No writer' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="reviews-container">
                    <div class="mt-12">
                        <h2 class="text-2xl font-bold font-orbitron mb-6 text-white">
                            USER REVIEWS
                        </h2>
                    </div>

                    @auth
                        @if (auth()->user()->hasAlreadyPurchased($movie->id))
                            @if (!auth()->user()->hasReviewed($movie->id))
                                <!-- Form Review -->
                                <div class="bg-gray-800/50 border border-cyan-500/30 rounded-xl p-6 mb-6">
                                    <h3 class="text-xl font-bold font-orbitron mb-4 text-cyan-400">ADD YOUR REVIEW</h3>
                                    <form action="{{ route('reviews.store', $movie->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="movie_id" value="{{ $movie->id }}">

                                        <!-- Rating Input -->
                                        <div x-data="{ rating: 0, hoverRating: 0 }" class="mb-4">
                                            <label class="block text-gray-400 mb-2">Your Rating</label>
                                            <div class="flex items-center">
                                                @for ($i = 1; $i <= 10; $i++)
                                                    <button type="button" @mouseenter="hoverRating = {{ $i }}"
                                                        @mouseleave="hoverRating = rating" @click="rating = {{ $i }}"
                                                        :class="{
                                                            'text-yellow-400': {{ $i }} <= (hoverRating ||
                                                                rating),
                                                            'text-gray-400': {{ $i }} > (hoverRating ||
                                                                rating)
                                                        }"
                                                        class="text-2xl cursor-pointer focus:outline-none">
                                                        <i class="fas fa-star"></i>
                                                    </button>
                                                    <input type="hidden" name="rating" x-model="rating">
                                                @endfor
                                            </div>
                                            @error('rating')
                                                <span class="text-red-400 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-4">
                                            <label class="block text-gray-400 mb-2">Your Review</label>
                                            <textarea name="review" rows="4"
                                                class="w-full px-4 py-2 bg-gray-700 border border-cyan-500/30 rounded-md text-white"
                                                placeholder="Share your thoughts..." required>{{ old('review') }}</textarea>
                                            @error('review')
                                                <span class="text-red-400 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <button type="submit"
                                            class="cursor-pointer px-6 py-2 bg-gradient-to-r from-cyan-500 to-pink-500 rounded-md text-white font-bold">
                                            Submit Review
                                        </button>
                                    </form>
                                </div>
                            @else
                                {{-- <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        @if (session('review_submitted'))
                                            showAutoHidePopup();
                                        @endif
                                    });
                                </script> --}}
                            @endif
                        @else
                            <!-- Notifikasi Belum Membeli -->
                            <div class="bg-gray-800/50 border border-cyan-500/30 rounded-xl p-6 mb-6">
                                <h3 class="text-xl font-bold font-orbitron mb-4 text-cyan-400">ADD YOUR REVIEW</h3>
                                <form action="{{ route('reviews.store', $movie->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="movie_id" value="{{ $movie->id }}">

                                    <!-- Rating Input -->
                                    <div x-data="{ rating: 0, hoverRating: 0 }" class="mb-4">
                                        <label class="block text-gray-400 mb-2">Your Rating</label>
                                        <div class="flex items-center">
                                            @for ($i = 1; $i <= 10; $i++)
                                                <button type="button" @mouseenter="hoverRating = {{ $i }}"
                                                    @mouseleave="hoverRating = rating" @click="rating = {{ $i }}"
                                                    :class="{
                                                        'text-yellow-400': {{ $i }} <= (hoverRating ||
                                                            rating),
                                                        'text-gray-400': {{ $i }} > (hoverRating ||
                                                            rating)
                                                    }"
                                                    class="text-2xl cursor-pointer focus:outline-none">
                                                    <i class="fas fa-star"></i>
                                                </button>
                                                <input type="hidden" name="rating" x-model="rating">
                                            @endfor
                                        </div>
                                        @error('rating')
                                            <span class="text-red-400 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-gray-400 mb-2">Your Review</label>
                                        <textarea name="review" rows="4"
                                            class="w-full px-4 py-2 bg-gray-700 border border-cyan-500/30 rounded-md text-white"
                                            placeholder="Share your thoughts..." required>{{ old('review') }}</textarea>
                                        @error('review')
                                            <span class="text-red-400 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <button type="submit"
                                        class="px-6 py-2 bg-gradient-to-r from-cyan-500 to-pink-500 rounded-md text-white font-bold cursor-not-allowed">
                                        Submit Review
                                    </button>
                                </form>
                            </div>
                        @endif
                    @else
                        <!-- Notifikasi Login -->
                        <div class="bg-gray-800/50 border border-cyan-500/30 rounded-xl p-6 text-center">
                            <div class="w-16 h-16 mx-auto mb-4 bg-cyan-500/10 rounded-full flex items-center justify-center">
                                <i class="fas fa-user-lock text-cyan-400 text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-bold mb-2 text-cyan-400">Login Required</h3>
                            <p class="text-gray-400 mb-4">Please login to submit a review</p>
                            <a href="{{ route('login') }}"
                                class="inline-block px-6 py-2 bg-gradient-to-r from-cyan-500 to-pink-500 rounded-md text-white font-medium">
                                Login Now
                            </a>
                        </div>
                    @endauth

                    <!-- Tampilkan review baru jika ada di session -->
                    @if (session('new_review'))
                        <div class="bg-gray-800/50 border border-cyan-500/20 rounded-xl p-6 mb-6 mt-6">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center mr-4">
                                    <i class="fas fa-user text-cyan-400"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold">{{ session('new_review.user.name') }}</h4>
                                    <div class="flex items-center text-sm text-gray-400">
                                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                                        <span>{{ session('new_review.rating') }}</span>
                                        <span class="mx-2">•</span>
                                        <span>Just now</span>
                                    </div>
                                </div>
                            </div>
                            <p class="text-gray-300">"{{ session('new_review.review') }}"</p>
                        </div>
                    @endif

                    <!-- Loop untuk semua review -->
                    @foreach ($movie->userReviews as $review)
                        <div
                            class="bg-gray-800/50 border border-cyan-500/20 rounded-xl p-6 mb-6 relative group hover:border-cyan-500/50 transition-colors">
                            <!-- Main Review Content -->
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <div id="review-content-{{ $review->pivot->id }}">
                                        <div class="flex items-center mb-4">
                                            <div
                                                class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center mr-4">
                                                <i class="fas fa-user text-cyan-400"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-white">{{ $review->name }}</h4>
                                                <div class="flex items-center text-sm text-gray-400">
                                                    <div class="flex mr-2">
                                                        @for ($i = 1; $i <= $review->pivot->rating; $i++)
                                                            <i class="fas fa-star text-yellow-400 mr-1"></i>
                                                        @endfor
                                                    </div>
                                                    <span>{{ $review->pivot->rating }}/10</span>
                                                    <span class="mx-2">•</span>
                                                    <span>{{ \Carbon\Carbon::parse($review->pivot->updated_at ?? $review->pivot->created_at)->diffForHumans() }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-gray-300">"{{ $review->pivot->review }}"</p>
                                    </div>
                                </div>

                                <!-- Edit/Delete Buttons (positioned to the right) -->
                                @auth
                                    @if (auth()->id() == $review->pivot->user_id)
                                        <div class="flex space-x-4 ml-4">
                                            <!-- Edit Button -->
                                            <button onclick="toggleEditForm({{ $review->pivot->id }})"
                                                class="cursor-pointer text-cyan-400 hover:text-cyan-300 text-xl p-2 transition-all opacity-0 group-hover:opacity-100">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <!-- Delete Button -->
                                            <form action="{{ route('reviews.destroy', $review->pivot->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="cursor-pointer text-pink-500 hover:text-pink-400 text-xl p-2 transition-all opacity-0 group-hover:opacity-100"
                                                    onclick="return confirm('Are you sure?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                            </div>

                            <!-- Edit Form (stays below) -->
                            @auth
                                @if (auth()->id() == $review->pivot->user_id)
                                    <div id="edit-form-{{ $review->pivot->id }}"
                                        class="hidden mt-4 bg-gray-800/50 p-4 rounded-lg" x-data="{
                                            hoverRating: 0,
                                            selectedRating: {{ $review->pivot->rating }},
                                            reviewText: '{{ $review->pivot->review }}'
                                        }">
                                        <form action="{{ route('reviews.update', $review->pivot->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <!-- Rating Input -->
                                            <div class="mb-4">
                                                <label class="block text-gray-400 mb-2">Your Rating</label>
                                                <div class="flex items-center">
                                                    @for ($i = 1; $i <= 10; $i++)
                                                        <button type="button" @mouseenter="hoverRating = {{ $i }}"
                                                            @mouseleave="hoverRating = 0"
                                                            @click="selectedRating = {{ $i }}"
                                                            class="text-2xl cursor-pointer focus:outline-none mr-1 last:mr-0"
                                                            :class="{
                                                                'text-yellow-400': {{ $i }} <= (
                                                                    hoverRating ||
                                                                    selectedRating),
                                                                'text-gray-400': {{ $i }} > (hoverRating ||
                                                                    selectedRating)
                                                            }">
                                                            <i class="fas fa-star"></i>
                                                        </button>
                                                        <input type="radio" name="rating" value="{{ $i }}"
                                                            class="hidden" x-model="selectedRating"
                                                            {{ $review->pivot->rating == $i ? 'checked' : '' }}>
                                                    @endfor
                                                </div>
                                            </div>

                                            <!-- Review Input -->
                                            <div class="mb-4">
                                                <textarea name="review" rows="3" x-model="reviewText"
                                                    class="w-full px-4 py-2 bg-gray-700 rounded-md text-white border border-cyan-500/30">{{ trim($review->pivot->review) }}</textarea>
                                            </div>

                                            <div class="flex justify-end space-x-2">
                                                <button type="button" onclick="toggleEditForm({{ $review->pivot->id }})"
                                                    class="px-4 py-2 bg-gray-700 rounded-md hover:bg-gray-600 transition-colors text-white">
                                                    Cancel
                                                </button>
                                                <button type="submit"
                                                    class="px-4 py-2 bg-gradient-to-r from-cyan-500 to-pink-500 rounded-md hover:shadow-lg hover:shadow-cyan-500/30 transition-all text-white">
                                                    Update Review
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    @endforeach
                </div>

            </div>
        </div>

        <script>
            function toggleEditForm(reviewId) {
                const editForm = document.getElementById(`edit-form-${reviewId}`);
                const reviewContent = document.getElementById(`review-content-${reviewId}`);
                const editButtons = document.querySelectorAll(`[data-review-id="${reviewId}"] .edit-delete-buttons`);
                const radioButtons = editForm.querySelectorAll('input[type="radio"]');
                radioButtons.forEach(radio => {
                    radio.checked = (radio.value == {{ $review->pivot->rating }});
                });

                // Toggle form edit
                if (editForm.classList.contains('hidden')) {
                    editForm.classList.remove('hidden');
                    reviewContent.classList.add('hidden');

                    // Sembunyikan tombol edit/delete saat mode edit
                    if (editButtons) {
                        editButtons.forEach(btn => btn.style.display = 'none');
                    }
                } else {
                    editForm.classList.add('hidden');
                    reviewContent.classList.remove('hidden');

                    // Tampilkan kembali tombol edit/delete
                    if (editButtons) {
                        editButtons.forEach(btn => btn.style.display = 'flex');
                    }
                }
            }
        </script>
    @endsection
@else
    @extends('layouts.navbar')

    @section('content')
        <div class="bg-gray-900 min-h-screen pt-16">
            <div class="container mx-auto px-4 py-8">
                <a href="{{ url()->previous() }}"
                    class="inline-flex items-center px-4 py-2 my-6 bg-gray-800 border border-cyan-500/30 rounded-md text-cyan-400 hover:bg-cyan-500/10 hover:text-cyan-300 transition-colors">
                    <i class="fas fa-arrow-left mr-2 transition-all"></i>
                    <span>Kembali</span>
                </a>
                <div class="flex flex-col md:flex-row gap-8">
                    <!-- Poster -->
                    <div class="w-full md:w-1/3">
                        <div class="rounded-xl overflow-hidden border-2 border-cyan-500/50 shadow-lg shadow-cyan-500/20">
                            @if ($movie->poster)
                                <img src="{{ asset('storage/' . $movie->poster) }}" alt="{{ $movie->title }}"
                                    class="w-full h-auto object-cover">
                            @else
                                <div class="w-full h-96 bg-gray-700 flex items-center justify-center">
                                    <span class="text-gray-500">No poster available</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Movie Info -->
                    <div class="w-full md:w-2/3 text-white">
                        <h1 class="text-3xl font-bold font-orbitron mb-2">
                            {{ $movie->title }}
                        </h1>

                        <!-- Rating and Genre -->
                        <div class="flex items-center gap-4 mb-6">
                            <div class="flex items-center bg-gray-800/80 px-3 py-1 rounded-full">
                                <i class="fas fa-star text-yellow-400 mr-2"></i>
                                <span>
                                    @if ($movie->userReviews->count() > 0)
                                        {{ number_format($movie->review_rating, 1) }}/10
                                        <span class="text-gray-400 ml-1">({{ $movie->userReviews->count() }} reviews)</span>
                                    @else
                                        No ratings yet
                                    @endif
                                </span>
                            </div>

                            <!-- Tambahkan bintang visual -->
                            <div class="flex items-center">
                                @php
                                    $rating = $movie->review_rating ?? 0;
                                    $fullStars = floor($rating);
                                    $hasHalfStar = $rating - $fullStars >= 0.5;
                                @endphp

                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $fullStars)
                                        <i class="fas fa-star text-yellow-400 mx-0.5"></i>
                                    @elseif($i == $fullStars + 1 && $hasHalfStar)
                                        <i class="fas fa-star-half-alt text-yellow-400 mx-0.5"></i>
                                    @else
                                        <i class="far fa-star text-yellow-400 mx-0.5"></i>
                                    @endif
                                @endfor
                            </div>
                        </div>

                        <!-- Purchase/Watch Button -->
                        <div class="mb-8">
                            @auth
                                @if (auth()->user()->hasAlreadyPurchased($movie->id))
                                    <div class="flex gap-4">
                                        <a href="#"
                                            class="inline-block px-6 py-3 bg-gradient-to-r from-green-500 to-cyan-500 rounded-md text-white font-bold hover:shadow-lg hover:shadow-green-500/30 transition-all">
                                            <i class="fas fa-play mr-2"></i> Watch Now
                                        </a>
                                        <div class="flex items-center bg-gray-800/80 px-4 rounded-full border border-cyan-500/30">
                                            <i class="fas fa-check-circle text-green-400 mr-2"></i>
                                            <span>Purchased</span>
                                        </div>
                                    </div>
                                @else
                                    <a href="{{ route('checkout-show', $movie->id) }}"
                                        class="inline-block px-6 py-3 bg-gradient-to-r from-cyan-500 to-pink-500 rounded-md text-white font-bold hover:shadow-lg hover:shadow-cyan-500/30 transition-all">
                                        <i class="fas fa-shopping-cart mr-2"></i> Buy for {{ number_format($movie->price, 2) }} CR
                                    </a>
                                @endif
                            @else
                                <a href="{{ route('login') }}"
                                    class="inline-block px-6 py-3 bg-gradient-to-r from-cyan-500 to-pink-500 rounded-md text-white font-bold hover:shadow-lg hover:shadow-cyan-500/30 transition-all">
                                    <i class="fas fa-shopping-cart mr-2"></i> Buy for {{ number_format($movie->price, 2) }} CR
                                </a>
                            @endauth
                        </div>

                        <!-- Description -->
                        <div class="mb-8">
                            <h2 class="text-xl font-bold font-orbitron mb-2 text-cyan-400">
                                DESCRIPTION
                            </h2>
                            <p class="text-gray-300">
                                {{ $movie->description }}
                            </p>
                        </div>

                        <!-- Additional Info for Purchased Users -->
                        @auth
                            @if (auth()->user()->hasAlreadyPurchased($movie->id))
                                <div class="mb-8">
                                    <h2 class="text-xl font-bold font-orbitron mb-2 text-pink-500">
                                        YOUR ACCESS
                                    </h2>
                                    <div class="bg-gray-800/50 border border-cyan-500/20 rounded-xl p-4">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="text-gray-300">Purchase Date</p>
                                                <p class="text-cyan-400">{{ auth()->user()->getPurchaseDate($movie->id) }}</p>
                                            </div>
                                            <div>
                                                <p class="text-gray-300">License</p>
                                                <p class="text-cyan-400">Permanent</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endauth

                        <!-- Writer -->
                        <div class="mb-8">
                            <h2 class="text-xl font-bold font-orbitron mb-2 text-pink-500">
                                WRITTEN BY
                            </h2>
                            <p class="text-gray-300">
                                {{ $movie->writer ?? 'No writer' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="reviews-container">
                    <div class="mt-12">
                        <h2 class="text-2xl font-bold font-orbitron mb-6 text-white">
                            USER REVIEWS
                        </h2>
                    </div>

                    @auth
                        @if (auth()->user()->hasAlreadyPurchased($movie->id))
                            @if (!auth()->user()->hasReviewed($movie->id))
                                <!-- Form Review -->
                                <div class="bg-gray-800/50 border border-cyan-500/30 rounded-xl p-6 mb-6">
                                    <h3 class="text-xl font-bold font-orbitron mb-4 text-cyan-400">ADD YOUR REVIEW</h3>
                                    <form action="{{ route('reviews.store', $movie->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="movie_id" value="{{ $movie->id }}">

                                        <!-- Rating Input -->
                                        <div x-data="{ rating: 0, hoverRating: 0 }" class="mb-4">
                                            <label class="block text-gray-400 mb-2">Your Rating</label>
                                            <div class="flex items-center">
                                                @for ($i = 1; $i <= 10; $i++)
                                                    <button type="button" @mouseenter="hoverRating = {{ $i }}"
                                                        @mouseleave="hoverRating = rating" @click="rating = {{ $i }}"
                                                        :class="{
                                                            'text-yellow-400': {{ $i }} <= (hoverRating ||
                                                                rating),
                                                            'text-gray-400': {{ $i }} > (hoverRating ||
                                                                rating)
                                                        }"
                                                        class="text-2xl cursor-pointer focus:outline-none">
                                                        <i class="fas fa-star"></i>
                                                    </button>
                                                    <input type="hidden" name="rating" x-model="rating">
                                                @endfor
                                            </div>
                                            @error('rating')
                                                <span class="text-red-400 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-4">
                                            <label class="block text-gray-400 mb-2">Your Review</label>
                                            <textarea name="review" rows="4"
                                                class="w-full px-4 py-2 bg-gray-700 border border-cyan-500/30 rounded-md text-white"
                                                placeholder="Share your thoughts..." required>{{ old('review') }}</textarea>
                                            @error('review')
                                                <span class="text-red-400 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <button type="submit"
                                            class="cursor-pointer px-6 py-2 bg-gradient-to-r from-cyan-500 to-pink-500 rounded-md text-white font-bold">
                                            Submit Review
                                        </button>
                                    </form>
                                </div>
                            @else
                                {{-- @if (session('success'))
                                    <script>
                                        import Swal from 'sweetalert2'

                                        const Swal = require('sweetalert2')

                                        document.addEventListener('DOMContentLoaded', function() {
                                            Swal.fire({
                                                position: 'center',
                                                icon: 'success',
                                                title: 'Review Submitted!',
                                                text: 'Your review has been posted successfully',
                                                showConfirmButton: false,
                                                timer: 2500,
                                                background: '#1f2937',
                                                color: '#ffffff',
                                                iconColor: '#06b6d4'
                                            });
                                        });
                                    </script>
                                @endif --}}
                            @endif
                        @else
                            <!-- Notifikasi Belum Membeli -->
                            <button id="warnButton"
                                class="cursor-pointer my-6 px-4 py-2 bg-gray-800 border border-cyan-500/30 rounded-md text-cyan-400 hover:bg-cyan-500/10 transition-colors">
                                <i class="fas fa-plus mr-2"></i> Add Your Review
                            </button>
                        @endif
                    @else
                        <!-- Notifikasi Login -->
                        <div class="bg-gray-800/50 border border-cyan-500/30 rounded-xl p-6 text-center my-6">
                            <div class="w-16 h-16 mx-auto mb-4 bg-cyan-500/10 rounded-full flex items-center justify-center">
                                <i class="fas fa-user-lock text-cyan-400 text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-bold mb-2 text-cyan-400">Login Required</h3>
                            <p class="text-gray-400 mb-4">Please login to submit a review</p>
                            <a href="{{ route('login') }}"
                                class="inline-block px-6 py-2 bg-gradient-to-r from-cyan-500 to-pink-500 rounded-md text-white font-medium">
                                Login Now
                            </a>
                        </div>
                    @endauth
                    <!-- Di bagian tampilan reviews -->
                    <!-- Tampilkan review baru jika ada di session -->
                    @if (session('new_review'))
                        <div class="bg-gray-800/50 border border-cyan-500/20 rounded-xl p-6 mb-6 mt-6">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center mr-4">
                                    <i class="fas fa-user text-cyan-400"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold">{{ session('new_review.user.name') }}</h4>
                                    <div class="flex items-center text-sm text-gray-400">
                                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                                        <span>{{ session('new_review.rating') }}</span>
                                        <span class="mx-2">•</span>
                                        <span>Just now</span>
                                    </div>
                                </div>
                            </div>
                            <p class="text-gray-300">"{{ session('new_review.review') }}"</p>
                        </div>
                    @endif

                    <div class="reviews-container">
                        @foreach ($movie->userReviews as $review)
                            <div class="bg-gray-800/50 border border-cyan-500/20 rounded-xl p-6 mt-6">
                                <div class="flex items-center mb-4">
                                    <div class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center mr-4">
                                        <i class="fas fa-user text-cyan-400"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-white">{{ $review->name ?? 'No name' }}</h4>
                                        <div class="flex items-center text-sm text-gray-400">
                                            <i class="fas fa-star text-yellow-400 mr-1"></i>
                                            <span>{{ $review->pivot->rating }}/10</span>
                                            <span class="mx-2">•</span>
                                            <span>{{ \Carbon\Carbon::parse($review->pivot->created_at)->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-gray-300">"{{ $review->pivot->review }}"</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endsection

@endauth
