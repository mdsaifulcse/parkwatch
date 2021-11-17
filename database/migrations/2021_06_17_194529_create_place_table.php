<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('place', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->default(\App\Models\Place::PARKINGOWNER)->commen('Parking Owner from user table and Client as Parking Owner from Client table');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('client_id')->nullable();
            $table->unsignedInteger('zone_id')->nullable();
            $table->unsignedInteger('parking_rule_id')->nullable();

            $table->string('name');
            $table->longText('note')->nullable(); 
            $table->string('address')->nullable(); 
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('limit')->nullable();
            $table->longText('space')->nullable();
            $table->tinyInteger('status')->default('1');
            $table->timestamp('available_from')->nullable();
            $table->timestamp('available_to')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('zone_id')->references('id')->on('zones')->onDelete('cascade');
            $table->foreign('parking_rule_id')->references('id')->on('parking_rules')->onDelete('cascade');

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
        Schema::table('place',function (Blueprint $table){
            $table->dropForeign(['user_id','zone_id','parking_rule_id']);
        });


        Schema::dropIfExists('place');
    }
}
