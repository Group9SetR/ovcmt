<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstructorAvail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instr_avail', function (Blueprint $table) {
            $table->string('instructor_id');
            $table->boolean('mon_am');
            $table->boolean('mon_pm');

            $table->boolean('tue_am');
            $table->boolean('tue_pm');

            $table->boolean('wed_am');
            $table->boolean('wed_pm');

            $table->boolean('thu_am');
            $table->boolean('thu_pm');

            $table->boolean('fri_am');
            $table->boolean('fri_pm');

            $table->primary('instructor_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instr_avail');
    }
}
