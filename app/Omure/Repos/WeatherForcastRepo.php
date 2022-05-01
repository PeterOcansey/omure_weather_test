<?php

namespace App\Omure\Repos;

use App\Models\WeatherForcast;


class WeatherForcastRepo
{
    public function getWeatherForcast()
    {
        return WeatherForcast::get();
    }

}