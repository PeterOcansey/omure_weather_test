<?php

namespace App\Listeners;

use App\Events\NewWeatherForcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SaveWeatherForcast
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\NewWeatherForcast  $event
     * 
     * @return void
     */
    public function handle(NewWeatherForcast $event)
    {
        //
        Log::info('New Weather Forcast Event fired up');
        
        Log::info($event->weather_forcasts);
    }
}
