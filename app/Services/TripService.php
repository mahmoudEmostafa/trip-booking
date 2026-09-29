<?php

namespace App\Services;

use App\Exceptions\BusAlreadyScheduledException;
use App\Models\Trip;
use App\Repositories\Contracts\PricingRuleRepositoryInterface;
use Illuminate\Support\Facades\DB;

class TripService
{
    public function __construct(
        private PricingRuleRepositoryInterface $pricingRuleRepository
    ) {
    }

    public function create(array $data): Trip
    {
        return DB::transaction(function () use ($data) {

            $busIsScheduled = Trip::query()
                ->where('bus_id', $data['bus_id'])
                ->where('status', 'scheduled')
                ->where(function ($query) use ($data) {
                    $query
                        ->where(
                            'departure_at',
                            '<',
                            $data['arrival_at']
                        )
                        ->where(
                            'arrival_at',
                            '>',
                            $data['departure_at']
                        );
                })
                ->exists();

            if ($busIsScheduled) {
                throw new BusAlreadyScheduledException();
            }

            $pricingRule = $this->pricingRuleRepository->findByTripDetails(
                $data['departure_city'],
                $data['destination_city'],
                $data['type']
            );

            $trip = Trip::create([
                ...$data,
                'price' => $pricingRule->price,
            ]);

            $trip->load('bus.seats');

            $trip->tripSeats()->createMany(
                $trip->bus->seats->map(function ($seat) {
                    return [
                        'seat_id' => $seat->id,
                    ];
                })->toArray()
            );

            return $trip;
        });
    }
}