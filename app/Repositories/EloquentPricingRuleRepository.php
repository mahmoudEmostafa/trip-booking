<?php

namespace App\Repositories;

use App\Models\PricingRule;
use App\Repositories\Contracts\PricingRuleRepositoryInterface;
use App\Exceptions\PricingRuleNotFoundException;

class EloquentPricingRuleRepository implements PricingRuleRepositoryInterface
{
    public function findByTripDetails(
        string $departureCity,
        string $destinationCity,
        string $type
    ): PricingRule {
        $pricingRule = PricingRule::query()
            ->where('departure_city', $departureCity)
            ->where('destination_city', $destinationCity)
            ->where('type', $type)
            ->first();

        if (! $pricingRule) {
            throw new PricingRuleNotFoundException();
        }

        return $pricingRule;
    }
}