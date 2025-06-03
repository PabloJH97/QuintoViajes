<?php

namespace Domain\Flights\Actions;

use Domain\Flights\Models\Flight;

class FlightDestroyAction
{
    public function __invoke(Flight $flight): void
    {
        $flight->delete();
    }
}
