<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_systems', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('min_point',false,10)->default(0);
            $table->integer('max_point',false,10)->default(0);
            $table->string('badge_name',100)->nullable();
            $table->string('badge_icon',255)->nullable();
            $table->string('status',100)->default(\App\Models\PointSystem::ACTIVE);
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
        Schema::dropIfExists('point_systems');
    }
}
