<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'poster' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'writer' => 'required|string|max:255',
            'description' => 'required|string',
            'genre' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $posterPath = $request->file('poster')->store('posters', 'public');

        $movie = Movie::create([
            'title' => $request->title,
            'poster' => $posterPath,
            'writer' => $request->writer,
            'description' => $request->description,
            'review_rating' => 0,
            'genre' => $request->genre,
            'price' => $request->price,
        ]);

        return response()->json([
            'status' => 'success',
            'code' => 201,
            'message' => 'Movie created successfully',
            'movie' => $movie
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);

        if (!$movie) {
            return response()->json([
                'status' => 'error',
                'code' => 404,
                'message' => 'Movie not found'
            ], 404);
        }

        $request->validate([
            'title' => 'sometimes|string|max:255',
            'poster' => 'sometimes|image|mimes:jpg,jpeg,png|max:2048',
            'writer' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'genre' => 'sometimes|string|max:255',
            'price' => 'sometimes|numeric|min:0',
        ]);

        if ($request->hasFile('poster')) {
            Storage::disk('public')->delete($movie->poster);
            $posterPath = $request->file('poster')->store('posters', 'public');
            $movie->poster = $posterPath;
        }

        $movie->update($request->only(['title', 'writer', 'description', 'genre', 'price']));

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Movie updated successfully',
            'movie' => $movie
        ], 200);
    }

    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);

        if (!$movie) {
            return response()->json([
                'status' => 'error',
                'code' => 404,
                'message' => 'Movie not found'
            ], 404);
        }

        Storage::disk('public')->delete($movie->poster);

        $movie->delete();

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Movie deleted successfully'
        ], 200);
    }

    public function index(Request $request)
    {
        $movies = Movie::all();

        $query = Movie::query();
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        if ($request->has('genre')) {
            $query->where('genre', 'like', '%' . $request->genre . '%');
        }
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'asc':
                    $query->orderBy('title', 'asc');
                    break;
                case 'desc':
                    $query->orderBy('title', 'desc');
                    break;
                case 'highest_rating':
                    $query->orderBy('review_rating', 'desc');
                    break;
                case 'lowest_rating':
                    $query->orderBy('review_rating', 'asc');
                    break;
                default:
                    break;
            }
        }

        $movies = $query->paginate(10);

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'movies' => $movies
        ], 200);
    }

    public function show($id)
    {
        $movie = Movie::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'movie' => $movie
        ], 200);
    }
}
