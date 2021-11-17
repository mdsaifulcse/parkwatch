<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_vehicle', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id', false,10);
            $table->integer('vehicle_type_id', false,10)->nullable()->comment('Vehicle Size');
            $table->string('vehicle_type',100)->nullable();
            $table->string('vehicle_photo',100)->nullable();
            $table->string('make',150)->nullable();
            $table->string('model',150)->nullable();
            $table->string('color',150)->nullable();
            $table->string('licence',150)->nullable();
            $table->string('is_primary',150)->default(\App\Models\ClientVehicle::NO);
            $table->string('status',20)->default(\App\Models\ClientVehicle::PUBLISHED);
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
        Schema::dropIfExists('vehicles');
    }
}
