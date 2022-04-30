<?php

namespace App\Omure\Activities;

use App\Omure\Repos\LocationRepo;

class LocationActivity 
{
    private $locationRepo;

    public function __construct(LocationRepo $locationRepo)
    {
        $locationRepo = $this->locationRepo;
    }

    public function processNullLocations()
    {
        //$locations = $this->locationRepo->get()
    }
}