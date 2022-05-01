<?php 

namespace App\Omure\Utils;

class ApiResponseUtil
{
	public static function extract($response)
	{
	    if(count($response->list) > 0 ){
            $collection = [];
            foreach($response->list as $data){
                array_push($collection, ["city_id" => $data->id,  "location" => $data->name, "weather_forcast" => $data->main]);
            }

            return $collection;
        }

        return null;
	}
}