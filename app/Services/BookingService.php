<?php
namespace App\Services;

use App\Models\Booking;
use App\Models\ParkingSlot;
use App\Models\ParkingSlots;
use App\Services\Contracts\BookingServiceInterface;
use Illuminate\Support\Facades\DB;

class BookingService implements BookingServiceInterface
{
    public function create(array $data): Booking
    {
        return DB::transaction(function () use ($data) {
            $slot = ParkingSlots::findOrFail($data['parking_slot_id']);
            if (!$slot->is_available) {
                throw new \Exception('Slot is not available');
            }
            $slot->is_available = false;
            $slot->save();

            return Booking::create($data);
        });
    }

    public function complete(Booking $booking): Booking
    {
        $booking->update(['status' => 'completed', 'end_time' => now()]);
        $booking->slot->update(['is_available' => true]);
        return $booking;
    }

    public function cancel(Booking $booking): Booking
    {
        $booking->update(['status' => 'cancelled']);
        $booking->slot->update(['is_available' => true]);
        return $booking;
    }
}
