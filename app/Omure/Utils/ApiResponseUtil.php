<?php 

namespace App\Omure\Utils;

class ApiResponseUtil
{
	public static function extract($response, $date)
	{
	    if(count($response->list) > 0 ){
            $collection = [];
            foreach($response->list as $data){
                array_push($collection, [
                                        "city_id" => $data->id,  
                                        "location" => $data->name, 
                                        "weather" => $data->weather, 
                                        "temp" => $data->main->temp, 
                                        "feels_like" => $data->main->feels_like,
                                        "temp_min" => $data->main->temp_min,
                                        "temp_max" => $data->main->temp_max,
                                        "pressure" => $data->main->pressure,
                                        "humidity" => $data->main->humidity,
                                        "created_at" => $date
                                    ]
                            );
            }

            return $collection;
        }

        return null;
	}
}