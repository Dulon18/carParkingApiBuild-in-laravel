<?php
namespace App\Services\Contracts;

use App\Models\ParkingSlots;


interface ParkingSlotServiceInterface
{
    public function create(array $data): ParkingSlots;
    public function update(ParkingSlots $slot, array $data): ParkingSlots;
    public function delete(ParkingSlots $slot): void;
    public function getAvailableSlots(?string $location = null): array;
}
