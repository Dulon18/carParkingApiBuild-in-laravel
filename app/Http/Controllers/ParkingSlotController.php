<?php
namespace App\Http\Controllers;
use App\Services\Contracts\ParkingSlotServiceInterface;
use App\Models\ParkingSlots;
use Illuminate\Http\Request;

class ParkingSlotController extends Controller
{
    protected ParkingSlotServiceInterface $slotService;

    public function __construct(ParkingSlotServiceInterface $slotService)
    {
        $this->slotService = $slotService;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'location' => 'required|string',
            'slot_number' => 'required|string|unique:parking_slots',
            'is_available' => 'sometimes|boolean'
        ]);

        $slot = $this->slotService->create($validated);
        return response()->json($slot, 201);
    }

    public function update(Request $request, ParkingSlots $parkingSlot)
    {
        $validated = $request->validate([
            'location' => 'sometimes|string',
            'slot_number' => 'sometimes|string|unique:parking_slots,slot_number,' . $parkingSlot->id,
            'is_available' => 'sometimes|boolean'
        ]);

        $slot = $this->slotService->update($parkingSlot, $validated);
        return response()->json($slot);
    }

    public function destroy(ParkingSlots $parkingSlot)
    {
        $this->slotService->delete($parkingSlot);
        return response()->json(['message' => 'Deleted successfully']);
    }
    public function available(Request $request)
    {
        $location = $request->query('location');
        $slots = $this->slotService->getAvailableSlots($location);
        return response()->json($slots);
    }
}
