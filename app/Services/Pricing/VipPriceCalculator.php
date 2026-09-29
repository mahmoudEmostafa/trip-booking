<?php

namespace App\Services\Pricing;

use App\Contracts\PriceCalculator;
use App\Models\Trip;

class VipPriceCalculator implements PriceCalculator
{
    public function calculate(Trip $trip): float
    {
        return (float) $trip->price;
    }
}