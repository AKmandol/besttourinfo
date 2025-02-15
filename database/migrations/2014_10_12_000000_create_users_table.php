<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mobile')->nullable();
            $table->string('image')->nullable();
            $table->string('house_number')->nullable();
            $table->string('street_name')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('city')->nullable();
            $table->string('permanent_house_number')->nullable();
            $table->string('permanent_street_name')->nullable();
            $table->string('permanent_postal_code')->nullable();
            $table->string('permanent_city')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('passport_no')->nullable();
            $table->string('passport_expiry_date')->nullable();
            $table->string('nid')->nullable();
            $table->string('gender')->nullable();
            $table->string('religion')->nullable();
            $table->string('language')->nullable();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('userType')->default('user');
            $table->boolean('isActivated')->default(0);
            $table->string('passwordResetCode')->nullable();
            $table->string('activationCode')->nullable();
            $table->string('socialType')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
