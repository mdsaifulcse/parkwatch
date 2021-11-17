<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppPreference extends Model
{

    const Light='Light';
    const DARK='Dark';

    const DAY='Day';
    const NIGHT='Night';

    const MILES='Miles';

    public $timestamps = true;

    protected $table = "app_preferences";

    protected $fillable=['client_id','sound_voice','guidance_volume','avoid_highway','avoid_toll','avoid_ferrie','color_schema','automatic_day_night','distance_unit','show_traffic_map','show_speed_limit','save_parking_location'];
}
