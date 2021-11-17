<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_no', 20)->nullable();
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('username', 100);
            $table->string('username', 100)->nullable();
            $table->string('mobile', 20)->nullable();
            $table->string('password');
            $table->string('working_address',255)->nullable();
            $table->string('home_address',255)->nullable();
            $table->timestamp('parking_start_date')->nullable();
            $table->timestamp('parking_end_date')->nullable();
            $table->string('single_parking_id',100)->nullable();
            $table->integer('parking_buddy_radius')->default(0)->comment('Mile');
            $table->text('note')->nullable();

            $table->tinyInteger('rent_out_from_other')->default(0)->comment('1=Agree to Rent out from other user, 0= Not Agree to Rent out from other user');
            $table->tinyInteger('swap_parking_spot')->default(0)->comment('1=Agree to Swap Parking Spot, 0= Not Agree to Swap Parking Spot');
            $table->tinyInteger('rent_out_my_space')->default(0)->comment('1=Agree to Rent out my space, 0= Not Agree to Rent out my space');

            $table->string('profile_photo')->nullable();
            $table->tinyInteger('status')->default('1');

            $table->string('password_reset_otp',20)->nullable();
            $table->timestamp('otp_validity')->nullable();
            $table->string('otp_status')->default(\App\Models\Client::OTP_NOT_VERIFIED);
            $table->integer('my_point',false,10)->default(0);

            $table->tinyInteger('terms_condition',false,1)->default(1);
            $table->tinyInteger('privacy_policy',false,1)->default(1);
            $table->tinyInteger('parking_buddy_laws',false,1)->default(1);
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
        Schema::dropIfExists('client');
    }
}
