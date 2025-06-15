@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Stats Cards -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-cyan-100 text-cyan-600 mr-4">
                <i class="fas fa-users text-xl"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500">Total Users</p>
                <h3 class="text-2xl font-bold">{{ $stats['total_users'] }}</h3>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-pink-100 text-pink-600 mr-4">
                <i class="fas fa-film text-xl"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500">Total Movies</p>
                <h3 class="text-2xl font-bold">{{ $stats['total_movies'] }}</h3>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4">
                <i class="fas fa-shopping-cart text-xl"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500">Total Purchases</p>
                <h3 class="text-2xl font-bold">{{ $stats['total_purchases'] }}</h3>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                <i class="fas fa-star text-xl"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500">Total Reviews</p>
                <h3 class="text-2xl font-bold">{{ $stats['total_reviews'] }}</h3>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity -->
{{-- <div class="bg-white rounded-lg shadow p-6">
    <h3 class="text-lg font-semibold mb-4">Recent Activity</h3>
    <!-- Activity content here -->
</div> --}}
@endsection
