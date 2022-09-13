<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
    public function definition()
    {
        return [
            'title' => fake()->sentence(3),
            'synopsis' => fake()->text(),
            'duration' => fake()->numberBetween(100, 200),
            'youtube' => Str::random(8),
            'cover' => fake()->imageUrl(),
            'released_at' => fake()->date(),
            'category_id' => Category::factory(),
        ];
    }
}
