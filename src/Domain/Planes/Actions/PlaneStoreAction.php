<?php

namespace Domain\Planes\Actions;

use Domain\Planes\Data\Resources\PlaneResource;
use Domain\Planes\Models\Plane;

class PlaneStoreAction
{
    public function __invoke(array $data): PlaneResource
    {
        $plane = Plane::create([
            'code' => $data['code'],
            'capacity' => $data['capacity'],
        ]);

        return PlaneResource::fromModel($plane);
    }
}
