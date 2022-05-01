<?php 

namespace App\Omure\Utils;

class ApiResponseUtil
{
	public static function extract($response, $date)
	{
	    if(count($response->list) > 0 ){
            $collection = [];
            foreach($response->list as $data){
                array_push($collection, ["city_id" => $data->id,  "location" => $data->name, "weather" => $data->weather, "weather_forcast" => $data->main, "date" => $date]);
            }

            return $collection;
        }

        return null;
	}
}