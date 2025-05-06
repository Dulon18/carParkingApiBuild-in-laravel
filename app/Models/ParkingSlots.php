<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class ParkingSlots extends Model
{
    protected $fillable = ['parking_lot_id', 'slot_number', 'is_available', 'slot_type','price_per_hour'];

    public function lot(): BelongsTo
    {
        return $this->belongsTo(ParkingLotS::class, 'parking_lot_id');
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
