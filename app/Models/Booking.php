<?php

namespace App\Models;

use App\Enums\BookingStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Booking extends Model
{
    protected $fillable = [
        'customer_id',
        'trip_id',
        'employee_id',
        'status',
        'unit_price',
        'total_price',
    ];

    protected function casts(): array
    {
        return [
            'status' => BookingStatus::class,
            'unit_price' => 'decimal:2',
            'total_price' => 'decimal:2',
        ];
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function trip(): BelongsTo
    {
        return $this->belongsTo(Trip::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function bookingSeats(): HasMany
    {
        return $this->hasMany(BookingSeat::class);
    }
}