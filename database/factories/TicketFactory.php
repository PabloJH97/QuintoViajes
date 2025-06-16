<?php

namespace Database\Factories;

use Domain\Flights\Models\Flight;
use Domain\Tickets\Models\Ticket;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Model>
 */
class TicketFactory extends Factory
{
    /**
     * The model the factory corresponds to.
     *
     * @var string
     */
    protected $model = Ticket::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::all()->random()->id,
            'flight_id' => Flight::all()->random()->id,
            'seats' => fake()->randomElement($array=['1st', '2nd', 'tourist']),

        ];
    }
}
