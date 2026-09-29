<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'departure_city' => $this->departure_city,
            'destination_city' => $this->destination_city,
            'departure_at' => $this->departure_at,
            'arrival_at' => $this->arrival_at,
            'type' => $this->type,
            'price' => $this->price,

            'available_seats_count' => $this->when(
                isset($this->available_seats_count),
                $this->available_seats_count
            ),
        ];
    }
}