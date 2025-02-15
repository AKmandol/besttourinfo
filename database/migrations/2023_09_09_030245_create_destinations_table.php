<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDestinationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pick_up_location')->nullable();
            $table->string('drop_off_location')->nullable();
            $table->string('pick_up_date')->nullable();
            $table->string('drop_off_date')->nullable();
            $table->string('pick_up_time')->nullable();
            $table->string('drop_off_time')->nullable();
            $table->string('car_type')->nullable();
            $table->longText('between_location')->nullable();
            $table->string('cost')->nullable();
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
        Schema::dropIfExists('destinations');
    }
}
