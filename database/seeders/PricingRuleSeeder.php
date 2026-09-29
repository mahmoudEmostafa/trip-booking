<?php

namespace Database\Seeders;

use App\Enums\TripType;
use App\Models\PricingRule;
use Illuminate\Database\Seeder;

class PricingRuleSeeder extends Seeder
{
    public function run(): void
    {
        PricingRule::create([
            'departure_city' => 'Damascus',
            'destination_city' => 'Homs',
            'type' => TripType::REGULAR,
            'price' => 20000,
        ]);

        PricingRule::create([
            'departure_city' => 'Damascus',
            'destination_city' => 'Homs',
            'type' => TripType::VIP,
            'price' => 30000,
        ]);

        PricingRule::create([
            'departure_city' => 'Damascus',
            'destination_city' => 'Aleppo',
            'type' => TripType::REGULAR,
            'price' => 30000,
        ]);

        PricingRule::create([
            'departure_city' => 'Damascus',
            'destination_city' => 'Aleppo',
            'type' => TripType::VIP,
            'price' => 45000,
        ]);
    }
}