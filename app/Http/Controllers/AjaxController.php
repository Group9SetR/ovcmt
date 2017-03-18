<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseInstructor;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    public function instructorDetails() {
        if (isset($_POST['instructor_id'])) {
            $courses = CourseInstructor::all();
        }
        return response()->json(array($courses), 200);
    }
}
