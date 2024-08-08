<?php

declare(strict_types=1);

use App\Services\AccuWeather\Service;

beforeEach(
    fn() => $this->service = new Service(
        uri: 'https://api.test.com',
        token: 'test',
        timeout: 10,
    )
);

it('can build a new service', function () {
    expect($this->service)->toBeInstanceOf(Service::class);
});

