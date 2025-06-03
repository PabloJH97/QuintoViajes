<?php

namespace Domain\Tickets\Actions;

use Domain\Tickets\Models\Ticket;

class TicketDestroyAction
{
    public function __invoke(Ticket $ticket): void
    {
        $ticket->delete();
    }
}
