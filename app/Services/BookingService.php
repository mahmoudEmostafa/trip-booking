<?php

namespace App\Services;

use App\Enums\BookingStatus;
use App\Enums\TripSeatStatus;
use App\Enums\TripStatus;
use App\Exceptions\CancellationNotAllowedException;
use App\Exceptions\InvalidBookingStatusTransitionException;
use App\Exceptions\NotEnoughSeatsException;
use App\Exceptions\TripNotBookableException;
use App\Models\Booking;
use App\Models\Trip;
use App\Services\Pricing\PricingService;
use Illuminate\Support\Facades\DB;

class BookingService
{
    public function __construct(
        private PricingService $pricingService
    ) {
    }

    public function create(array $data): Booking
    {
        return DB::transaction(function () use ($data) {

            $trip = Trip::findOrFail($data['trip_id']);

            if (
                $trip->status !== TripStatus::SCHEDULED ||
                $trip->departure_at->isPast()
            ) {
                throw new TripNotBookableException();
            }

            $tripSeats = $trip->tripSeats()
                ->where('status', TripSeatStatus::AVAILABLE)
                ->inRandomOrder()
                ->lockForUpdate()
                ->limit($data['seats_count'])
                ->get();

            if ($tripSeats->count() < $data['seats_count']) {
                throw new NotEnoughSeatsException();
            }

            // Calculate final unit price after discount
            $unitPrice = $this->pricingService->calculate(
                $trip,
                $data['seats_count']
            );

            $totalPrice = $unitPrice * $data['seats_count'];

            $booking = Booking::create([
                'customer_id' => $data['customer_id'],
                'trip_id' => $trip->id,
                'employee_id' => $data['employee_id'] ?? null,
                'status' => BookingStatus::PENDING,
                'unit_price' => $unitPrice,
                'total_price' => $totalPrice,
            ]);

            foreach ($tripSeats as $tripSeat) {

                $tripSeat->update([
                    'status' => TripSeatStatus::RESERVED,
                ]);

                $booking->bookingSeats()->create([
                    'trip_seat_id' => $tripSeat->id,
                ]);
            }

            $booking->load([
                'trip',
                'customer',
                'bookingSeats.tripSeat.seat',
            ]);

            return $booking;
        });
    }

    public function confirm(Booking $booking): Booking
    {
        return DB::transaction(function () use ($booking) {

            if ($booking->status !== BookingStatus::PENDING) {
                throw new InvalidBookingStatusTransitionException(
                    'Only pending bookings can be confirmed.'
                );
            }

            $booking->update([
                'status' => BookingStatus::CONFIRMED,
            ]);

            return $booking->fresh([
                'trip',
                'customer',
                'bookingSeats.tripSeat.seat',
            ]);
        });
    }

   public function cancel(Booking $booking): Booking
{
    return DB::transaction(function () use ($booking) {

        $booking->load('trip');

        if (! in_array($booking->status, [
            BookingStatus::PENDING,
            BookingStatus::CONFIRMED,
        ], true)) {
            throw new InvalidBookingStatusTransitionException(
                'This booking cannot be cancelled.'
            );
        }

        if (now()->greaterThanOrEqualTo(
            $booking->trip->departure_at->copy()->subHours(2)
        )) {
            throw new CancellationNotAllowedException();
        }

        $booking->load('bookingSeats');

        foreach ($booking->bookingSeats as $bookingSeat) {

            $tripSeat = $bookingSeat->tripSeat()
                ->lockForUpdate()
                ->first();

            $tripSeat->update([
                'status' => TripSeatStatus::AVAILABLE,
            ]);
        }

        $booking->update([
            'status' => BookingStatus::CANCELLED,
        ]);

        return $booking->fresh([
            'trip',
            'customer',
            'bookingSeats.tripSeat.seat',
        ]);
    });
}
}