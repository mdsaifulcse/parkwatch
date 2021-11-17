<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppPreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_preferences', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('client_id', false,10);
            $table->string('sound_voice',20)->default(0);
            $table->tinyInteger('guidance_volume',false,3)->default(5)->comment('max:1-10');
            $table->string('avoid_highway',20)->default(0);
            $table->string('avoid_toll',20)->default(0);
            $table->string('avoid_ferrie',20)->default(0);
            $table->string('color_schema',20)->default(\App\Models\AppPreference::DAY);
            $table->string('automatic_day_night',20)->default(\App\Models\AppPreference::DAY);
            $table->string('distance_unit',20)->default(\App\Models\AppPreference::MILES);
            $table->string('show_traffic_map',20)->default(0);
            $table->string('show_speed_limit',20)->default(0);
            $table->string('save_parking_location',20)->default(0);

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
        Schema::dropIfExists('app_preferences');
    }
}
