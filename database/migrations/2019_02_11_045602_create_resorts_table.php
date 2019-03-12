<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resorts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->longText('description');
            $table->string('address');
            $table->string('is_approve')->nullable();
            $table->unsignedInteger('approve_by')->nullable();
            $table->date('approve_at')->nullable();
            $table->timestamps();
            $table->unsignedInteger('deleted_by')->nullable();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('deleted_by')->references('id')->on('users');
            $table->foreign('approve_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resorts');
    }
}
