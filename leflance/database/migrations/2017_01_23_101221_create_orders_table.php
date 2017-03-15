<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->integer('user_id');
            $table->integer('order_type_id');
            $table->integer('status_id');
            $table->integer('educational_institution_id')->nullable();
            $table->integer('faculty_id')->nullable();
            $table->string('specialty')->nullable();
            $table->text('description')->nullable();
            $table->integer('pages_from')->nullable();
            $table->integer('pages_to')->nullable();
            $table->date('deadline')->nullable();

            $table->boolean('is_confirmed')->default(false);
            $table->boolean('is_banned')->default(false);

            $table->softDeletes();
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
        Schema::drop('orders');
    }
}
