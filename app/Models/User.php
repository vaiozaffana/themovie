<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    public function movieReviews(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class, 'user_movies')
                    ->whereNotNull('review')
                    ->withPivot(['id', 'rating', 'review', 'created_at']);
    }

    // app/Models/User.php
    public function getPurchaseDate($movieId)
    {
        $purchase = $this->purchasedMovies()
            ->where('movie_id', $movieId)
            ->first();

        return $purchase ? $purchase->pivot->created_at->format('M d, Y') : null;
    }

    public function purchasedMoviesExists()
    {
        return $this->belongsToMany(Movie::class, 'user_movies')
            ->withPivot(['rating', 'review', 'reviewed_at']);
    }

    public function hasAlreadyPurchased($movieId)
    {
        return $this->purchasedMovies()
            ->where('movie_id', $movieId)
            ->exists();
    }

    public function hasPurchased($movieId)
    {
        return $this->purchasedMoviesExists()->where('movie_id', $movieId)->exists();
    }

    public function hasReviewed($movieId)
    {
        return $this->purchasedMoviesExists()
            ->where('movie_id', $movieId)
            ->whereNotNull('review')
            ->exists();
    }

    public function purchasedMovies()
    {
        return $this->belongsToMany(Movie::class, 'user_purchases')
            ->withPivot('purchased_at', 'price')
            ->withTimestamps();
    }
}
