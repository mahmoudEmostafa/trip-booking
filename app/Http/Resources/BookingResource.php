<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'unit_price' => $this->unit_price,
            'total_price' => $this->total_price,

            'trip' => [
                'id' => $this->trip->id,
                'departure_city' => $this->trip->departure_city,
                'destination_city' => $this->trip->destination_city,
                'departure_at' => $this->trip->departure_at,
                'type' => $this->trip->type,
            ],

            'seats' => $this->bookingSeats->map(
                fn ($bookingSeat) =>
                    $bookingSeat->tripSeat->seat->seat_number
            ),
        ];
    }
}