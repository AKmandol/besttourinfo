<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelRentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_rents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hotel_id')->unsigned();
            $table->string('hotel_name')->nullable();
            $table->string('hotel_address')->nullable();
            $table->string('hotel_phone')->nullable();
            $table->string('hotel_email')->nullable();
            $table->string('totalPerson')->nullable();
            $table->string('bed')->nullable();
            $table->string('size')->nullable();
            $table->string('offerTitle')->nullable();
            $table->integer('offerRegularPrice')->nullable();
            $table->integer('offerDiscpuntPrice')->nullable();
            $table->string('rdiscount')->nullable();
            $table->integer('WofferRegularPrice')->nullable();
            $table->integer('WofferDiscpuntPrice')->nullable();
            $table->string('wdiscount')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotel_rents');
    }
}
