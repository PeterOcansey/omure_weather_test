<?php

namespace App\Omure\Repos;

use App\Models\WeatherForcast;
use App\Omure\Utils\Constants;


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

        return $predicate->with('location')->get();
    }

    public function saveWeatherForcast(Array $weather_forcast){

        return WeatherForcast::Create([
                    "weather" => json_encode($weather_forcast["weather"]), 
                    "temp" => $weather_forcast["weather_forcast"]->temp,
                    "feels_like" => $weather_forcast["weather_forcast"]->feels_like,
                    "temp_min" => $weather_forcast["weather_forcast"]->temp_min,
                    "temp_max" => $weather_forcast["weather_forcast"]->temp_max,
                    "humidity" => $weather_forcast["weather_forcast"]->humidity,
                    "pressure" => $weather_forcast["weather_forcast"]->pressure,
                    "city_id" => $weather_forcast["city_id"],
                    "created_at" => $weather_forcast["timestamp"],
                    "updated_at" => $weather_forcast["timestamp"],
        ]);
    }

}