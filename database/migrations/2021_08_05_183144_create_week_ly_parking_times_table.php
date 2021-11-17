<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeekLyParkingTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weekly_parking_times', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id', false,10);
            $table->tinyInteger('find_parking_by_work_address')->default(0);
            $table->tinyInteger('leave_parking_after_work')->default(0);
            $table->tinyInteger('arrived_home_find_parking')->default(0);
            $table->tinyInteger('home_parking_leaving_time')->default(0);
            $table->string('day_time',150);

            $table->string('mon_day');
            $table->string('tue_day');
            $table->string('wed_day');
            $table->string('thu_day');
            $table->string('fri_day');
            $table->string('sat_day');
            $table->string('sun_day');
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
        Schema::dropIfExists('week_ly_parking_times');
    }
}
