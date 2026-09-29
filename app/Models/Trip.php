<?php

namespace App\Models;

use App\Enums\TripStatus;
use App\Enums\TripType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Trip extends Model
{
protected $fillable = [
        'bus_id',
        'employee_id',
        'departure_city',
        'destination_city',
        'departure_at',
        'arrival_at',
        'type',
        'price',
        'status',
    ];
    
   protected function casts(): array
    {
        return [
            'type' => TripType::class,
            'status' => TripStatus::class,
            'departure_at' => 'datetime',
            'arrival_at' => 'datetime',
            'price' => 'decimal:2',
        ];
    }
    

    public function bus(): BelongsTo
    {
        return $this->belongsTo(Bus::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function tripSeats(): HasMany
    {
        return $this->hasMany(TripSeat::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}