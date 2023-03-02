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
            $table->string('location_name')->nullable();
            $table->string('location_country')->nullable();
            $table->string('location_tz_id')->nullable();
            $table->integer('temp_c')->nullable();
            $table->integer('temp_f')->nullable();
            $table->boolean('is_day')->nullable();
            $table->string('condition_text')->nullable();
            $table->string('condition_icon')->nullable();
            $table->string('condition_code')->nullable();
            $table->string("wind_mph")->nullable();
            $table->string("wind_kph")->nullable();
            $table->string("wind_degree")->nullable();
            $table->string("wind_dir")->nullable();
            $table->string("pressure_mb")->nullable();
            $table->string("pressure_in")->nullable();
            $table->string("precip_mm")->nullable();
            $table->string("precip_in")->nullable();
            $table->string("humidity")->nullable();
            $table->string("cloud")->nullable();
            $table->string("feelslike_c")->nullable();
            $table->string("feelslike_f")->nullable();
            $table->string("vis_km")->nullable();
            $table->string("vis_miles")->nullable();
            $table->string("uv")->nullable();
            $table->string("gust_mph")->nullable();
            $table->string("gust_kph")->nullable();
            $table->boolean("status")->nullable();
            $table->integer("error_code")->nullable();
            $table->string("error_message")->nullable();
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
