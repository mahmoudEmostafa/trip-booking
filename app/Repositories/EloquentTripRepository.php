<?php

namespace App\Repositories;

use App\Enums\TripSeatStatus;
use App\Enums\TripStatus;
use App\Models\Trip;
use App\Repositories\Contracts\TripRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class EloquentTripRepository implements TripRepositoryInterface
{
    public function findAvailableTrips(
    string $destinationCity,
    string $type,
    int $seatsCount,
    string $date
): Collection {
    return Trip::query()
        ->where('destination_city', $destinationCity)
        ->where('type', $type)
        ->where('status', TripStatus::SCHEDULED)
        ->whereDate('departure_at', $date)
        ->where('departure_at', '>', now())
        ->withCount([
            'tripSeats as available_seats_count' => function ($query) {
                $query->where(
                    'status',
                    TripSeatStatus::AVAILABLE
                );
            },
        ])
        ->having('available_seats_count', '>=', $seatsCount)
        ->with('bus')
        ->orderBy('departure_at')
        ->get();
}
}