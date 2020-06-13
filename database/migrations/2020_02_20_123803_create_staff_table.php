<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->increments('id');
            $table->string('FIO');
            $table->integer('position_id')->nullable()->unsigned();
            $table->integer('channel_id')->unsigned()->unsigned();

            $table->foreign('channel_id')->references('id')->on('tv_channels');
            $table->foreign('position_id')->references('id')->on('positions');
        });
    }

    public function down()
    {
        Schema::dropIfExists('staff');
    }
}
