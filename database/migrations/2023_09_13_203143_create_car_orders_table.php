<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('car_driver_id')->nullable();
            $table->string('user_name')->nullable();
            $table->string('user_phone')->nullable();
            $table->string('user_email')->nullable();
            $table->string('packeage_name')->nullable();
            $table->string('cost')->nullable();
            $table->string('car_type')->nullable();
            $table->string('pick_up_location')->nullable();
            $table->string('drop_off_location')->nullable();
            $table->string('pick_up_date')->nullable();
            $table->string('drop_off_date')->nullable();
            $table->string('location_between')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('extra_one')->nullable();
            $table->string('extra_two')->nullable();
            $table->string('extra_three')->nullable();
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
        Schema::dropIfExists('car_orders');
    }
}
