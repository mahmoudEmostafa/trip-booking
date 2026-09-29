<?php

namespace App\Services\Pricing\Discounts;

use App\Contracts\DiscountRule;
use App\Models\Trip;

class NoDiscountRule implements DiscountRule
{
    public function apply(
        float $price,
        Trip $trip,
        int $seatsCount
    ): float {
        return $price;
    }
}