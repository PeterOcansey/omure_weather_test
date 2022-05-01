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
        return $predicate->whereDate("created_at", $filters["date"])->get();
    }

    public function saveWeatherForcast(Array $weather_forcast){
        $w_forcast = WeatherForcast::where("city_id", $weather_forcast["city_id"])
                                    ->whereDate("created_at",date('Y-m-d',$weather_forcast["timestamp"]))->first();

        if(!$w_forcast){
            $w_forcast = new WeatherForcast;
            $w_forcast->created_at = $weather_forcast["timestamp"];
        }

        $w_forcast->weather = json_encode($weather_forcast["weather"]);
        $w_forcast->temp = $weather_forcast["temp"];
        $w_forcast->feels_like = $weather_forcast["feels_like"];
        $w_forcast->temp_min = $weather_forcast["temp_min"];
        $w_forcast->temp_max = $weather_forcast["temp_max"];
        $w_forcast->humidity = $weather_forcast["humidity"];
        $w_forcast->pressure = $weather_forcast["pressure"];
        $w_forcast->city_id = $weather_forcast["city_id"];
        $w_forcast->city_name = $weather_forcast["city_name"];

        if($w_forcast->save())
            return $w_forcast;
        else
            return null;
    }

}