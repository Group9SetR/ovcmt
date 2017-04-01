<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRoomsByDaysFK extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        //cannot cascade delete because it'll delete the entire record?
        Schema::table('rooms_by_days', function (Blueprint $table) {
            $table->foreign('am_crn')->references('crn')
                ->on('course_offerings');
        });
        Schema::table('rooms_by_days', function (Blueprint $table) {
            $table->foreign('pm_crn')->references('crn')
                ->on('course_offerings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('rooms_by_days', function (Blueprint $table) {
            $table->dropForeign(['am_crn']);
        });
        Schema::table('rooms_by_days', function (Blueprint $table) {
            $table->dropForeign(['pm_crn']);
        });
    }
}
