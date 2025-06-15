<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Pastikan factory tersedia
        if (!class_exists(\Database\Factories\MovieFactory::class)) {
            $this->command->error('MovieFactory not found!');
            return;
        }

        $genres = Genre::all();
        
        // Buat 20 movie dengan relasi genre
        Movie::factory(20)->create()->each(function($movie) use ($genres) {
            $movie->genres()->attach(
                $genres->random(rand(1, 3))->pluck('id')
            );
        });
    }
}
