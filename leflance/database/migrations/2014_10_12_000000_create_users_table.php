<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('login')->nullable();
            $table->string('email')->nullable();
            $table->string('full_name')->nullable();
            $table->string('about_yourself')->nullable();
            $table->boolean('is_banned')->default(0);
            $table->integer('avatar_id')->nullable();
            $table->integer('country_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('faculty_id')->nullable();
            $table->integer('specialty_id')->nullable();
            $table->integer('course')->nullable();
            $table->string('skype')->nullable();
            $table->string('soc_service_vk')->nullable();
            $table->string('soc_service_fb')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('password');
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
        Schema::drop('users');
    }
}
