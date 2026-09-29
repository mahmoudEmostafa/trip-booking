<?php

namespace App\Contracts;

use App\Models\Trip;

interface PriceCalculator
{
    public function calculate(Trip $trip): float;
}