<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTermTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terms', function (Blueprint $table) {
            $table->integer('term_id');
            $table->date('term_start_date');
            $table->integer('intake_id');
            $table->tinyInteger('term_no');
            $table->tinyInteger('duration_weeks');
            $table->tinyInteger('course_weeks');
            $table->tinyInteger('exam_weeks');
            $table->tinyInteger('holidays');
            $table->primary('term_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('terms');
    }
}
