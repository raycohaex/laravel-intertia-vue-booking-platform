<?php

namespace App\Providers;

use App\Contracts\IAccommodationPricing;
use App\Services\AccommodationPricingService;
use App\Services\AccommodationSearchService;
use Illuminate\Support\ServiceProvider;

class AccommodationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IAccommodationPricing::class, AccommodationPricingService::class);

        // TODO: replace with interface
        $this->app->bind(AccommodationSearchService::class, function ($app) {
            return new AccommodationSearchService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
