<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchTripRequest;
use App\Http\Requests\StoreTripRequest;
use App\Http\Resources\TripResource;
use App\Services\TripSearchService;
use App\Services\TripService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class TripController extends Controller
{
    use ApiResponseTrait;

    public function store(
        StoreTripRequest $request,
        TripService $tripService
    ): JsonResponse {
        $trip = $tripService->create(
            $request->validated()
        );

        return $this->successResponse(
            new TripResource($trip),
            'Trip created successfully',
            201
        );
    }

    public function index(
        SearchTripRequest $request,
        TripSearchService $tripSearchService
    ): JsonResponse {
        $trips = $tripSearchService->search(
            $request->validated()
        );

        return $this->successResponse(
            TripResource::collection($trips),
            'Trips retrieved successfully'
        );
    }
}