<?php

namespace App\Services\Pricing;

use App\Contracts\PriceCalculator;
use App\Enums\TripType;
use App\Models\Trip;
use InvalidArgumentException;

class PriceCalculatorResolver
{
    public function resolve(Trip $trip): PriceCalculator
    {
        return match ($trip->type) {
            TripType::REGULAR => app(RegularPriceCalculator::class),
            TripType::VIP => app(VipPriceCalculator::class),

            default => throw new InvalidArgumentException(
                'Unsupported trip type.'
            ),
        };
    }
}