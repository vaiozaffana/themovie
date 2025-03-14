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

    public function users()
{
    return $this->belongsToMany(User::class, 'user_movies')->withPivot('rating', 'review');
}

}
