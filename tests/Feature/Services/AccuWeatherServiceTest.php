<?php

declare(strict_types=1);

use App\Services\AccuWeather\Service;
use App\Services\AccuWeather\Resources\LocationCollection;

it('can get a build service from the container', function () {
    $service = app(
        abstract: Service::class,
    );

    expect($service)
        ->toBeInstanceOf(Service::class);
});

it('can create a built request', function () {
    expect(app(Service::class)->makeRequest())
        ->toBeInstanceOf(Illuminate\Http\Client\PendingRequest::class);
});

it('can get a list of top cities', function () {

    $service = app(Service::class);

    $locations = $service->topCities();

    expect($locations)
        ->toBeInstanceOf(LocationCollection::class);
});