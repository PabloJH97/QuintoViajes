<?php

namespace App\Tickets\Controllers;

use Illuminate\Http\Request;
use App\Core\Controllers\Controller;
use Domain\Tickets\Actions\TicketDestroyAction;
use Domain\Tickets\Actions\TicketStoreAction;
use Domain\Tickets\Actions\TicketUpdateAction;
use Domain\Tickets\Models\Ticket;
use Domain\Floors\Models\Floor;
use Domain\Zones\Models\Zone;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('tickets/Index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('tickets/Create', []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, TicketStoreAction $action)
    {
        dd($request);
        $validator = Validator::make($request->all(), [
            'user' => ['required', 'string', 'max:255'],
            'flight' => ['required', 'string', 'min:4', 'max:4'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $action($validator->validated());

        return redirect()->route('tickets.index')
            ->with('success', __('messages.tickets.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Ticket $ticket)
    {
        return Inertia::render('tickets/Edit', [
            'ticket' => $ticket,
            'user' => $ticket->user->email,
            'flight' => $ticket->flight->code,
            'page' => $request->query('page'),
            'perPage' => $request->query('perPage'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket, TicketUpdateAction $action)
    {
        $validator = Validator::make($request->all(), [
            'user' => ['required', 'string', 'max:255'],
            'flight' => ['required', 'string', 'min:4', 'max:4'],

        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $action($ticket, $validator->validated());

        $redirectUrl = route('tickets.index');

        // Añadir parámetros de página a la redirección si existen
        if ($request->has('page')) {
            $redirectUrl .= "?page=" . $request->query('page');
            if ($request->has('perPage')) {
                $redirectUrl .= "&per_page=" . $request->query('perPage');
            }
        }

        return redirect($redirectUrl)
            ->with('success', __('messages.tickets.updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket, TicketDestroyAction $action)
    {
        $action($ticket);

        return redirect()->route('tickets.index')
            ->with('success', __('messages.tickets.deleted'));
    }
}
