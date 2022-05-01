<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WeatherForcastFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'weather' => json_encode(["main" => "Clear", "description" => "Weather is clear", "icon" => "n8c"]),
            'temp' => $this->faker->randomNumber(5, false),
            'feels_like' => $this->faker->randomNumber(5, true),
            'temp_max' => $this->faker->randomNumber(5, true),
            'pressure' => $this->faker->randomNumber(5, false),
            'humidity' => $this->faker->randomNumber(5, false),
            'city_id' => $this->faker->randomNumber(5, true)
        ];
    }
}
