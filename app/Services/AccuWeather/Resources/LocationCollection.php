<?php

namespace App\Services\AccuWeather\Resources;

use Illuminate\Support\Collection;

class LocationCollection extends Collection
{
    /**
     * 
     * @param array $items
     * @return void
     */
    public function __construct(array $items)
    {
        parent::__construct($items);
    }
}