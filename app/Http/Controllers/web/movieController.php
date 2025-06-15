<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class movieController extends Controller
{

    public function index() {
        $movies = Movie::paginate(3);

        return view('home', compact('movies'));

    }

    public function dashboard()
    {
        $movies = Movie::paginate(3);
        return view('user.dashboard', compact('movies'));
    }

    public function search(Request $request)
{
    $query = $request->query('query');

    $movies = Movie::where('title', 'LIKE', "%$query%")->get();

    $html = view('partials.movies', compact('movies'))->render();

    return response()->json(['html' => $html]);
}

    public function filter(Request $request)
{
    $filter = $request->get('filter');
    $query = Movie::query();

    switch ($filter) {
        case 'new':
            $query->orderBy('release_year', 'desc');
            break;
        case 'top':
            $query->orderBy('review_rating', 'desc');
            break;
        case 'az':
            $query->orderBy('title', 'asc');
            break;
        case 'za':
            $query->orderBy('title', 'desc');
            break;
    }

    $movies = $query->take(9)->get();

    $html = view('partials.movies', compact('movies'))->render();

    return response()->json(['html' => $html]);
}

    public function showDetailMovie($id, Request $request) {
        $movie = Movie::findOrFail($id);

        return view('user.show', compact('movie'));
    }

    public function showPayment() {
        return view('user.payment');
    }
}
