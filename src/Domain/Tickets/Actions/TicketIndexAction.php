<?php

namespace Domain\Tickets\Actions;

use Domain\Flights\Models\Flight;
use Domain\Tickets\Data\Resources\TicketResource;
use Domain\Tickets\Models\Ticket;
use Domain\Users\Models\User;
use Illuminate\Support\Facades\Auth;

class TicketIndexAction
{
    public function __invoke(?array $search = null, int $perPage = 10)
    {
        $user2=Auth::user();
        $isUser=false;
        $user=$search[0];
        if(!in_array('reports.view', $user2->getPermissionNames()->toArray())){
            $user=Auth::user()->id;
            $isUser=true;
        }
        $flight=$search[1];
        $created_at=$search[2];

        if($created_at!='null'){
            $created_at=explode('T', $created_at)[0];
        };
        if($isUser){
            $userArray=
            User::query()->when($user!='null', function($query) use ($user){
                $query->where('id', $user);
            })->pluck('id');
        }else{
            $userArray=
            User::query()->when($user!='null', function($query) use ($user){
            $query->where('name', 'ILIKE', "%".$user."%");
            })->pluck('id');
        }
        $flightArray=
        Flight::query()->when($flight!='null', function($query) use ($flight){
            $query->where('code', 'ILIKE', "%".$flight."%");
        })->pluck('id');


        $tickets = Ticket::query()
            ->when($user!='null', function ($query) use ($userArray){
                $query->whereIn('user_id', $userArray);
            })
            ->when($flight!='null', function ($query) use ($flightArray){
                $query->whereIn('flight_id', $flightArray);
            })
            ->when($created_at!='null', function ($query) use ($created_at){
                $query->where('created_at', 'ILIKE', "%".$created_at."%");
            })
            ->latest()
            ->paginate($perPage);

        return $tickets->through(fn ($ticket) => TicketResource::fromModel($ticket));
    }
}
