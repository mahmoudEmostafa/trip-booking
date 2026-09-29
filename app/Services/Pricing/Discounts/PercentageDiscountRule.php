<?php

namespace App\Services\Pricing\Discounts;

use App\Contracts\DiscountRule;
use App\Models\Trip;

class PercentageDiscountRule implements DiscountRule
{
    public function __construct(
        private float $percentage
    ) {
    }

    public function apply(float $price, Trip $trip): float
    {
        return $price - ($price * $this->percentage / 100);
    }
}