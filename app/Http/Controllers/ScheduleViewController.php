<?php

namespace App\Http\Controllers;
use DB;
use App\RoomsByDay;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;

class ScheduleViewController extends Controller
{
    //
    public function index()
    {
        //get this month
        $now = new DateTime(null, new DateTimeZone('America/Vancouver'));
        $calendar = DB::table('calendar_dates')
            ->where('cmonth', $now->format('n'))
            ->where('cyear', $now->format('Y'))
            ->where('isWeekday', '1')
            ->get();
        $sundays = DB::table('calendar_dates')
            ->select('cdayOfMonth')
            ->where('cmonth', $now->format('n'))
            ->where('cyear', $now->format('Y'))
            ->where('cdayOfWeek', 1)
            ->get();
        dd($sundays);
        return view('pages.studentschedule', compact('calendar', 'details', 'sundays'));
    }

}
