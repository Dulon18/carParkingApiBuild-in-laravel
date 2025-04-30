<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;

class ParkingLotS extends Model
{
    protected $fillable = ['name', 'location', 'total_slots'];

    public function slots(): HasMany
    {
        return $this->hasMany(ParkingSlots::class);
    }
}
