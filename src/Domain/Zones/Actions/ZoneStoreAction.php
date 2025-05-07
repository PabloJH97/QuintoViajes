<?php

namespace Domain\Zones\Actions;

use Domain\Zones\Data\Resources\ZoneResource;
use Domain\Zones\Models\Zone;


class ZoneStoreAction
{
    public function __invoke(array $data): ZoneResource
    {
        $zone = Zone::create([
            'genre_id' => $data['genre_id'],
            'floor_id' => $data['floor_id'],
        ]);

        return ZoneResource::fromModel($zone);
    }
}
