<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use App\Services\BookingService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class BookingController extends Controller
{
    use ApiResponseTrait;

    public function __construct(
        private BookingService $bookingService
    ) {
    }

    public function store(StoreBookingRequest $request): JsonResponse
    {
        $booking = $this->bookingService->create(
            $request->validated()
        );

        return $this->successResponse(
            new BookingResource($booking),
            'Booking created successfully',
            201
        );
    }

    public function confirm(Booking $booking): JsonResponse
    {
        $booking = $this->bookingService->confirm($booking);

        return $this->successResponse(
            new BookingResource($booking),
            'Booking confirmed successfully'
        );
    }

    public function cancel(Booking $booking): JsonResponse
    {
        $booking = $this->bookingService->cancel($booking);

        return $this->successResponse(
            new BookingResource($booking),
            'Booking cancelled successfully'
        );
    }
}