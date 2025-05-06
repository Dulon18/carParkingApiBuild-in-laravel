<?php
namespace App\Interfaces;
use App\Models\ParkingLots;
interface ParkingLotServiceInterface
{
    public function create(array $data): ParkingLots;
    public function update(ParkingLots $lot, array $data): ParkingLots;
    public function delete(ParkingLots $lot): void;
}
