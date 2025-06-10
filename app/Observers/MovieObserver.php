<?php

namespace App\Observers;

use App\Models\Movie;

class MovieObserver
{
    public function updating(Movie $movie): void
    {
        if ($movie->isDirty('review_rating')) {
            $movie->review_count = $movie->userReviews()->count();
        }
    }

}
