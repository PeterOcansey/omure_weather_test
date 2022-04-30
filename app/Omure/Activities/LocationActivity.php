<?php

namespace App\Omure\Activities;

use App\Omure\Repos\LocationRepo;
use App\Omure\Services\HttpService;
use Illuminate\Support\Facades\Log;

class LocationActivity 
{
    protected $locationRepo;

    public function __construct(LocationRepo $locationRepo)
    {
        $this->locationRepo = $locationRepo;
    }

    public function processPendingLocations()
    {
        $locations = $this->locationRepo->getPendingLocations();

        foreach($locations as $location){
            
            $response = HttpService::fetchOpenWeatherGeoData($location->name);
            
            //Update Location
            $data["lat"] = $response[0]->lat;
            $data["lon"] = $response[0]->lon;
            $this->locationRepo->update($data, $location->id);

            Log::info($response[0]->lat);
        }

    }
}