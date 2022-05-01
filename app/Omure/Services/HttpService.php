<?php

namespace App\Omure\Services;

use Illuminate\Support\Facades\Http;

class HttpService
{
    
    public static function fetchOpenWeatherData(float $lat, float $lon)
    {
        $response = Http::acceptJson()->get(env("OPEN_WEATHER_API_URL", ""), [
            'lat' => $lat,
            'lon' => $lon,
            'appId' => env("OPEN_WEATHER_API_KEY", "")
        ]);

        return json_decode($response->getBody()->getContents());
    }

    public static function fetchHistoricOpenWeatherData(String $locations, int $timestamp)
    {
        $response = Http::acceptJson()->get(env("OPEN_WEATHER_API_URL", ""), [
            'id' => $locations,
            'start' => $timestamp,
            'end' => $timestamp,
            'appId' => env("OPEN_WEATHER_API_KEY", "")
        ]);

        if($response->successful()){
            return json_decode($response->getBody()->getContents());
        }

        return null;
    }


    /**
     * 
     * @param String $location_name
     * 
     */
    public static function fetchOpenWeatherGeoData(String $location_name)
    {
        $response = Http::acceptJson()->get(env("OPEN_GEO_API_URL", ""), [
            'q' => $location_name,
            'appId' => env("OPEN_WEATHER_API_KEY", "")
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}