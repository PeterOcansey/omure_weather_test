<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeatherForcastsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weather_forcasts', function (Blueprint $table) {
            $table->id();
            $table->json("weather")->nullable();
            $table->double("temp");
            $table->double("feels_like")->default(0);
            $table->double("temp_min")->default(0);
            $table->double("temp_max")->default(0);
            $table->integer("pressure")->default(0);
            $table->integer("humidity")->default(0);
            $table->integer('city_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weather_forcasts');
    }
}
