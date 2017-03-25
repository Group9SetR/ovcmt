<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseInstructor;
use App\InstructAvail;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    public function instructorDetails() {
        if (isset($_POST['instructor_id'])) {
            $courses = CourseInstructor::where('instructor_id', $_POST['instructor_id'])->get();
            $avail = InstructAvail::where('instructor_id', $_POST['instructor_id'])->get();
        }
        return response()->json(array("courses" => $courses, "avail" => $avail), 200);
    }

    public function getInstructorsForACourse() {
        if(isset($_POST['course_id'])) {
            $instructorsbycourse = CourseInstructor::where('course_id', $_POST['course_id'])->get();
        }
        return response()->json(array("coursesbyinstructor" => $instructorsbycourse), 200);
    }

    public function getWeeklySchedule() {
        if(isset($_POST['week_monday'])) {
            $weekstart = date_create($_POST['week_monday']);
            $weekend = date_add($weekstart, date_interval_create_from_date_string('5 days'));
            $roomsbyday = DB::table('rooms_by_day')
                ->where('cdate', '>=' , $weekstart)
                ->where('cdate', '<=' , $weekend)->get();
            return response()->json(array("roomsbyday" => $roomsbyday), 200);
        }
    }
}
