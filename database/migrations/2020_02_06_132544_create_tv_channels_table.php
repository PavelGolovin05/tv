<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTvChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tv_channels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('country_id')->nullable()->unsigned();
            $table->integer('category_id')->nullable()->unsigned();
            $table->text('photo_link');
            $table->text('description');

            $table->foreign('country_id')->references('id')->on('countries');
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
        Schema::dropIfExists('tv_channels');
    }
}
