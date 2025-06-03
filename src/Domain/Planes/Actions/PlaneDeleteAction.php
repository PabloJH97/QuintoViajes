<?php

namespace Domain\Planes\Actions;

use Domain\Planes\Models\Plane;

class PlaneDestroyAction
{
    public function __invoke(Plane $plane): void
    {
        $plane->delete();
    }
}
