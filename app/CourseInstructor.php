<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseInstructor extends Model
{
    public $timestamps = false;
    protected $fillable = ['course_id', 'instructor_id', 'intake_no', 'instructor_type'];
}
