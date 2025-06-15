<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];

    public function getRouteKeyName()
    {
        return 'slug'; // Gunakan slug sebagai route key
    }

    public function movies() {
        return $this->belongsToMany(Movie::class, 'movie_genre');
    }
}
