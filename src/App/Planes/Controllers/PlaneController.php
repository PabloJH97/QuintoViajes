<?php

namespace App\Planes\Controllers;

use Illuminate\Http\Request;
use App\Core\Controllers\Controller;
use Domain\Planes\Actions\PlaneDestroyAction;
use Domain\Planes\Actions\PlaneStoreAction;
use Domain\Planes\Actions\PlaneUpdateAction;
use Domain\Planes\Models\Plane;
use Domain\Floors\Models\Floor;
use Domain\Zones\Models\Zone;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class PlaneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('planes/Index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $zones=Zone::with('genre')->get();
        $floors=Floor::all();
        return Inertia::render('bookshelves/Create', ['arrayZones' => $zones, 'arrayFloors' => $floors]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, PlaneStoreAction $action)
    {
        $validator = Validator::make($request->all(), [
            'number' => ['required', 'numeric', 'max:255'],
            'capacity' => ['required', 'numeric', 'max:255'],
            'zone_id' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $action($validator->validated());

        return redirect()->route('bookshelves.index')
            ->with('success', __('messages.bookshelves.created'));
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
    public function edit(Request $request, Plane $plane)
    {
        $zones=Zone::with('genre')->get();
        $floors=Floor::all();
        $selectedFloor=Floor::where('id', Zone::where('id', $plane->zone_id)->first()->floor_id)->first()->id;
        return Inertia::render('bookshelves/Edit', [
            'plane' => $plane,
            'page' => $request->query('page'),
            'perPage' => $request->query('perPage'),
            'arrayZones' => $zones,
            'arrayFloors' => $floors,
            'selectedFloor' => $selectedFloor
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plane $plane, PlaneUpdateAction $action)
    {
        $validator = Validator::make($request->all(), [
            'number' => ['required', 'numeric'],
            'capacity' => ['required', 'numeric'],
            'zone_id' => ['required', 'string', 'max:255'],

        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $action($plane, $validator->validated());

        $redirectUrl = route('bookshelves.index');

        // Añadir parámetros de página a la redirección si existen
        if ($request->has('page')) {
            $redirectUrl .= "?page=" . $request->query('page');
            if ($request->has('perPage')) {
                $redirectUrl .= "&per_page=" . $request->query('perPage');
            }
        }

        return redirect($redirectUrl)
            ->with('success', __('messages.bookshelves.updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plane $plane, PlaneDestroyAction $action)
    {
        $action($plane);

        return redirect()->route('bookshelves.index')
            ->with('success', __('messages.bookshelves.deleted'));
    }
}
