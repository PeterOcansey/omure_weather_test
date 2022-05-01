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

    /**
     * List Weather Forcasts
     * 
     * Query DB for weather forcasts based on filters
     * Fetch from open weather api on empty results
     * 
     * @params Array $filters
     * 
     * @return json response
     * 
     */
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
                $forcasts = ApiResponseUtil::extract($response, $filters["date"]);
            
                //Dispatch event
                NewWeatherForcast::dispatch($forcasts);

            }else{
                return $this->apiResponse->notFoundError("Sorry, weather forcast for {$filters['date']} not available");
            }
        }
        return $this->apiResponse->success("Weather forcast retrieved successfully", ["data" => $forcasts]);
    }


    /**
     * Fetch Weather Forcasts
     * 
     * Fetch from open weather api on empty results
     * Dispatch NewWeatherForcast event with results
     * 
     * @return void
     * 
     */

    public function fetchWeatherForcasts()
    {
        $date = date(Constants::DATE_FORMAT_SHORT);

        //Fetch data from open weather map
        $response = HttpService::fetchHistoricOpenWeatherData($this->locationIds(), DateUtil::timestamp($date));
        if($response){
            $forcasts = ApiResponseUtil::extract($response, $date);
            //Dispatch event
            NewWeatherForcast::dispatch($forcasts);
        }
    }


    /**
     * New Weather Forcasts
     * 
     * Add or Update new weather forcasts
     * 
     * @params Array $weather_forcasts
     * 
     * @return void
     * 
     */
    public function storeWeatherForcasts(Array $weather_forcasts){
        foreach($weather_forcasts as $weather_forcast){
            //Generate a new timestamp based on request date for saving
            $weather_forcast["timestamp"] = strtotime($weather_forcast['created_at']." 00:00"); 

            //Save new Weather Forcast
            $this->weatherForcastRepo->saveWeatherForcast($weather_forcast);
        }
    }

}