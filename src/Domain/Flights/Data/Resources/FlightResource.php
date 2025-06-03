<?php

namespace Domain\Flights\Data\Resources;

use Domain\Flights\Models\Flight;
use Spatie\LaravelData\Data;

class FlightResource extends Data
{
    public function __construct(
        public readonly string $id,
        public readonly string $code,
        public readonly string $plane,
        public readonly string $origin,
        public readonly string $destination,
        public readonly string $price,
        public readonly string $seats,
        public readonly string $date,
        public readonly string $state,
        public readonly string $created_at,
        public readonly string $updated_at,
    ) {
    }

    public static function fromModel(Flight $flight): self
    {

        return new self(
            id: $flight->id,
            code: $flight->code,
            plane: $flight->plane->code,
            origin: $flight->origin,
            destination: $flight->destination,
            price: $flight->price.'€',
            seats: $flight->seats,
            date: $flight->date,
            state: $flight->state,
            created_at: $flight->created_at->format('Y-m-d H:i:s'),
            updated_at: $flight->updated_at->format('Y-m-d H:i:s'),
        );
    }
}
