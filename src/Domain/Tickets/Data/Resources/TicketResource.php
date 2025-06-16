<?php

namespace Domain\Tickets\Data\Resources;

use Domain\Flights\Models\Flight;
use Domain\Tickets\Models\Ticket;
use Domain\Users\Models\User;
use Spatie\LaravelData\Data;

class TicketResource extends Data
{
    public function __construct(
        public readonly string $id,
        public readonly string $user,
        public readonly string $flight,
        public readonly string $seats,
        public readonly string $date,
        public readonly string $created_at,
        public readonly string $updated_at,
    ) {
    }

    public static function fromModel(Ticket $ticket): self
    {


        return new self(
            id: $ticket->id,
            user: $ticket->user->name,
            flight: $ticket->flight->code,
            seats: $ticket->seats,
            date: $ticket->flight->date,
            created_at: $ticket->created_at->format('Y-m-d H:i:s'),
            updated_at: $ticket->updated_at->format('Y-m-d H:i:s'),
        );
    }
}
