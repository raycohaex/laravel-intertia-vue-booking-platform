<?php

namespace App\Providers;

use App\Services\AccommodationSearchService;
use Illuminate\Support\ServiceProvider;
use Stripe;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    }
}
