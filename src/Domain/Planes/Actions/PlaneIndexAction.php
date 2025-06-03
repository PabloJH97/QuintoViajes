<?php

namespace Domain\Planes\Actions;

use Domain\Planes\Data\Resources\PlaneResource;
use Domain\Planes\Models\Plane;

class PlaneIndexAction
{
    public function __invoke(?array $search = null, int $perPage = 10)
    {
        $code=$search[0];
        $capacity=$search[1];
        $created_at=$search[2];

        if($created_at!='null'){
            $created_at=explode('T', $created_at)[0];
        }

        $planes = Plane::query()
            ->when($code!='null', function ($query) use ($code){
                $query->where('code', 'ILIKE', "%".$code."%");
            })
            ->when($capacity!='null', function ($query) use ($capacity){
                $query->where('capacity', 'ILIKE', "%".$capacity."%");
            })
            ->when($created_at!='null', function ($query) use ($created_at){
                $query->where('created_at', 'ILIKE', "%".$created_at."%");
            })
            ->latest()
            ->paginate($perPage);

        return $planes->through(fn ($plane) => PlaneResource::fromModel($plane));
    }
}
