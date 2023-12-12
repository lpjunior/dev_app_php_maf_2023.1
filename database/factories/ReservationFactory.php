<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Cria um novo usuário ou usa um existente
            'book_id' => Book::factory(), // Cria um novo livro ou usa um existente 
            'reservation_date' => $this->faker->dateTimeBetween('-1 week', '+1 week'), 
            'expiration_date' => $this->faker->dateTimeBetween('+1 week', '+2 week'), 
            'status' => $this->faker->randomElement(['active', 'expired', 'canceled', 'completed'])
        ];
    }
}
