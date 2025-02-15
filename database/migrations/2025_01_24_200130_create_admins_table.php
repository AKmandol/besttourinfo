<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mobile')->nullable();
            $table->string('image')->nullable();
            $table->string('password');
            $table->timestamp('verified_at')->nullable();
            $table->string('userType')->default('admin');
            $table->boolean('isActivated')->default(0);
            $table->string('role')->nullable();
            $table->integer('nt_hotel_order')->default(0);
            $table->string('nt_hotel_order_date')->nullable();
            $table->integer('nt_car_order')->default(0);
            $table->string('nt_car_order_date')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('admins');
    }
};
