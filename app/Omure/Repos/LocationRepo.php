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
}