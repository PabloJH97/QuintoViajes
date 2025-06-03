<?php

namespace Domain\Planes\Actions;

use Domain\Planes\Data\Resources\PlaneResource;
use Domain\Planes\Models\Plane;

class PlaneUpdateAction
{
    public function __invoke(Plane $plane, array $data): PlaneResource
    {
        $updateData = [
            'code' => $data['code'],
            'capacity' => $data['capacity'],
        ];

        $plane->update($updateData);

        return PlaneResource::fromModel($plane->fresh());
    }
}
