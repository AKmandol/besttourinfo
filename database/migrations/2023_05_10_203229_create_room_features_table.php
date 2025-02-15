<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_features', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rent_id')->unsigned();
            $table->integer('hotel_id')->nullable();
            $table->string('room_type')->nullable();
            $table->string('room_feature')->nullable();
            $table->timestamps();
            $table->foreign('rent_id')->references('id')->on('hotel_rents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room_features');
    }
}
