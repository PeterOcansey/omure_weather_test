<?php 

namespace App\Omure\Traits;

trait LocationTrait 
{
    protected $locationRepo;

    protected function setLocationRepo($locationRepo)
    {
        $this->locationRepo = $locationRepo;
    }

    protected function locationIds()
    {
        $locations =  $this->locationRepo->getLocationIds()->map(function ($location) {
            return $location->city_id;
        })->toArray();

        return implode(",", $locations);
    }

}