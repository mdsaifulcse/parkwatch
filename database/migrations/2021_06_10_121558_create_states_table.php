<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('country_id')->nullable();
            $table->string('state_name');

            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');

            $table->string('status')->default(\App\Models\State::PUBLISHED);

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
        Schema::table('states',function (Blueprint $table){
            $table->dropForeign(['country_id']);
        });

        Schema::dropIfExists('states');
    }
}
