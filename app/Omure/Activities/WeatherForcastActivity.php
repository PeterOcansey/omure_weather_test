<?php

namespace App\Omure\Activities;

use App\Omure\Repos\WeatherForcastRepo;
use App\Omure\Services\HttpService;
use Illuminate\Support\Facades\Log;
use App\Omure\Utils\DateUtil;

class WeatherForcastActivity 
{
    protected $weatherForcastRepo;

    public function __construct(WeatherForcastRepo $weatherForcastRepo)
    {
        $this->weatherForcastRepo = $weatherForcastRepo;
    }

    public function listWeatherForcasts($filters)
    {
        //Fetch data from database
        $forcasts = $this->weatherForcastRepo->getForcasts($filters);
        Log::info($forcasts);

        if(!$forcasts || count($forcasts) <= 0){
            //Convert date to unix timestamp
            $date = DateUtil::timestamp($filters['date']);
            Log::info($date);
            $response = HttpService::fetchHistoricOpenWeatherData(35.6828387, 139.7594549, $date);

            return $response->main;
            //Log::debug($response);
        }

        return $forcasts;

        //Fetch data from open weather map
    }

}