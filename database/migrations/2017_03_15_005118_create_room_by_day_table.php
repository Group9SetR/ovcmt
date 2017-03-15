<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomByDayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms_by_days', function (Blueprint $table) {
            $table->string('room_id');
            $table->date('cdate');
            $table->integer('am_crn');
            $table->integer('pm_crn');
            $table->primary(['room_id','cdate']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms_by_days');
    }
}