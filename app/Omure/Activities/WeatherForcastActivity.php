<?php

namespace App\Omure\Activities;

use App\Omure\Repos\WeatherForcastRepo;
use App\Omure\Services\HttpService;
use Illuminate\Support\Facades\Log;
use App\Omure\Utils\DateUtil;
use App\Omure\Traits\LocationTrait;
use App\Omure\Repos\LocationRepo;
use App\Omure\Api\ApiResponse;
use App\Omure\Utils\ApiResponseUtil;
use App\Omure\Utils\Constants;
use App\Events\NewWeatherForcast;

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
        if(!isset($filters['date'])) $filters['date'] = date(Constants::DATE_FORMAT_SHORT);

        if(!DateUtil::validateDate($filters['date'],Constants::DATE_FORMAT_SHORT))
            return $this->apiResponse->generalError("Invalid date supplied, expected format is " . Constants::DATE_FORMAT_SHORT);

        //Fetch data from database
        $forcasts = $this->weatherForcastRepo->getForcasts($filters);

        if(!$forcasts || count($forcasts) <= 0){

            //Fetch data from open weather map
            $response = HttpService::fetchHistoricOpenWeatherData($this->locationIds(), DateUtil::timestamp($filters['date']));
            if($response){
                
                $weather_forcasts = ApiResponseUtil::extract($response, $filters["date"]);
            
                //Dispatch event
                NewWeatherForcast::dispatch($weather_forcasts);

                return $this->apiResponse->success("Weather forcast retrieved successfully", ["data" => $weather_forcasts]);
            }

            return $this->apiResponse->notFoundError("Sorry, weather forcast for {$filters['date']} not available");
        }

        return $forcasts;
    }

    public function storeWeatherForcasts(Array $weather_forcasts){
        foreach($weather_forcasts as $weather_forcast){
            //Generate a new timestamp based on request date for saving
            $date = new \DateTime($weather_forcast["date"]);
            $timestamp = $date->getTimestamp();
            $weather_forcast["timestamp"] = $timestamp;

            //Save new Weather Forcast
            $this->weatherForcastRepo->saveWeatherForcast($weather_forcast);
        }
    }

}