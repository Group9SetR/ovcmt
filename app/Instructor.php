<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    protected $timestamps = false;
    protected $fillable = ['first_name', 'last_name', 'email'];
}
