<?php

namespace Domain\Tickets\Actions;

use App\Notifications\TicketMail;
use Domain\Flights\Models\Flight;
use Domain\Tickets\Data\Resources\TicketResource;
use Domain\Tickets\Models\Ticket;
use Domain\Users\Models\User;

class TicketStoreAction
{
    public function __invoke(array $data): TicketResource
    {
        $user=User::where('email', $data['user'])->first();
        $flight=Flight::where('code', $data['flight'])->first();
        $ticket = Ticket::create([
            'user_id' => $user->id,
            'flight_id' => $flight->id,
            'seats' => $data['seats'],
        ]);
        $user->notify(new TicketMail($ticket));
        if($flight->tickets->count()==$flight->plane->capacity){
            $flight->forceFill([
                'state' => 'full',
            ])->save();
        }


        return TicketResource::fromModel($ticket);
    }
}
