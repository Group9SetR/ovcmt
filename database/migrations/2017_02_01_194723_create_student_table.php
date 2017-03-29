<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TODO Do we even need this table?
        Schema::create('students', function (Blueprint $table) {
            $table->string('email');
            $table->string('student_no')->index();
            $table->integer('intake_id')->index();
            $table->string('first_name')->index();
            $table->string('last_name')->index();
            $table->primary('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
