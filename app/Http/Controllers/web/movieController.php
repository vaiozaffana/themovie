<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class movieController extends Controller
{
    public function getMovies()
    {
        // try {
        //     $res = Http::get('http://127.0.0.1:8000/api/movies');
        //     $data = $res->json();

        //     if (!isset($movies['movies'])) {
        //         throw new \Exception('Movies data not found.');
        //     }

        //     return view('user.dashboard', [
        //         'movies' => $data['movies'] ?? [],
        //     ]);

        // } catch (\Exception $e) {
        //     return back()->with('error: Failed to load movies: ' . $e->getMessage());
        // }
        // $client = new Client();
        // $apiUrl = 'http://localhost:8000/api/movies';


        // try {
        //     $res = $client->request('GET', $apiUrl);
        //     $data = json_decode($res->getBody(), true);
        //     return view('user.dashboard', ['movies' => $data]);
        // } catch (\Exception $e) {
        //     return view('api.error-handling', ['error' => $e->getMessage()]);
        // }
        $response = Http::get('http://localhost:8000/api/movies');

        if ($response->successful()) {
            $movies = $response->json();
            return view('home', compact('movies'));
        } else {
            return view('home')->with('error', 'Gagal mengambil data dari API');
        }
    }

    public function showDetailMovie($id, Request $request) {
        $movie = Movie::findOrFail($id);

        return view('user.show', compact('movie'));
    }

    public function showPayment() {
        return view('user.payment');
    }
}
