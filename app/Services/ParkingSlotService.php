<?php

namespace App\Services;
use App\Models\ParkingSlots;
use App\Services\Contracts\ParkingSlotServiceInterface;


class ParkingSlotService implements ParkingSlotServiceInterface
{
    public function create(array $data): ParkingSlots
    {
        return ParkingSlots::create($data);
    }

    public function update(ParkingSlots $slot, array $data): ParkingSlots
    {
        $slot->update($data);
        return $slot;
    }

    public function delete(ParkingSlots $slot): void
    {
        $slot->delete();
    }
    public function getAvailableSlots(?string $location = null): array
    {
        $query = ParkingSlots::where('is_available', true);

        if ($location) {
            $query->where('location', $location);
        }

        return $query->get()->toArray();
    }
}
