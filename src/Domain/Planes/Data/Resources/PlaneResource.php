<?php

namespace Domain\Planes\Data\Resources;

use Domain\Planes\Models\Plane;
use Spatie\LaravelData\Data;

class PlaneResource extends Data
{
    public function __construct(
        public readonly string $id,
        public readonly string $code,
        public readonly int $capacity,
        public readonly string $created_at,
        public readonly string $updated_at,
    ) {
    }

    public static function fromModel(Plane $plane): self
    {

        return new self(
            id: $plane->id,
            code: $plane->code,
            capacity: $plane->capacity,
            created_at: $plane->created_at->format('Y-m-d H:i:s'),
            updated_at: $plane->updated_at->format('Y-m-d H:i:s'),
        );
    }
}
