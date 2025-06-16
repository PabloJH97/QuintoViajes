<?php

namespace Domain\Flights\Actions;

use Domain\Flights\Data\Resources\FlightResource;
use Domain\Flights\Models\Flight;
use Domain\Planes\Models\Plane;
use Illuminate\Support\Facades\Auth;

class FlightIndexAction
{
    public function __invoke(?array $search = null, int $perPage = 10)
    {
        $user2=Auth::user();
        $isUser=false;
        if(!in_array('reports.view', $user2->getPermissionNames()->toArray())){
            $isUser=true;
        }
        $code=$search[0];
        $planeCode=$search[1];
        $origin=$search[2];
        $destination=$search[3];
        $price=$search[4];
        $seats=$search[5];
        $date=$search[6];
        $state=$search[7];
        if($isUser){
            $state='waiting';
        }
        $created_at=$search[8];

        if($date!='null'){
            $date=explode('T', $date)[0];
        }
        if($created_at!='null'){
            $created_at=explode('T', $created_at)[0];
        }
        $plane_ids=Plane::query()->when($planeCode!='null', function ($query) use ($planeCode){
            $query->where('code', 'ILIKE', "%".$planeCode."%")->withTrashed();
        })->pluck('id');

        $flights = Flight::query()
            ->when($code!='null', function ($query) use ($code){
                $query->where('code', 'ILIKE', "%".$code."%");
            })
            ->when($planeCode!='null', function ($query) use ($plane_ids){
                $query->whereIn('plane_id', $plane_ids);
            })
            ->when($origin!='null', function ($query) use ($origin){
                $query->where('origin', 'ILIKE', "%".$origin."%");
            })
            ->when($destination!='null', function ($query) use ($destination){
                $query->where('destination', 'ILIKE', "%".$destination."%");
            })
            ->when($price!='null', function ($query) use ($price){
                $query->where('code', 'ILIKE', "%".$price."%");
            })
            ->when($seats!='null', function ($query) use ($seats){
                $query->where('seats', 'ILIKE', "%".$seats."%");
            })
            ->when($date!='null', function ($query) use ($date){
                $query->where('date', 'ILIKE', "%".$date."%");
            })
            ->when($state!='null', function ($query) use ($state){
                $query->where('state', 'ILIKE', "%".$state."%");
            })
            ->when($created_at!='null', function ($query) use ($created_at){
                $query->where('created_at', 'ILIKE', "%".$created_at."%");
            })
            ->latest()
            ->paginate($perPage);

        return $flights->through(fn ($flight) => FlightResource::fromModel($flight));
    }
}
