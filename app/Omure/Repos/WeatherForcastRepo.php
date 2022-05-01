<?php

namespace App\Omure\Repos;

use App\Models\WeatherForcast;
use App\Omure\Utils\Constants;
use Illuminate\Support\Facades\DB;


class WeatherForcastRepo
{
    public function getWeatherForcast()
    {
        return WeatherForcast::get();
    }

    public function getForcasts($filters)
    {
        $predicate = WeatherForcast::query();
        foreach ($filters as $key => $filter) {
            if(in_array($key, Constants::FILTER_PARAM_IGNORE_LIST))
            {
                continue;
            }
    
            $predicate->where($key, $filter);
        }
        $predicate->whereDate("created_at", $filters["date"]);
        return $predicate->get();
    }

    public function saveWeatherForcast(Array $weather_forcast){

        return WeatherForcast::Create([
                    "weather" => json_encode($weather_forcast["weather"]), 
                    "temp" => $weather_forcast["temp"],
                    "feels_like" => $weather_forcast["feels_like"],
                    "temp_min" => $weather_forcast["temp_min"],
                    "temp_max" => $weather_forcast["temp_max"],
                    "humidity" => $weather_forcast["humidity"],
                    "pressure" => $weather_forcast["pressure"],
                    "city_id" => $weather_forcast["city_id"],
                    "created_at" => $weather_forcast["timestamp"],
        ]);
    }

}