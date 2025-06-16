<?php

namespace Domain\Flights\Actions;

use Domain\Flights\Data\Resources\FlightResource;
use Domain\Flights\Models\Flight;
use Domain\Planes\Models\Plane;

class FlightStoreAction
{
    public function __invoke(array $data): FlightResource
    {
        $seats=explode(',', $data['seats']);
        $flight = Flight::create([
            'code' => $data['code'],
            'plane_id' => Plane::where('code', $data['planeCode'])->first()->id,
            'origin' => $data['origin'],
            'destination' => $data['destination'],
            'price' => $data['price'],
            'seats' => implode(', ', $seats),
            'date' => $data['date'],
            'state' => 'draft',
        ]);

        return FlightResource::fromModel($flight);
    }
}
