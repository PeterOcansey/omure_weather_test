<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Omure\Activities\WeatherForcastActivity;
use App\Omure\Api\ApiResponse;
use Illuminate\Support\Facades\Log;

class WeatherForcastController extends Controller
{
    
    protected $weatherForcastActivity;
    protected $apiResponse;

    public function __construct(WeatherForcastActivity $weatherForcastActivity, ApiResponse $apiResponse)
    {
        $this->weatherForcastActivity = $weatherForcastActivity;
        $this->apiResponse = $apiResponse;
    }

    
    public function index(Request $request)
    {
        try{
            return $this->weatherForcastActivity->listWeatherForcasts($request->post());

        }catch(\Exception $e){
            Log::info($e);
            return $this->apiResponse->serverError();
        }
    }
}
