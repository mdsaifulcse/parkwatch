<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->default(\App\Models\Price::PARKINGOWNER)->comment('Parking Owner from user table and Client as Parking Owner from Client table');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('client_id')->nullable();
            $table->integer('place_id');
            $table->float('time', 8, 2);
            $table->string('unit', 20);
            $table->float('minutes', 8, 2);
            $table->float('price', 8, 2);
            $table->tinyInteger('price_status')->default('1');
            $table->text('note')->nullable();
            $table->tinyInteger('status')->default('1');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('price',function (Blueprint $table){
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('price');
    }
}
