<?php

namespace App\Services\Pricing\Discounts;

use App\Contracts\DiscountRule;
use App\Models\Trip;

class MoreThanThreeSeatsDiscount implements DiscountRule
{
    public function apply(
        float $price,
        Trip $trip,
        int $seatsCount
    ): float {
        if ($seatsCount <= 3) {
            return $price;
        }

        return $price * 0.90;
    }
}