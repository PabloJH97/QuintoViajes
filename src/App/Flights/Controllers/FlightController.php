<?php

namespace App\Flights\Controllers;

use Illuminate\Http\Request;
use App\Core\Controllers\Controller;
use Domain\Flights\Actions\FlightDestroyAction;
use Domain\Flights\Actions\FlightStoreAction;
use Domain\Flights\Actions\FlightUpdateAction;
use Domain\Flights\Models\Flight;
use Domain\Floors\Models\Floor;
use Domain\Planes\Models\Plane;
use Domain\Zones\Models\Zone;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('flights/Index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $planes=Plane::all();
        return Inertia::render('flights/Create', ['arrayPlanes' => $planes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, FlightStoreAction $action)
    {
        $validator = Validator::make($request->all(), [
            'code' => ['required', 'string', 'min:4', 'max:4'],
            'planeCode' => ['required', 'string', 'min:4', 'max:4'],
            'origin' => ['required', 'string', 'max:255'],
            'destination' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'max:255'],
            'seats' => ['required'],
            'date' => ['required'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $action($validator->validated());

        return redirect()->route('flights.index')
            ->with('success', __('messages.flights.created'));
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
    public function edit(Request $request, Flight $flight)
    {
        return Inertia::render('flights/Edit', [
            'flight' => $flight,
            'page' => $request->query('page'),
            'perPage' => $request->query('perPage'),
            'planeCode' => $flight->plane->code,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Flight $flight, FlightUpdateAction $action)
    {
        $validator = Validator::make($request->all(), [
            'code' => ['required', 'string', 'min:4', 'max:4'],
            'planeCode' => ['required', 'string', 'min:4', 'max:4'],
            'origin' => ['required', 'string', 'max:255'],
            'destination' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'max:255'],
            'seats' => ['required'],
            'date' => ['required'],

        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $action($flight, $validator->validated());

        $redirectUrl = route('flights.index');

        // Añadir parámetros de página a la redirección si existen
        if ($request->has('page')) {
            $redirectUrl .= "?page=" . $request->query('page');
            if ($request->has('perPage')) {
                $redirectUrl .= "&per_page=" . $request->query('perPage');
            }
        }

        return redirect($redirectUrl)
            ->with('success', __('messages.flights.updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Flight $flight, FlightDestroyAction $action)
    {
        $action($flight);

        return redirect()->route('flights.index')
            ->with('success', __('messages.flights.deleted'));
    }
}
