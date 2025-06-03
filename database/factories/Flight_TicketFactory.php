<?php

namespace Database\Factories;


use Domain\Flights\Models\Flight;
use Domain\Flight_Ticket\Models\Flight_Ticket;
use Domain\Tickets\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Model>
 */
class Flight_TicketFactory extends Factory
{
    /**
     * The model the factory corresponds to.
     *
     * @var string
     */
    protected $model = Flight_Ticket::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'flight_id' => Flight::all()->random()->id,
            'ticket_id' => Ticket::all()->random()->id
        ];
    }
}
