<?php

namespace App\Tickets\Controllers\Api;

use App\Core\Controllers\Controller;
use Domain\Tickets\Actions\TicketDestroyAction;
use Domain\Tickets\Actions\TicketIndexAction;
use Domain\Tickets\Actions\TicketStoreAction;
use Domain\Tickets\Actions\TicketUpdateAction;
use Domain\Tickets\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TicketApiController extends Controller
{
    public function index(Request $request, TicketIndexAction $action)
    {

        return response()->json($action($request->search, $request->integer('per_page', 10)));
    }

    public function show(Ticket $ticket)
    {
        return response()->json(['ticket' => $ticket]);
    }

    public function store(Request $request, TicketStoreAction $action)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $ticket = $action($validator->validated());

        return response()->json([
            'message' => __('messages.tickets.created'),
            'ticket' => $ticket
        ]);
    }

    public function update(Request $request, Ticket $ticket, TicketUpdateAction $action)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $updatedTicket = $action($ticket, $validator->validated());

        return response()->json([
            'message' => __('messages.tickets.updated'),
            'ticket' => $updatedTicket
        ]);
    }

    public function destroy(Ticket $ticket, TicketDestroyAction $action)
    {
        $action($ticket);

        return response()->json([
            'message' => __('messages.tickets.deleted')
        ]);
    }
}
