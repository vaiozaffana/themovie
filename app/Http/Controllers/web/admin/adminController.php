<?php

namespace App\Http\Controllers\web\admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class adminController extends Controller implements HasMiddleware
{

    public static function middleware() {
        return [
            'auth',
            'admin',
        ];
    }

    // Dashboard Overview
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_movies' => Movie::count(),
            'total_purchases' => DB::table('user_purchases')->count(),
            'total_reviews' => DB::table('user_movies')->whereNotNull('review')->count()
        ];

        return view('admin.dashboard', compact('stats'));
    }

    // Users Management
    public function users()
    {
        $users = User::withCount(['purchasedMovies', 'movieReviews'])
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function userDetail(User $user)
    {
        $purchases = $user->purchasedMovies()
                        ->withPivot('purchased_at', 'price')
                        ->latest('purchased_at')
                        ->paginate(5, ['*'], 'purchases');

        $reviews = $user->movieReviews()
                      ->withPivot('rating', 'review', 'created_at')
                      ->latest('user_movies.created_at')
                      ->paginate(5, ['*'], 'reviews');

        return view('admin.users.detail', compact('user', 'purchases', 'reviews'));
    }

    // Movies Management
    public function movies()
    {
        $movies = Movie::select('*')
            ->selectSub(function ($query) {
                $query->from('user_purchases')
                      ->selectRaw('count(*)')
                      ->whereColumn('user_purchases.movie_id', 'movies.id');
            }, 'purchases_count')
            ->selectSub(function ($query) {
                $query->from('user_movies')
                      ->selectRaw('avg(user_movies.rating)')
                      ->whereColumn('user_movies.movie_id', 'movies.id')
                      ->whereNotNull('user_movies.rating');
            }, 'avg_rating')
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('admin.movies.index', compact('movies'));
    }


    public function createMovie()
    {
        return view('admin.movies.create');
    }

    public function storeMovie(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'poster' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'writer' => 'required|string|max:255',
            'description' => 'required|string',
            'genre' => 'required|string|max:100',
            'price' => 'required|numeric|min:0'
        ]);

        $posterPath = $request->file('poster')->store('posters', 'public');

        Movie::create([
            'title' => $validated['title'],
            'poster' => $posterPath,
            'writer' => $validated['writer'],
            'description' => $validated['description'],
            'genre' => $validated['genre'],
            'price' => $validated['price'],
            'review_rating' => 0,
            'review_count' => 0
        ]);

        return redirect()->route('admin.movies')->with('success', 'Movie created successfully!');
    }

    public function editMovie(Movie $movie)
    {
        return view('admin.movies.edit', compact('movie'));
    }

    public function updateMovie(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'writer' => 'required|string|max:255',
            'description' => 'required|string',
            'genre' => 'required|string|max:100',
            'price' => 'required|numeric|min:0'
        ]);

        if ($request->hasFile('poster')) {
            Storage::disk('public')->delete($movie->poster);
            $posterPath = $request->file('poster')->store('posters', 'public');
            $validated['poster'] = $posterPath;
        }

        $movie->update($validated);

        return redirect()->route('admin.movies')->with('success', 'Movie updated successfully!');
    }

    public function deleteMovie(Movie $movie)
    {
        Storage::disk('public')->delete($movie->poster);
        $movie->delete();

        return redirect()->route('admin.movies')->with('success', 'Movie deleted successfully!');
    }
}
