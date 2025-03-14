<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MoviePurchaseController extends Controller
{
    public function buyMovie($id)
    {
        $user = auth()->user();
        $movie = Movie::findOrFail($id);

        if ($user->movies()->where('movie_id', $id)->exists()) {
            return response()->json([
                'status' => 'error',
                'code' => 400,
                'message' => 'You have already purchased this movie.'
            ], 400);
        }

        $user->movies()->attach($movie->id);

        return response()->json([
            'status' => 'success',
            'code' => 201,
            'message' => 'Movie purchased successfully!'
        ], 201);
    }

    public function reviewMovie(Request $request, $id)
    {
        $user = auth()->user();
        $movie = Movie::findOrFail($id);

        if (!$user->movies()->where('movie_id', $id)->exists()) {
            return response()->json([
                'status' => 'error',
                'code' => 403,
                'message' => 'You can only review movies you have purchased.'
            ], 403);
        }

        $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'review' => 'required|string',
        ]);

        $user->movies()->updateExistingPivot($id, [
            'rating' => $request->rating,
            'review' => $request->review
        ]);

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Review submitted successfully',
            'data' => [
                'movie_id' => $id,
                'user_id' => $user->id,
                'rating' => $request->rating,
                'review' => $request->review
            ]
        ], 200);
    }


public function deleteMovie($id)
{
    $user = auth()->user();
    $movie = Movie::findOrFail($id);
    if (!$movie) {
        return response()->json([
            'status' => 'error',
            'code' => 404,
            'message' => 'Movie not found.'
        ], 404);
    }

    if (!$user->movies()->where('movie_id', $id)->exists()) {
        return response()->json([
            'status' => 'error',
            'code' => 403,
            'message' => 'You cannot delete a movie you haven\'t purchased.'
        ], 403);
    }

    $user->movies()->detach($id);

    return response()->json([
        'status' => 'success',
        'code' => 200,
        'message' => 'Movie removed from your collection.'
    ], 200);
}


}
