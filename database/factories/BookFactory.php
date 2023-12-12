<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3), 
            'author' => $this->faker->name,
            'isbn' => $this->faker->isbn13,
            'year_published' => $this->faker->year,
            'quantity' => $this->faker->numberBetween(1, 5), 
            'cover_url' => $this->faker->imageUrl(640, 640, 'books', true)
        ];
    }
}
