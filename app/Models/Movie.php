<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'poster',
        'writer',
        'description',
        'review_rating',
        'genre',
        'price',
    ];

    public function userReviews()
    {
        return $this->belongsToMany(User::class, 'user_movies')
            ->whereNotNull('rating')
            ->withPivot(['id', 'rating', 'review', 'created_at'])
            ->orderBy('user_movies.created_at', 'desc');
    }

    public function updateAverageRating()
    {
        $this->review_rating = $this->reviews()->avg('rating');
        $this->review_rating = $average ?? 0;
        $this->save();
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_movies')->withPivot('rating', 'review');
    }
}
