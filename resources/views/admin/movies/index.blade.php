@extends('admin.layouts.app')

@section('title', 'Manage Movies')

@section('content')
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-6 border-b border-gray-200 flex justify-between items-center">
        <h2 class="text-xl font-semibold text-gray-800">All Movies</h2>
        <a href="{{ route('admin.movies.create') }}" class="px-4 py-2 bg-cyan-600 text-white rounded-md hover:bg-cyan-700 transition-colors">
            <i class="fas fa-plus mr-2"></i> Add Movie
        </a>
    </div>

<div class="px-4">
    <div class="overflow-x-auto max-w-full border border-gray-200 over" >
        <table class="min-w-[1000px] w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Poster</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Genre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Purchases</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($movies as $movie)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="h-12 w-12 rounded overflow-hidden">
                            @if($movie->poster)
                            <img src="{{ asset('storage/' . $movie->poster) }}" alt="{{ $movie->title }}" class="h-full w-full object-cover">
                            @else
                            <div class="h-full w-full bg-gray-200 flex items-center justify-center">
                                <i class="fas fa-film text-gray-400"></i>
                            </div>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $movie->title }}</div>
                        <div class="text-sm text-gray-500">{{ Str::limit($movie->writer, 20) }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $movie->genre }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($movie->price, 2) }} CR</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <span class="text-sm font-medium mr-2">{{ number_format($movie->avg_rating, 1) }}</span>
                            <div class="flex">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star text-{{ $i <= round($movie->avg_rating) ? 'yellow-400' : 'gray-300' }} text-xs"></i>
                                @endfor
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $movie->purchases_count }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('admin.movies.edit', $movie) }}" class="text-cyan-600 hover:text-cyan-900 mr-3">Edit</a>
                        <form action="{{ route('admin.movies.delete', $movie) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
        {{ $movies->links() }}
    </div>
</div>
@endsection
