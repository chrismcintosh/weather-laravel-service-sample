<?php

declare(strict_types=1);

use App\Services\AccuWeather\Service;
use App\Services\AccuWeather\Resources\LocationCollection;
use App\Services\AccuWeather\Resources\LocationDto;

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

it('can get a location by id', function () {

    $service = app(Service::class);

    $location = $service->locationByKey('351194');

    expect($location)
        ->toBeInstanceOf(LocationDto::class);
});