<?php

namespace App\Planes\Controllers\Api;

use App\Core\Controllers\Controller;
use Domain\Planes\Actions\PlaneDestroyAction;
use Domain\Planes\Actions\PlaneIndexAction;
use Domain\Planes\Actions\PlaneStoreAction;
use Domain\Planes\Actions\PlaneUpdateAction;
use Domain\Planes\Models\Plane;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PlaneApiController extends Controller
{
    public function index(Request $request, PlaneIndexAction $action)
    {

        return response()->json($action($request->search, $request->integer('per_page', 10)));
    }

    public function show(Plane $plane)
    {
        return response()->json(['plane' => $plane]);
    }

    public function store(Request $request, PlaneStoreAction $action)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $plane = $action($validator->validated());

        return response()->json([
            'message' => __('messages.planes.created'),
            'plane' => $plane
        ]);
    }

    public function update(Request $request, Plane $plane, PlaneUpdateAction $action)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $updatedPlane = $action($plane, $validator->validated());

        return response()->json([
            'message' => __('messages.planes.updated'),
            'plane' => $updatedPlane
        ]);
    }

    public function destroy(Plane $plane, PlaneDestroyAction $action)
    {
        $action($plane);

        return response()->json([
            'message' => __('messages.planes.deleted')
        ]);
    }
}
