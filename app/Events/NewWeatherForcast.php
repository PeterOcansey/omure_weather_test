<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewWeatherForcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    
    public $weather_forcasts;

    /**
     * Create a new event instance.
     * @var Array $weather_forcasts
     * 
     * @return void
     */
    public function __construct(Array $weather_forcasts)
    {
        $this->weather_forcasts = $weather_forcasts;
    }

    
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

}
