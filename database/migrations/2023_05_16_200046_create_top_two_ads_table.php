<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopTwoAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('top_two_ads', function (Blueprint $table) {
            $table->id();
            $table->longText('ad_one')->nullable();
            $table->longText('ad_two')->nullable();
            $table->longText('ad_three')->nullable();
            $table->longText('ad_four')->nullable();
            $table->boolean('active')->default(1);
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
        Schema::dropIfExists('top_two_ads');
    }
}
