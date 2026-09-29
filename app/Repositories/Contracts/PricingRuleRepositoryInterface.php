<?php

namespace App\Repositories\Contracts;

use App\Models\PricingRule;

interface PricingRuleRepositoryInterface
{
    public function findByTripDetails(
        string $departureCity,
        string $destinationCity,
        string $type
    ): PricingRule;
}