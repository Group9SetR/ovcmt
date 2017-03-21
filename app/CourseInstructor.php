<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseInstructor extends Model
{
    public $timestamps = false;
    protected $fillable = ['first_name', 'course_id',  'intake_no', 'instructor_type'];
}
