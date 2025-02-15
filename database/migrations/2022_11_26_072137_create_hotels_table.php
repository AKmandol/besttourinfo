<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('address');
            $table->string('tourPointAddress')->nullable();;
            $table->string('tourPointAddress2')->nullable();;
            $table->string('tourPointAddress3')->nullable();;
            $table->string('tourPointAddress4')->nullable();;
            $table->string('phone');
            $table->string('email')->nullable();
            $table->longText('description');
            $table->string('city');
            $table->string('country');
            $table->string('zip');
            $table->longText('houseRules')->nullable();
            $table->string('checkIn')->nullable();
            $table->string('checkOut')->nullable();
            $table->longText('kidsPolicy')->nullable();
            $table->longText('petPolicy')->nullable();
            $table->longText('titleImage')->nullable();
            $table->string('stars')->nullable();
            $table->string('activeStatus')->nullable();
            $table->integer('discount')->nullable();
            $table->string('constraction_year')->nullable();
            $table->string('floor_no')->nullable();
            $table->string('total_room')->nullable();
            $table->string('right_top')->nullable();
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
        Schema::dropIfExists('hotels');
    }
}
