<?php

namespace App\Contracts;

use App\Models\Trip;

interface DiscountRule
{
    public function apply(
        float $price,
        Trip $trip,
        int $seatsCount
    ): float;
}