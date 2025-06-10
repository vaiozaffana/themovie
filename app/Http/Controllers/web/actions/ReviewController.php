<?php

namespace App\Http\Controllers\web\actions;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function store(Request $request, $movieId)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|between:1,10',
            'review' => 'required|string|max:1000'
        ]);

        $user = auth()->user();
        $movie = Movie::findOrFail($movieId);

        DB::transaction(function () use ($user, $movie, $validated) {


            $user->movieReviews()->syncWithoutDetaching([
                $movie->id => [
                    'rating' => $validated['rating'],
                    'review' => $validated['review'],
                    'created_at' => now()
                ]
            ]);

            $averageRating = $user->movieReviews()
                ->where('movie_id', $movie->id)
                ->avg('rating');

            // Update rating di tabel movies
            $movie->update([
                'review_rating' => round($averageRating, 1),
                'review_count' => $movie->userReviews()->count()
            ]);
        });

        // Cek apakah user sudah membeli film
        if (!$user->hasAlreadyPurchased($movieId)) {
            return back()->with('error', 'You need to purchase this movie first');
        }

        // Cek apakah sudah pernah review
        if ($user->hasReviewed($movieId)) {
            return back()->with('error', 'You have already reviewed this movie');
        }

        $user->movieReviews()->updateExistingPivot($movieId, [
            'rating' => $validated['rating'],
            'review' => $validated['review'],
            'updated_at' => now()
        ]);

        $movie->updateAverageRating();

        return redirect()->route('detail', $movieId)
            ->with([
                'success' => 'Review submitted successfully!'
            ]);
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'rating' => 'required|integer|between:1,10',
        'review' => 'required|string|max:1000'
    ]);

    $review = DB::table('user_movies')
                ->where('id', $id)
                ->where('user_id', auth()->id())
                ->first();

    abort_if(!$review, 403, 'Review not found');

    DB::table('user_movies')
        ->where('id', $id)
        ->update([
            'rating' => $request->rating,
            'review' => $request->review,
            'updated_at' => now()
        ]);

    return back()->with('success', 'Review updated!');
}

public function destroy($id)
{
    $review = DB::table('user_movies')
                ->where('id', $id)
                ->where('user_id', auth()->id())
                ->first();

    abort_if(!$review, 404, 'Review not found');

    DB::table('user_movies')
        ->where('id', $id)
        ->delete();

    return back()->with('success', 'Review deleted!');
}
}
