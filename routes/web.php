<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\web\actions\ReviewController;
use App\Http\Controllers\web\admin\adminController as adminWebController;
use App\Http\Controllers\web\auth\authController as webAuthController;
use App\Http\Controllers\web\movieController as webMovieController;
use App\Http\Controllers\web\moviePurchasedController;
use App\Models\Movie;

Route::get('/', [webMovieController::class, 'index']);
Route::get('/movies/search', [webMovieController::class, 'search'])->name('movies.search');

Route::get('/movies/filter', [webMovieController::class, 'filter'])->name('movies.filter');
Route::get('/register', [webAuthController::class, "showRegister"])->name('register');
Route::post('/register', [webAuthController::class, "register"]);
Route::get('/login', [webAuthController::class, "showLogin"])->name('login');
Route::post('/login', [webAuthController::class, "login"]);

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [adminWebController::class, 'dashboard'])->name('dashboard');

    // Users
    Route::get('/users', [adminWebController::class, 'users'])->name('users');
    Route::get('/users/{user}', [adminWebController::class, 'userDetail'])->name('users.detail');

    // Movies
    Route::get('/movies', [adminWebController::class, 'movies'])->name('movies');
    Route::get('/movies/create', [adminWebController::class, 'createMovie'])->name('movies.create');
    Route::post('/movies', [adminWebController::class, 'storeMovie'])->name('movies.store');
    Route::get('/movies/{movie}/edit', [adminWebController::class, 'editMovie'])->name('movies.edit');
    Route::put('/movies/{movie}', [adminWebController::class, 'updateMovie'])->name('movies.update');
    Route::delete('/movies/{movie}', [adminWebController::class, 'deleteMovie'])->name('movies.delete');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [webMovieController::class, 'dashboard'])->name('dashboard');
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

Route::get('/movie-detail/{id}', [webMovieController::class, 'showDetailMovie'])->name('detail');
Route::get('/my-movies', [moviePurchasedController::class, "MyMovies"])->name('my-movies');

Route::post('/logout', [webAuthController::class, 'logout'])->name('logout');
// Route::get('/dashboard-movies', [webMovieController::class, 'index'])->name('dashboard-movies');
