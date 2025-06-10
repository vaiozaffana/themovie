<?php

use App\Http\Controllers\api\movieController as ApiMovieController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\routeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\web\actions\ReviewController;
use App\Http\Controllers\web\auth\authController as webAuthController;
use App\Http\Controllers\web\movieController as webMovieController;
use App\Http\Controllers\web\moviePurchasedController;
use App\Models\Movie;

Route::resource('movies', webAuthController::class);
Route::get('/', function () {
    $movies = Movie::all();
    return view('home', compact('movies'));
});
Route::get('/register', [webAuthController::class, "showRegister"])->name('register');
Route::post('/register', [webAuthController::class, "register"]);
Route::get('/login', [webAuthController::class, "showLogin"])->name('login');
Route::post('/login', [webAuthController::class, "login"]);

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/dashboard-data', function () {
        return view('admin.dashboard-data');
    })->name('admin.dashboard-data');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $movies = Movie::all();
        return view('user.dashboard', compact('movies'));
    })->name('dashboard');
    Route::get('/checkout/{id}', [PaymentController::class, 'showCheckout'])
        ->name('checkout-show');

    // Proses pembayaran
    Route::post('/checkout/{id}/process', [PaymentController::class, 'processPayment'])
        ->name('checkout-process');
    Route::get('/my-movies', [moviePurchasedController::class, 'myMovies'])
        ->name('my-movies');

    Route::post('/movies/{movie}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::put('/reviews/{id}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

Route::get('/payment/success/{id}', [PaymentController::class, 'paymentSuccess'])
    ->name('payment.success');
// Route::get('/movie-detail/{id}', [webMovieController::class, 'showDetailMovie'])->name('detail');
Route::get('/movie-detail/{id}', [webMovieController::class, 'showDetailMovie'])->name('detail');
Route::get('/my-movies', [moviePurchasedController::class, "MyMovies"])->name('my-movies');

Route::post('/logout', [webAuthController::class, 'logout'])->name('logout');
Route::get('/dashboard-movies', [webMovieController::class, 'index'])->name('dashboard-movies');

// Route::get('/movies/{id}', function($id) {
//     $movies = Movie::findOrFail($id);

//     $user = auth()->user();
//     $hasPurchased = false;

//     if ($user) {
//         $hasPurchased = $user->purchases()->where('movie_id', $movies->id)->exists();
//     }
//     return view('movie.show', compact('movies', 'hasPurchased'));
// });

// Route::get('/', [APIMovieController::class, "index"]);

// User Authentication Routes
// Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
// Route::post('/register', [AuthController::class, 'register']);
// Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
// Route::post('/login', [AuthController::class, 'login']);
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Movie Routes
