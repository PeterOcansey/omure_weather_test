<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WeatherForcastTest extends TestCase
{

    /** @test **/
    public function a_weather_forcast_can_be_fetched()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->get('/weatherforcasts');

        $response->assertStatus(200);
    }
}
