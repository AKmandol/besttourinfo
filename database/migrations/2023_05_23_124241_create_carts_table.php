<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('room_id')->nullable();
            $table->string('room_type')->nullable();
            $table->string('room_no')->nullable();
            $table->string('hotel_id')->nullable();
            $table->string('hotel_address')->nullable();
            $table->string('hotel_phone')->nullable();
            $table->string('hotel_email')->nullable();
            $table->string('hotel_name')->nullable();
            $table->string('price')->nullable();
            $table->string('price_original')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
