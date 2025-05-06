<?php

namespace App\Http\Controllers;

use App\Models\ParkingLots;
use App\Services\ParkingLotService;
use Illuminate\Http\Request;

class ParkingLotController extends Controller
{
    protected ParkingLotService $lotService;

    public function __construct(ParkingLotService $lotService)
    {
        $this->lotService = $lotService;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'nullable|string',
            'zip_code' => 'nullable|string',
            'total_slots' => 'sometimes|integer',
        ]);

        $lot = $this->lotService->create($validated);
        return response()->json($lot, 201);
    }

    public function update(Request $request, ParkingLots $parkingLot)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string',
            'address' => 'sometimes|string',
            'city' => 'sometimes|string',
            'state' => 'nullable|string',
            'zip_code' => 'nullable|string',
            'total_slots' => 'sometimes|integer',
        ]);

        $lot = $this->lotService->update($parkingLot, $validated);
        return response()->json($lot);
    }

    public function destroy(ParkingLots $parkingLot)
    {
        $this->lotService->delete($parkingLot);
        return response()->json(['message' => 'Deleted successfully']);
    }
}
