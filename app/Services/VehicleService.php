<?php

use App\Models\Vehicle;
use App\Services\Contracts\VehicleServiceInterface;

class VehicleService implements VehicleServiceInterface
{
    public function create(array $data): Vehicle
    {
        return Vehicle::create($data);
    }

    public function update(Vehicle $vehicle, array $data): Vehicle
    {
        $vehicle->update($data);
        return $vehicle;
    }

    public function delete(Vehicle $vehicle): void
    {
        $vehicle->delete();
    }
}
