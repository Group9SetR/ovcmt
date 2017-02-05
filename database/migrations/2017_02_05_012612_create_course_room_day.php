<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseRoomDay extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_room_day', function (Blueprint $table) {
            $table->string('course_room_day_id');
            $table->string('room_id');
            $table->string('course_id');
            $table->string('intake_id');
            $table->date('date');
            $table->primary('course_room_day_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_room_day');
    }
}
