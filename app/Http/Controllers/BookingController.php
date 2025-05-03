<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Services\Contracts\BookingServiceInterface;

class BookingController extends Controller
{
    protected BookingServiceInterface $bookingService;

    public function __construct(BookingServiceInterface $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'parking_slot_id' => 'required|exists:parking_slots,id',
            'start_time' => 'required|date',
        ]);

        $booking = $this->bookingService->create($validated);
        return response()->json($booking, 201);
    }

    public function complete(Booking $booking)
    {
        $booking = $this->bookingService->complete($booking);
        return response()->json($booking);
    }

    public function cancel(Booking $booking)
    {
        $booking = $this->bookingService->cancel($booking);
        return response()->json($booking);
    }
}
