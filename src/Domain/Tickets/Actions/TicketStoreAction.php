<?php

namespace Domain\Tickets\Actions;

use App\Notifications\test;
use Domain\Flights\Models\Flight;
use Domain\Tickets\Data\Resources\TicketResource;
use Domain\Tickets\Models\Ticket;
use Domain\Users\Models\User;

class TicketStoreAction
{
    public function __invoke(array $data): TicketResource
    {
        $user=User::where('email', $data['user'])->first();
        $ticket = Ticket::create([
            'user_id' => $user->id,
            'flight_id' => Flight::where('code', $data['flight'])->first()->id,
        ]);
        $user->notify(new test());

        return TicketResource::fromModel($ticket);
    }
}
