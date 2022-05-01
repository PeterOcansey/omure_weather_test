<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Omure\Utils\Constants;

class WeatherForcast extends Model
{
    use HasFactory;

    protected $hidden = ['updated_at','id'];

    protected $fillable = [
            'weather',
            'temp',
            'feels_like',
            'temp_min',
            'temp_max',
            'humidity',
            'pressure',
            'city_id',
            'created_at',
        ];

    public function getWeatherAttribute($weather)
    {
        return json_decode($weather);
    }

    public function getCreatedAtAttribute($created_at)
    {
        return parent::asDateTime($created_at)->format(Constants::DATE_FORMAT_SHORT);
    }

    
}
