<?php

namespace App\Services\AccuWeather\Resources;

class LocationDto
{
    public function __construct(
        protected int $version,
        protected string $key,
        protected string $type,
        protected int $rank,
        protected string $localizedName,
        protected string $englishName,
        protected string $primaryPostalCode,
        protected array $region,
        protected array $country,
        protected array $administrativeArea,
        protected array $timeZone,
        protected array $geoPosition,
        protected bool $isAlias,
        protected array $supplementalAdminAreas,
        protected array $dataSets
    ) {
    }
}