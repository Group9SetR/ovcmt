<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDaySchedule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('day_schedule', function (Blueprint $table) {
            $table->string('day_schedule_id');
            $table->string('course_room_day_id');
            $table->date('date');
            $table->string('am_pm');
            $table->primary('day_schedule_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('day_schedule');
    }
}
