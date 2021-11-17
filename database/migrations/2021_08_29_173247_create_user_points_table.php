<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_point_notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id', false,10);
            $table->integer('point', false,10)->default(0);
            $table->string('action_name',100);
            $table->timestamp('action_date')->default(\Carbon\Carbon::now());
            $table->string('status',100)->default(\App\Models\UserPointNotification::UNREAD);
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
        Schema::dropIfExists('user_points');
    }
}
