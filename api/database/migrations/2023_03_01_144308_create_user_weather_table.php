<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_weather', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('location_name');
            $table->string('location_country');
            $table->string('location_tz_id');
            $table->integer('temp_c');
            $table->integer('temp_f');
            $table->boolean('is_day');
            $table->string('condition_text');
            $table->string('condition_icon');
            $table->string('condition_code');
            $table->string("wind_mph");
            $table->string("wind_kph");
            $table->string("wind_degree");
            $table->string("wind_dir");
            $table->string("pressure_mb");
            $table->string("pressure_in");
            $table->string("precip_mm");
            $table->string("precip_in");
            $table->string("humidity");
            $table->string("cloud");
            $table->string("feelslike_c");
            $table->string("feelslike_f");
            $table->string("vis_km");
            $table->string("vis_miles");
            $table->string("uv");
            $table->string("gust_mph");
            $table->string("gust_kph");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_weather');
    }
};
