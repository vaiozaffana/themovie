@extends('admin.layouts.app')

@section('title', 'Edit Movie')

@section('content')
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-6 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-800">Edit Movie: {{ $movie->title }}</h2>
    </div>

    <form action="{{ route('admin.movies.update', $movie) }}" method="POST" enctype="multipart/form-data" class="p-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Left Column -->
            <div>
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $movie->title) }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-cyan-500 focus:border-cyan-500">
                </div>

                <div class="mb-4">
                    <label for="writer" class="block text-sm font-medium text-gray-700 mb-1">Writer</label>
                    <input type="text" name="writer" id="writer" value="{{ old('writer', $movie->writer) }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-cyan-500 focus:border-cyan-500">
                </div>

                <div class="mb-4">
                    <label for="genre" class="block text-sm font-medium text-gray-700 mb-1">Genre</label>
                    <input type="text" name="genre" id="genre" value="{{ old('genre', $movie->genre) }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-cyan-500 focus:border-cyan-500">
                </div>

                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price (CR)</label>
                    <input type="number" step="0.01" min="0" name="price" id="price" value="{{ old('price', $movie->price) }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-cyan-500 focus:border-cyan-500">
                </div>
            </div>

            <!-- Right Column -->
            <div>
                <div class="mb-4">
                    <label for="poster" class="block text-sm font-medium text-gray-700 mb-1">Poster</label>
                    @if($movie->poster)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $movie->poster) }}" alt="{{ $movie->title }}" class="h-40 rounded-md">
                    </div>
                    @endif
                    <input type="file" name="poster" id="poster" accept="image/*"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-cyan-500 focus:border-cyan-500">
                    <p class="mt-1 text-sm text-gray-500">Leave empty to keep current poster</p>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" id="description" rows="5" required
                              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-cyan-500 focus:border-cyan-500">{{ old('description', $movie->description) }}</textarea>
                </div>
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <a href="{{ route('admin.movies') }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 mr-3">
                Cancel
            </a>
            <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                Update Movie
            </button>
        </div>
    </form>
</div>
@endsection
