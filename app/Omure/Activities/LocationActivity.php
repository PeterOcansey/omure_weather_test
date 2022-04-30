<?php

namespace App\Omure\Activities;

use App\Omure\Repos\LocationRepo;
use App\Omure\Services\HttpService;
use Illuminate\Support\Facades\Log;

class LocationActivity 
{
    private $locationRepo;

    public function __construct(LocationRepo $locationRepo)
    {
        $locationRepo = $this->locationRepo;
    }

    public function processPendingLocations()
    {
        $locations = $this->locationRepo->getPendingLocations();

        foreach($locations as $location){
            $response = HttpService::fetchOpenWeatherGeoData($location->name);

            Log::info($response);
        }

    }
}