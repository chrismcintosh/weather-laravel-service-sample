<?php

declare(strict_types=1);

namespace App\Services\AccuWeather;

use App\Services\AccuWeather\Exceptions\RequestException;
use App\Services\AccuWeather\Resources\LocationCollection;
use App\Services\Concerns\HasFake;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;
use App\Services\AccuWeather\Resources\LocationDto;

class Service
{
    use HasFake;

    public function __construct(
        protected string $uri,
        protected string $token,
        protected int $timeout = 10,
        protected null|int $retryTimes = null,
        protected null|int $retryInterval = null,
    ) {
    }

    public function makeRequest(): PendingRequest
    {
        $request = Http::baseUrl($this->uri)
            ->timeout($this->timeout)
            ->withQueryParameters([
                'apikey' => $this->token
            ]);

        if ($this->retryTimes !== null && $this->retryInterval !== null) {
            $request->retry($this->retryTimes, $this->retryInterval);
        }

        return $request;
    }

    public function topCities($group = '150'): Collection
    {
        $response = $this
            ->makeRequest()
            ->get("locations/v1/topcities/$group");

        if ($response->failed()) {
            throw new RequestException($response);
        }

        $response = $response->json();
        $items = collect($response)->each(function ($item) {
            return new LocationDto(
                $item['Version'],
                $item['Key'],
                $item['Type'],
                $item['Rank'],
                $item['LocalizedName'],
                $item['EnglishName'],
                $item['PrimaryPostalCode'],
                $item['Region'],
                $item['Country'],
                $item['AdministrativeArea'],
                $item['TimeZone'],
                $item['GeoPosition'],
                $item['IsAlias'],
                $item['SupplementalAdminAreas'],
                $item['DataSets']
            );
        });

        return new LocationCollection($items->toArray());
    }

    public function location($key)
    {
        $request = $this
            ->makeRequest()
            ->get("locations/v1/$key")
            ->json();

        if ($request->failed()) {
            throw new RequestException($request);
        }

        return $request;
    }
}