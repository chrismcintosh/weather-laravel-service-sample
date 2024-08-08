<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\AccuWeather\Service;

class AccuWeatherServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(
            abstract: Service::class,
            concrete: fn() => new Service(
                uri: config('services.accuweather.uri'),
                token: config('services.accuweather.token'),
                timeout: config('services.accuweather.timeout'),
                retryTimes: config('services.accuweather.retry_times'),
                retryInterval: config('services.accuweather.retry_interval'),
            ),
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
