<?php

use App\Http\Controllers\API\MovieController as APIMovieController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserController;
use App\Models\Movie;

Route::get('/', function () {
    $movies = Movie::all();
    return view('welcome', compact('movies'));
});

// User Authentication Routes
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Movie Routes
Route::resource('movies', APIMovieController::class);

// // User Dashboard Routes
// Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
// Route::get('/my-movies', [UserController::class, 'myMovies'])->name('my.movies');
