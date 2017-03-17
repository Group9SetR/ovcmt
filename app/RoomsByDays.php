<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomsByDays extends Model
{
    public $timestamps = false;
    protected $fillable = ['room_id', 'cdate', 'am_crn', 'pm_crn'];
}
