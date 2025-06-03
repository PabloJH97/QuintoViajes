<?php

namespace Domain\Tickets\Actions;

use Domain\Flights\Models\Flight;
use Domain\Tickets\Data\Resources\TicketResource;
use Domain\Tickets\Models\Ticket;
use Domain\Users\Models\User;

class TicketStoreAction
{
    public function __invoke(array $data): TicketResource
    {
        $ticket = Ticket::create([
            'code' => $data['code'],
            'user_id' => User::where('email', $data['user'])->id,
            'flight_id' => Flight::where('code', $data['flight'])->id,
        ]);

        return TicketResource::fromModel($ticket);
    }
}
