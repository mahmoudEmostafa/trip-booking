<?php

namespace App\Providers;

use App\Repositories\Contracts\PricingRuleRepositoryInterface;
use App\Repositories\Contracts\TripRepositoryInterface;
use App\Repositories\EloquentPricingRuleRepository;
use App\Repositories\EloquentTripRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
         $this->app->bind(
        TripRepositoryInterface::class,
        EloquentTripRepository::class
    );
     $this->app->bind(
        PricingRuleRepositoryInterface::class,
        EloquentPricingRuleRepository::class
    );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
