<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info("Seeding database with default locations");

        $locations = [];
        array_push($locations, ["name" => "New York", "id" => 5128581]);
        array_push($locations, ["name" => "London", "id" => 2643743]);
        array_push($locations, ["name" => "Paris", "id" => 2968815]);
        array_push($locations, ["name" => "Berlin", "id" => 2950159]);
        array_push($locations, ["name" => "Tokyo", "id" => 1850147]);

        foreach($locations as $location) {
            Location::FirstOrCreate(["name" => $location["name"], "city_id" => $location["id"]]);
        }
    }
}
