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
            'code' => $data['code'],
            'user_id' => User::where('email', $data['user'])->id,
            'flight_id' => Flight::where('code', $data['flight'])->id,
        ];

        $ticket->update($updateData);

        return TicketResource::fromModel($ticket->fresh());
    }
}
