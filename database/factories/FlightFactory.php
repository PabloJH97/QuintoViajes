<?php

namespace Database\Factories;

use Domain\Flights\Models\Flight;
use Domain\Planes\Models\Plane;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Model>
 */
class FlightFactory extends Factory
{
    /**
     * The model the factory corresponds to.
     *
     * @var string
     */
    protected $model = Flight::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $plane=Plane::all()->random();
        $seats=fake()->randomElements($array=['1st', '2nd', 'tourist'], $count=fake()->randomElement($array=[1,2,3]));
        return [
            'code' => strtoupper(fake()->unique()->bothify('?###')),
            'plane_id' => $plane->id,
            'origin' => fake()->city(),
            'destination' => fake()->city(),
            'price' => fake()->randomFloat($nmMaxDecimals=2, $min=0, $max=300),
            'seats' => implode(', ', $seats),
            'date' => fake()->dateTimeBetween($startDate='now', $endDate='+1 year'),
            'state' => fake()->randomElement($array=['draft', 'waiting', 'full', 'on the way']),

        ];
    }
}
