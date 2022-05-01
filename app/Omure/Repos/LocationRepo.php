<?php

namespace App\Omure\Repos;

use App\Models\Location;


class LocationRepo
{
    public function getLocations()
    {
        return Location::get();
    }

    public function getLocationIds()
    {
        return Location::get("city_id");
    }

    public function getPendingLocations()
    {
        return Location::where(function($query){
            return $query->whereNull('lat')
                    ->orWhereNull('lon');
        })->get();
    }
    
    public function update(Array $data, $id)
    {
        $location = Location::find($id);

        if($location){
            
            $location->lat = $data['lat'];
            $location->lon = $data['lon'];

            return $location->update() ? $location : null;
        }

        return null;
    }
}