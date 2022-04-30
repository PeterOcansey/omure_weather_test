<?php

namespace App\Omure\Services;

use Illuminate\Support\Facades\Http;

class HttpService
{
    
    public static function fetchOpenWeatherDataData(float $lat, float $lon)
    {
        $response = Http::acceptJson()->get(env("OPEN_WEATHER_API", ""), [
            'lat' => $lat,
            'lon' => $lon,
            'appId' => env("OPEN_WEATHER_API_KEY", "")
        ]);

        return json_decode($this->response->getBody()->getContents());
    }
}