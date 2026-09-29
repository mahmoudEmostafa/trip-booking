<?php

namespace App\Services\Pricing;

use App\Contracts\PriceCalculator;
use App\Models\Trip;

class RegularPriceCalculator implements PriceCalculator
{
    public function calculate(Trip $trip): float
    {
        return (float) $trip->price;
    }
}