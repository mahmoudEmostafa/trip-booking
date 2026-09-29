<?php

namespace App\Services\Pricing;

use App\Contracts\DiscountRule;
use App\Models\Trip;
use App\Services\Pricing\Discounts\MoreThanThreeSeatsDiscount;
use App\Services\Pricing\Discounts\NoDiscountRule;

class DiscountRuleResolver
{
    public function resolve(
        Trip $trip,
        int $seatsCount
    ): DiscountRule {
        if ($seatsCount > 3) {
            return app(MoreThanThreeSeatsDiscount::class);
        }

        return app(NoDiscountRule::class);
    }
}