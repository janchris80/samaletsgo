<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTouristTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_tourist', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tourist_id');
            $table->unsignedInteger('category_id');
            $table->timestamps();

            $table->foreign('tourist_id')->references('id')->on('tourists');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_tourist');
    }
}
