<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Movie;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        // Create some movies
        Movie::create([
            "title" => "Attack On Titan: The Last Attack",
            "poster" => "posters/Z491N1JVCJtaB6rt07NxjO4RBjUUBlA7Wt1bZOpc.jpg",
            "writer" => "Hajime Isayama",
            "description" => "Pertarungan terakhir bagi iblis paradise",
            "review_rating" => 0,
            "genre" => "Action, Thriller, Drama, Romance",
            "price" => "500000.00",
        ]);

        Movie::create([
            "title" => "The Conjuring",
            "poster" => "posters/WOmcLN3R2l9iI13GNhKrYX0SjJZ1TXHQpxajiIoj.jpg",
            "writer" => "James Wan",
            "description" => "perjalanan demonologist dalam menyembuhkan pasien",
            "review_rating" => 0,
            "genre" => "Action, Thriller, Drama, Mystery",
            "price" => "1000000.00",
        ]);
    }
}
