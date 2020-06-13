<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelecastsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telecasts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('age_rating_id')->nullable()->unsigned();
            $table->integer('channel_id')->nullable()->unsigned();
            $table->integer('category_id')->nullable()->unsigned();

            $table->foreign('age_rating_id')->references('id')->on('age_rating');
            $table->foreign('channel_id')->references('id')->on('tv_channels');
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
        Schema::dropIfExists('telecast');
    }
}
