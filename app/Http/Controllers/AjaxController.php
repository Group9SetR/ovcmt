<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseInstructor;
use App\InstructAvail;
use App\Instructor;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Http\Request;
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
            $instructorsbycourse = DB::table('CourseInstructor AS ci')
                ->join('Instructors AS i', 'ci.instructor_id', '=', 'i.instructor_id')
                ->where('i.course_id', $req->course_id)
                ->where('ci.instructor_type', 1)
                ->select("i.instructor_id AS instructor_id",
                    "i.first_name AS first_name",
                    "i.email AS email",
                    "ci.course_id AS course_id",
                    "ci.intake_no AS intake_no")->get();
            $tasbycourse = DB::table('CourseInstructor AS ci')
                ->join('Instructors AS i', 'ci.instructor_id', '=', 'i.instructor_id')
                ->where('i.course_id', $req->course_id)
                ->where('ci.instructor_type', 0)
                ->select("i.instructor_id AS instructor_id",
                    "i.first_name AS first_name",
                    "i.email AS email",
                    "ci.course_id AS course_id",
                    "ci.intake_no AS intake_no")->get();
        }
        return response()->json(array("instructorsbycourse" => $instructorsbycourse, "tasbycourse" => $tasbycourse), 200);
    }

    public function searchInstructor(Request $req)
    {
        if ($req->ajax()) {
            $output = "";
            $instructor_type = "";
            $instructors = DB::table('instructors AS i')
                ->join('instruct_avails as ia', 'i.instructor_id', '=', 'ia.instructor_id')
                ->select('i.instructor_id', 'i.first_name', 'ia.*')
                ->where('first_name', 'LIKE', '%' . $req->search . '%')->get();



            if($instructors){
                foreach ($instructors as $key => $instructor){
                    $output .='<tr>'.
                        '<td class="course_instructor_id">'.$instructor->instructor_id.'</td>'.
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

                        '<td>'. '<button class="btn btn-primary open-EditInstructorDialog"

                                    data-toggle="modal"
                                    data-id="{{$instructor->instructor_id}}"
                                    data-name="{{$instructor->first_name}}"
                                    data-target="#editInstructorModal"

                                        >Edit</button>' .

                        '</td>'.
                        '<td>'. '<button class=" btn btn-success open-AssignCourseDialog"
                                        data-toggle="modal"
                                        data-id="{{$instructor->instructor_id}}"
                                        data-target="#assignInstructorModal"
                                            >Assign</button>'.
                        // TODO: delete button
                        '</td>'.
                        '<td>'. '<button class=" btn btn-danger "
                                            >Delete</button>'.
                        '</td>'.


                        '</tr>';
                }
                return Response($output);
            } else {
                return Response()->json(['no' => 'Not Found']);
            }
        }
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
            $roomsbyday = DB::table('rooms_by_days')
                ->whereBetween('cdate', array($weekstart->toDateString(), $weekend->toDateString()))
                ->orderBy('cdate','room_id')
                ->get();
            return response()->json(array("roomsbyday" => $roomsbyday), 200);
        }
    }

    public function getCourseOfferingsByTerm(Request $req)
    {
        if ($req->ajax() && isset($req->term_id)) {
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

    public function searchCourse(Request $req){
        if ($req -> ajax()){
            $output="";
            $courses = Course::where('course_Id', 'LIKE', '%'.$req->search.'%')->get();
            if($courses){
                foreach ($courses as $key => $course){
                    $output .=  '<tr>'.
                                '<td>'.$course->course_id.'</td>'.
                                '<td>'.$course->sessions_days.'</td>'.
                                '<td>'.$course->course_type.'</td>'.
                                '<td>'.$course->term_no.'</td>'.


                                '<td>'. '<button class="btn btn-primary open-EditCourseDialog"
                                            data-toggle="modal"
                                            data-courseid="{{$course->course_id}}"
                                            data-sessiondays="{{$course->sessions_days}}"
                                            data-coursetype="{{$course->course_type}}"
                                            data-termno="{{$course->term_no}}"
                                            data-target="#editCourseModal"
                                                 >Edit</button>'.
                                '</td>'.
                                '<td>'.
                            '<form action="manageCourseDelete" method = "POST" id ="deleteCOurseForm">'.
                            '<input type="hidden" name="course_id3" value="{{$course->course_id}}">'.
                            '<input type="hidden" name="sessions_days3" value="{{$course->sessions_days}}">'.
                            '<input type="hidden" name="course_type3" value="{{$course->course_type}}">'.
                            '<input type="hidden" name="term_no3" value="{{$course->term_no}}">'.
                            '<input class="btn btn-danger" type = "submit" id = "deleteCourseBtn" value="delete">'.
                            '</form>'.
                            '</td>'.
                            '</tr>';
                }
                return Response($output);
            }else{
                return Response()->json(["no"=>"Not Found"]);
            }
        }
    }

}