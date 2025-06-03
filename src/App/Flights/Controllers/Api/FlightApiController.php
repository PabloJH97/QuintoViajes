<?php

namespace App\Flights\Controllers\Api;

use App\Core\Controllers\Controller;
use Domain\Flights\Actions\FlightDestroyAction;
use Domain\Flights\Actions\FlightIndexAction;
use Domain\Flights\Actions\FlightStoreAction;
use Domain\Flights\Actions\FlightUpdateAction;
use Domain\Flights\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class FlightApiController extends Controller
{
    public function index(Request $request, FlightIndexAction $action)
    {

        return response()->json($action($request->search, $request->integer('per_page', 10)));
    }

    public function show(Flight $flight)
    {
        return response()->json(['flight' => $flight]);
    }

    public function store(Request $request, FlightStoreAction $action)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $flight = $action($validator->validated());

        return response()->json([
            'message' => __('messages.flights.created'),
            'flight' => $flight
        ]);
    }

    public function update(Request $request, Flight $flight, FlightUpdateAction $action)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $updatedFlight = $action($flight, $validator->validated());

        return response()->json([
            'message' => __('messages.flights.updated'),
            'flight' => $updatedFlight
        ]);
    }

    public function destroy(Flight $flight, FlightDestroyAction $action)
    {
        $action($flight);

        return response()->json([
            'message' => __('messages.flights.deleted')
        ]);
    }
}
