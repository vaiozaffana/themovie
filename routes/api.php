<?php

use App\Http\Controllers\API\MovieController as APIMovieController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\MoviePurchaseController;
use App\Http\Controllers\UserController;

// User Authentication Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group( function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/movies/{id}/buy', [MoviePurchaseController::class, 'buyMovie']);
    Route::post('/movies/{id}/review', [MoviePurchaseController::class, 'reviewMovie']);
    Route::delete('/movies/{id}/delete', [MoviePurchaseController::class, 'deleteMovie']);
});


Route::middleware('auth:sanctum', 'admin')->group( function () {
    Route::post('/movies', [APIMovieController::class, 'store']);
    Route::put('/movies/{id}', [APIMovieController::class, 'update']);
    Route::delete('/movies/{id}', [APIMovieController::class, 'destroy']);
});

Route::get('/movies', [APIMovieController::class, 'index']);
Route::get('/movies/{id}', [APIMovieController::class,'show']);