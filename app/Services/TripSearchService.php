<?php

namespace App\Services;

use App\Repositories\Contracts\TripRepositoryInterface;
use Illuminate\Support\Collection;

class TripSearchService
{
    public function __construct(
        private TripRepositoryInterface $tripRepository
    ) {
    }

    public function search(array $data): Collection
    {
        return $this->tripRepository->findAvailableTrips(
            $data['destination_city'],
            $data['type'],
            $data['seats_count'],
            $data['date']
        );
    }
}