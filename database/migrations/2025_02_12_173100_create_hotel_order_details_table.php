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
        Schema::create('hotel_order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->string('hotel_id')->nullable();
            $table->string('hotel_name')->nullable();
            $table->string('hotel_address')->nullable();
            $table->string('hotel_phone')->nullable();
            $table->string('hotel_email')->nullable();
            $table->string('room_type')->nullable();
            $table->string('room_type_price')->nullable();
            $table->integer('room_no')->nullable();
            $table->string('trasnstion_id')->nullable();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
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
        Schema::dropIfExists('hotel_order_details');
    }
};
