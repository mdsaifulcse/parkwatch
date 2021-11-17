<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('state_id')->nullable();
            $table->string('city_name');

            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');

            $table->string('status')->default(\App\Models\City::PUBLISHED);

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
        Schema::table('cities',function (Blueprint $table){
            $table->dropForeign(['state_id']);
        });

        Schema::dropIfExists('cities');
    }
}
