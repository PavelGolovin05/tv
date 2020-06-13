<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelecastShowTable extends Migration
{
    public function up()
    {
        Schema::create('telecast_show', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('show_start');
            $table->dateTime('show_end');
            $table->integer('telecast_id')->unsigned()->nullable();

            $table->foreign('telecast_id')->references('id')->on('telecasts');
        });
    }

    public function down()
    {
        Schema::dropIfExists('telecast_show');
    }
}
