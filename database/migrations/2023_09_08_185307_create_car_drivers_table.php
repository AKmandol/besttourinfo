<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_drivers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('driver_name')->nullable();
            $table->string('driver_phone')->nullable();
            $table->string('driver_email')->nullable();
            $table->string('driver_address')->nullable();
            $table->string('driver_age')->nullable();
            $table->string('driver_car_type')->nullable();
            $table->string('driver_nid_no')->nullable();
            $table->string('driver_img')->nullable();
            $table->string('driver_license')->nullable();
            $table->string('driver_license_img')->nullable();
            $table->string('extra_one')->nullable();
            $table->string('extra_two')->nullable();
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
        Schema::dropIfExists('car_drivers');
    }
}
