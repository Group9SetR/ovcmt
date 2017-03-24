<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseInstructor;
use App\InstructAvail;
use App\Instructor;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Http\Request;

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
    public function searchInstructor(Request $req){
        if ($req -> ajax()){
            $output="";
            $instructor_type = "";
            //$instructors = Instructor::where('first_name', 'LIKE', '%'.$req->search.'%')->get();
            $instructors = DB::table('instructors AS i')
                ->join('instruct_avails as ia', 'i.instructor_id', '=', 'ia.instructor_id')
                ->select('i.instructor_id', 'i.first_name', 'ia.*')
                ->where('first_name', 'LIKE', '%'.$req->search.'%')->get();

            if($instructors){
                foreach ($instructors as $key => $instructor){
                    /*
                    if($instructor ->instructor_type == 1 ){
                        $instructor_type = "instructor";
                    } else {
                        $instructor_type = "TA";
                    }
                    */
                    $output .='<tr>'.
                        '<td>'.$instructor->instructor_id.'</td>'.
                        '<td>'.$instructor->first_name.'</td>'.
                        '<td>'.$instructor->date_start.'</td>'.
                        '<td>'.$instructor->mon_am.'</td>'.
                        '<td>'.$instructor->tues_am.'</td>'.
                        '<td>'.$instructor->wed_am.'</td>'.
                        '<td>'.$instructor->thurs_am.'</td>'.
                        '<td>'.$instructor->fri_am.'</td>'.
                        '<td>'.$instructor->mon_pm.'</td>'.
                        '<td>'.$instructor->tues_pm.'</td>'.
                        '<td>'.$instructor->wed_pm.'</td>'.
                        '<td>'.$instructor->thurs_pm.'</td>'.
                        '<td>'.$instructor->fri_pm.'</td>'.

                        '<td>'. '<button class="btn btn-action open-EditInstructorDialog"
                                    data-toggle="modal"
                                    data-id="{{$instructor->instructor_id}}"
                                    data-name="{{$instructor->first_name}}"
                                    data-target="#editInstructorModal"
                                        >Edit</button>'.
                        '</td>'.
                        '</tr>';
                }
                return Response($output);
            }else{
                return Response()->json(['no'=>'Not Found']);
            }
        }

    }
}
