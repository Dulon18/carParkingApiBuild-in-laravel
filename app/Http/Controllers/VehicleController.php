<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Services\Contracts\VehicleServiceInterface;

class VehicleController extends Controller
{
    protected VehicleServiceInterface $vehicleService;

    public function __construct(VehicleServiceInterface $vehicleService)
    {
        $this->vehicleService = $vehicleService;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'plate_number' => 'required|unique:vehicles',
            'vehicle_type' => 'required',
            'color' => 'required',
        ]);

        $vehicle = $this->vehicleService->create($validated);
        return response()->json($vehicle, 201);
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
            'plate_number' => 'sometimes|string|unique:vehicles,plate_number,' . $vehicle->id,
            'vehicle_type' => 'sometimes|string',
            'color' => 'sometimes|string',
        ]);

        $vehicle = $this->vehicleService->update($vehicle, $validated);
        return response()->json($vehicle);
    }

    public function destroy(Vehicle $vehicle)
    {
        $this->vehicleService->delete($vehicle);
        return response()->json(['message' => 'Deleted successfully']);
    }
}
