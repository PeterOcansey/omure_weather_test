<?php

namespace App\Omure\Activities;

use App\Omure\Repos\WeatherForcastRepo;
use App\Omure\Services\HttpService;
use Illuminate\Support\Facades\Log;
use App\Omure\Utils\DateUtil;
use App\Omure\Traits\LocationTrait;
use App\Omure\Repos\LocationRepo;
use App\Omure\Api\ApiResponse;

class WeatherForcastActivity 
{
    use LocationTrait;

    protected $weatherForcastRepo;
    protected $apiResponse;

    public function __construct(WeatherForcastRepo $weatherForcastRepo, LocationRepo $locationRepo, ApiResponse $apiResponse)
    {
        $this->weatherForcastRepo = $weatherForcastRepo;
        $this->locationRepo = $locationRepo;
        $this->apiResponse = $apiResponse;
    }

    public function listWeatherForcasts($filters)
    {
        //Ensure a date is pass or set a new date
        if(!isset($filters['date'])) $filters['date'] = now();

        if(!DateUtil::validateDate($filters['date'],'Y-m-d'))
            return $this->apiResponse->generalError("Invalid date supplied, expected format is 'Y-m-d'");

        //Fetch data from database
        $forcasts = $this->weatherForcastRepo->getForcasts($filters);

        if(!$forcasts || count($forcasts) <= 0){

            //Fetch data from open weather map
            $response = HttpService::fetchHistoricOpenWeatherData($this->locationIds(), DateUtil::timestamp($filters['date']));
            if($response){
                return $response;
            }

            return $this->apiResponse->notFoundError("Sorry, weather forcast for {$filters['date']} not available");
        }

        return $forcasts;

        
    }

}