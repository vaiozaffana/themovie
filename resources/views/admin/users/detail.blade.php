@extends('admin.layouts.app')

@section('title', 'User Details')

@section('content')
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-6 border-b border-gray-200">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">{{ $user->name }}</h2>
            <span class="px-3 py-1 rounded-full text-sm font-medium bg-{{ $user->role === 'admin' ? 'purple' : 'blue' }}-100 text-{{ $user->role === 'admin' ? 'purple' : 'blue' }}-800">
                {{ ucfirst($user->role) }}
            </span>
        </div>
        <p class="text-gray-600 mt-1">{{ $user->email }}</p>
    </div>

    <div class="p-6">
        <div class="mb-8">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Purchase History</h3>

            @if($purchases->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Movie</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($purchases as $purchase)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $purchase->title }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ number_format($purchase->pivot->price, 2) }} CR
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($purchase->pivot->purchased_at)->format('M d, Y h:i A') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $purchases->links() }}
            </div>
            @else
            <p class="text-gray-500">No purchases found.</p>
            @endif
        </div>

        <div>
            <h3 class="text-lg font-medium text-gray-900 mb-4">Movie Reviews</h3>

            @if($reviews->count() > 0)
            <div class="space-y-4">
                @foreach($reviews as $review)
                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <h4 class="font-medium text-gray-900">{{ $review->title }}</h4>
                            <div class="flex items-center mt-1">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $review->pivot->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                @endfor
                            </div>
                        </div>
                        <span class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($review->pivot->created_at)->format('M d, Y') }}</span>
                    </div>
                    <p class="mt-2 text-gray-600">{{ $review->pivot->review }}</p>
                </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $reviews->links() }}
            </div>
            @else
            <p class="text-gray-500">No reviews found.</p>
            @endif
        </div>
    </div>
</div>
@endsection
