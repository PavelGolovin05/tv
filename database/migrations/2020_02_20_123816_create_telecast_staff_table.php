<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelecastStaffTable extends Migration
{

    public function up()
    {
        Schema::create('telecast_staff', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('telecast_id')->unsigned()->nullable();
            $table->integer('staff_id')->nullable()->unsigned();

            $table->foreign('telecast_id')->references('id')->on('telecasts');
            $table->foreign('staff_id')->references('id')->on('staff');
        });
    }

    public function down()
    {
        Schema::dropIfExists('channel_staff');
    }
}
