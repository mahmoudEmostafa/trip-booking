<?php

use App\Exceptions\CancellationNotAllowedException;
use App\Exceptions\InvalidBookingStatusTransitionException;
use App\Exceptions\NotEnoughSeatsException;
use App\Exceptions\TripNotBookableException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
         $exceptions->render(function (
        ValidationException $e
    ) {
        return response()->json([
            'success' => false,
            'message' => 'Validation failed.',
            'errors' => $e->errors(),
        ], 422);
    });

    $exceptions->render(function (
    TripNotBookableException $e
    ) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
            'errors' => [],
        ], 409);
    });
    $exceptions->render(function (
    InvalidBookingStatusTransitionException $e
) {
    return response()->json([
        'success' => false,
        'message' => $e->getMessage(),
        'errors' => [],
    ], 409);
});
$exceptions->render(function (CancellationNotAllowedException $e) {
    return response()->json([
        'success' => false,
        'message' => $e->getMessage(),
    ], 409);
});
$exceptions->render(function (
    \App\Exceptions\BusAlreadyScheduledException $e
) {
    return response()->json([
        'success' => false,
        'message' => $e->getMessage(),
        'errors' => [],
    ], 409);
});

    $exceptions->render(function (
    NotEnoughSeatsException $e
    ) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
            'errors' => [],
        ], 409);
    });
    })->create();
