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

        $locations = array("New York", "London", "Paris", "Berlin", "Tokyo");

        foreach($locations as $location) {
            $new_location = Location::FirstOrCreate(["name" => $location]);
        }
    }
}
