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

}