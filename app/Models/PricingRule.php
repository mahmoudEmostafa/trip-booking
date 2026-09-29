<?php

namespace App\Models;

use App\Enums\TripType;
use Illuminate\Database\Eloquent\Model;

class PricingRule extends Model
{
    protected $fillable = [
        'departure_city',
        'destination_city',
        'type',
        'price',
    ];

    protected function casts(): array
    {
        return [
            'type' => TripType::class,
            'price' => 'decimal:2',
        ];
    }
}