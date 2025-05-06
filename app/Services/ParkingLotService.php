<?php

namespace App\Services;
use App\Models\ParkingLots;
use App\Services\Contracts\ParkingLotServiceInterface;
class ParkingLotService implements ParkingLotServiceInterface
{
    public function create(array $data): ParkingLots
    {
        return ParkingLots::create($data);
    }

    public function update(ParkingLots $lot, array $data): ParkingLots
    {
        $lot->update($data);
        return $lot;
    }

    public function delete(ParkingLots $lot): void
    {
        $lot->delete();
    }
}

