<?php

namespace App\Services\Pricing;

use App\Models\Trip;

class PricingService
{
    public function __construct(
        private PriceCalculatorResolver $calculatorResolver,
        private DiscountRuleResolver $discountRuleResolver
    ) {
    }

    public function calculate(
        Trip $trip,
        int $seatsCount
    ): float {
        $calculator = $this->calculatorResolver->resolve($trip);

        $basePrice = $calculator->calculate($trip);

        $discountRule = $this->discountRuleResolver->resolve(
            $trip,
            $seatsCount
        );

        return $discountRule->apply(
            $basePrice,
            $trip,
            $seatsCount
        );
    }
}