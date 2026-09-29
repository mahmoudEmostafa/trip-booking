<?php

namespace App\Models;

use App\Enums\TripSeatStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TripSeat extends Model
{
    protected $fillable = [
        'trip_id',
        'seat_id',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => TripSeatStatus::class,
        ];
    }

    public function trip(): BelongsTo
    {
        return $this->belongsTo(Trip::class);
    }

    public function seat(): BelongsTo
    {
        return $this->belongsTo(Seat::class);
    }

    public function bookingSeat(): HasOne
    {
        return $this->hasOne(BookingSeat::class);
    }
}