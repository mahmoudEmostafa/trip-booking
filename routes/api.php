<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\TripController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




Route::post('/trips', [TripController::class, 'store']);

Route::post('/bookings', [BookingController::class, 'store']);

Route::patch(
    '/bookings/{booking}/confirm',
    [BookingController::class, 'confirm']
);

Route::patch(
    '/bookings/{booking}/cancel',
    [BookingController::class, 'cancel']
);

Route::post('/trips', [TripController::class, 'store']);
Route::get('/trips', [TripController::class, 'index']);