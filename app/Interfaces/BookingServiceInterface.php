<?php
namespace App\Services\Contracts;

use App\Models\Booking;

interface BookingServiceInterface
{
    public function create(array $data): Booking;
    public function complete(Booking $booking): Booking;
    public function cancel(Booking $booking): Booking;
}
