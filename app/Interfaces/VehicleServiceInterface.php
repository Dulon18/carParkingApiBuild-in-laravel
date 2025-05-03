<?php
namespace App\Services\Contracts;

use App\Models\Vehicle;

interface VehicleServiceInterface
{
    public function create(array $data): Vehicle;
    public function update(Vehicle $vehicle, array $data): Vehicle;
    public function delete(Vehicle $vehicle): void;
}
