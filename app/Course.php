<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public $timestamps = false;

    protected $fillable = ['course_id', 'sessions_days', 'course_type', 'term_no'];
}
