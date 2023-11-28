<?php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\User;
use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    /**
     * O nome do modelo correspondente à factory.
     *
     * @var string
     */
    protected $model = Reservation::class;

    /**
     * Defina o estado padrão do modelo.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Cria um novo usuário ou usa um existente
            'book_id' => Book::factory(), // Cria um novo livro ou usa um existente
            'data_reserva' => $this->faker->dateTimeBetween('-1 week', '+1 week'),
            'data_expiracao' => $this->faker->dateTimeBetween('+1 week', '+2 weeks'),
            'status' => $this->faker->randomElement(['ativa', 'expirada', 'cancelada'])
        ];
    }
}
