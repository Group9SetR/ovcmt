<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public $timestamps = false;

    protected $fillable = ['course_id', 'course_name', 'course_amen_req'];
}
