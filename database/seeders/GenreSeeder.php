<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [
            'Action', 'Sci-Fi', 'Adventure', 'Thriller',
            'Drama', 'Horror', 'Comedy', 'Romance'
        ];

        foreach ($genres as $genre) {
            Genre::create([
                'name' => $genre,
                'slug' => Str::slug($genre)
            ]);
        }
    }
}
