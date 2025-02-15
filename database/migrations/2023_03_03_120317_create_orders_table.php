<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            //$table->foreignId('hotel_id')->nullable()->constrained();
            $table->string('user_name')->nullable();
            $table->string('user_phone')->nullable();
            $table->string('user_email')->nullable();
            $table->string('hotel_id')->nullable();
            $table->string('hotel_name')->nullable();
            $table->string('hotel_address')->nullable();
            $table->string('hotel_phone')->nullable();
            $table->string('hotel_email')->nullable();
            $table->string('room_type')->nullable();
            $table->string('room_type_price')->nullable();
            $table->integer('room_no')->nullable();
            $table->string('total_price')->nullable();
            $table->integer('no_of_adult')->nullable();
            $table->integer('no_of_child')->nullable();
            $table->string('booking_date')->nullable();
            $table->string('check_in')->nullable();
            $table->string('check_out')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('trasnstion_id')->nullable();
            $table->string('backup')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
