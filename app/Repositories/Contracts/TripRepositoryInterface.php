<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface TripRepositoryInterface
{
    public function findAvailableTrips(
        string $destinationCity,
        string $type,
        int $seatsCount,
        string $date
    ): Collection;
}