<?php

use App\Http\Controllers\api\auth\authController as apiAuthController;
use App\Http\Controllers\api\movieController as apiMovieController;
use App\Http\Controllers\api\moviePurchaseController as apiMoviePurchaseController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [apiAuthController::class, 'register']);
Route::post('/login', [apiAuthController::class, 'login']);

Route::middleware('auth:sanctum')->group( function () {
    Route::post('/logout', [apiAuthController::class, 'logout']);
    Route::post('/movies/{id}/buy', [apiMoviePurchaseController::class, 'buyMovie']);
    Route::post('/movies/{id}/review', [apiMoviePurchaseController::class, 'reviewMovie']);
    Route::delete('/movies/{id}/delete', [apiMoviePurchaseController::class, 'deleteMovie']);
});


Route::middleware('auth:sanctum', 'admin')->group( function () {
    Route::post('/movies', [apiMovieController::class, 'store']);
    Route::put('/movies/{id}', [apiMovieController::class, 'update']);
    Route::delete('/movies/{id}', [apiMovieController::class, 'destroy']);
});

Route::get('/movies', [apiMovieController::class, 'index']);
Route::get('/movies/{id}', [apiMovieController::class,'show'])->name('movies.show');
