<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMealItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meal_item', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('discount');

            $table->integer('meal_id')->unsigned();
            $table->foreign('meal_id')->references('id')->on('meals')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('item_id')->unsigned();
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('meal_item');
    }
}
