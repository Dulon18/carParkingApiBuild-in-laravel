<?php
namespace App\Services;

use App\Models\Booking;
use App\Models\Payment;
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
        $slot = $booking->slot;
        $slot->update(['is_available' => true]);

        // Calculate duration in hours (rounded up)
        $start = \Carbon\Carbon::parse($booking->start_time);
        $end = \Carbon\Carbon::parse($booking->end_time);
        $hours = ceil($end->diffInMinutes($start) / 60);

        // Calculate payment
        $amount = $hours * $slot->price_per_hour;

        Payment::create([
            'booking_id' => $booking->id,
            'amount' => $amount,
            'payment_method' => 'cash', // or let the user choose
            'payment_status' => 'paid',
            'paid_at' => now(),
        ]);

        return $booking;
    }

    public function cancel(Booking $booking): Booking
    {
        $booking->update(['status' => 'cancelled']);
        $booking->slot->update(['is_available' => true]);
        return $booking;
    }
}
