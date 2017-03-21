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
}
