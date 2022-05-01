<?php

namespace App\Omure\Activities;

use App\Omure\Repos\WeatherForcastRepo;
use App\Omure\Services\HttpService;
use Illuminate\Support\Facades\Log;

class WeatherForcastActivity 
{
    protected $weatherForcastRepo;

    public function __construct(WeatherForcastRepo $weatherForcastRepo)
    {
        $this->weatherForcastRepo = $weatherForcastRepo;
    }
    
}