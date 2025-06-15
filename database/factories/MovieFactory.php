<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Movie::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'poster' => 'posters/default.jpg',
            'writer' => $this->faker->name,
            'description' => $this->faker->paragraph(3),
            'genre' => $this->faker->randomElement(['Action', 'Adventure', 'Comedy', 'Drama']), // Tambahkan ini
            'review_rating' => 0,
            'review_count' => 0,
            'price' => $this->faker->randomFloat(2, 100000, 5000000),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
