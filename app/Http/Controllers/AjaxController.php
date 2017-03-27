<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseInstructor;
use App\InstructAvail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AjaxController extends Controller
{
    public function instructorDetails(Request $req) {
        if ($req->ajax() && isset($req->instructor_id)) {
            $courses = CourseInstructor::where('instructor_id', $req->instructor_id)->get();
            $avail = InstructAvail::where('instructor_id', $req->instructor_id)->get();
        }
        return response()->json(array("courses" => $courses, "avail" => $avail), 200);
    }

    public function getInstructorsForACourse(Request $req) {
        if($req->ajax() && isset($req->course_id)) {
            $instructorsbycourse = CourseInstructor::where('course_id', $req->course_id)->get();
        }
        return response()->json(array("coursesbyinstructor" => $instructorsbycourse), 200);
    }

    public function getWeeklySchedule(Request $req) {
        if($req->ajax() && isset($req->selected_date)) {
            $monday = DB::table('calendar_dates')
                ->where('cdate','<=',$req->selected_date)
                ->where('cdayOfWeek', '2')
                ->select('cdate')
                ->orderBy('cdate', 'desc')
                ->first();
            $weekstart = Carbon::createFromFormat('Y-m-d', $monday->cdate);
            $weekend = Carbon::createFromFormat('Y-m-d', $monday->cdate);
            $weekend->addDays(4);
            $monday = $weekstart->toDateString();
            $friday = $weekend->toDateString();
            $roomsbyday = DB::table('rooms_by_days')
                ->whereBetween('cdate', array($weekstart->toDateString(), $weekend->toDateString()))
                ->orderBy('cdate','room_id')
                ->get();
            return response()->json(array("roomsbyday" => $roomsbyday), 200);
        }
    }

    public function getCourseOfferingsByTerm(Request $req) {
        if($req->ajax() && isset($req->term_id)) {
            $assignedcourses = DB::table('courses AS c')
                ->join('course_offerings AS co', 'c.course_id', '=', 'co.course_id')
                ->join('instructors AS i', 'co.instructor_id', '=', 'i.instructor_id')
                ->where("co.term_id", $req->term_id)
                ->select('c.course_id AS course_id', 'co.instructor_id as instructor_id', 'i.first_name as first_name',
                'i.email as email')
                ->get();
            $query = DB::table('course_offerings')
                ->where('term_id', $req->term_id)
                ->select("course_id");
            $unassignedcourses = Course::whereNotIn("course_id", $query)->get();
            return response()->json(array("assignedcourses" => $assignedcourses, "unassignedcourses" => $unassignedcourses), 200);
        } else {
            return response()->json(array("error" => "an error has occurred"));
        }
    }
}
