<?php

namespace Domain\Tickets\Actions;

use Domain\Flights\Models\Flight;
use Domain\Tickets\Data\Resources\TicketResource;
use Domain\Tickets\Models\Ticket;
use Domain\Users\Models\User;

class TicketUpdateAction
{
    public function __invoke(Ticket $ticket, array $data): TicketResource
    {
        $updateData = [
            'user_id' => User::where('email', $data['user'])->first()->id,
            'flight_id' => Flight::where('code', $data['flight'])->first()->id,
            'seats' => $data['seats'],
        ];

        $ticket->update($updateData);

        return TicketResource::fromModel($ticket->fresh());
    }
}
