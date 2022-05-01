<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeatherForcast extends Model
{
    use HasFactory;

    protected $fillable = [
            'weather',
            'temp',
            'feels_like',
            'temp_min',
            'temp_max',
            'humidity',
            'pressure',
            'city_id'
        ];
}
