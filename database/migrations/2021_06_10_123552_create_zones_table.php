<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zones', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('city_id')->nullable();
            $table->string('zone_name');

            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');

            $table->string('status')->default(\App\Models\Zone::PUBLISHED);

            $table->softDeletes();
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
        Schema::table('zones',function (Blueprint $table){
            $table->dropForeign(['city_id']);
        });


        Schema::dropIfExists('zones');
    }
}
