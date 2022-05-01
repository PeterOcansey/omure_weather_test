<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\WeatherForcast;
use Illuminate\Support\Facades\Event;
use App\Listeners\SaveWeatherForcast;
use App\Events\NewWeatherForcast;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WeatherForcastTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test a weather forcast can be created
     * Assert our database has the right record
     * 
     * @return void
     * 
     * @test
     * 
     */
    public function a_weather_forcast_can_be_created()
    {
        $this->withoutExceptionHandling();

        $weather_forcast = WeatherForcast::factory()->create();

        $this->assertModelExists($weather_forcast);
    }

    /**
     * Test a weather forcast fetch endpoint
     * Assert our endpoint is ok
     * Assert our endpoint returns a valid json strucutre
     *  
     * @test 
     *
     * */
    public function a_weather_forcast_can_be_fetched()
    {
        $this->withoutExceptionHandling();

        $weather_forcast = WeatherForcast::factory()->create();

        $response = $this->get('/api/weatherforcasts');

        $response->assertStatus(200)
                ->assertJsonStructure(['code','message']);
    }

    /**
     * Assert our SaveWeatherForcast event listener is attached to the NewWeatherForcast event
     * 
     * @test
     * 
     */
    public function test_is_attached_to_event()
    {
        Event::fake();
        Event::assertListening(
            NewWeatherForcast::class,
            SaveWeatherForcast::class
        );
    }


}
