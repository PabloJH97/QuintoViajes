<?php

namespace Domain\Flights\Actions;

use Domain\Flights\Data\Resources\FlightResource;
use Domain\Flights\Models\Flight;
use Domain\Planes\Models\Plane;

class FlightUpdateAction
{
    public function __invoke(Flight $flight, array $data): FlightResource
    {
        $updateData = [
            'code' => $data['code'],
            'plane_id' => Plane::where('code', $data['planeCode'])->first()->id,
            'origin' => $data['origin'],
            'destination' => $data['destination'],
            'price' => $data['price'],
            'seats' => $data['seats'],
            'date' => $data['date'],
        ];

        $flight->update($updateData);

        return FlightResource::fromModel($flight->fresh());
    }
}
