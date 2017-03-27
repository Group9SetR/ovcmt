@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-2 sidenav">
                @include('includes.sidebar')
            </div>

            <div class="col-sm-10">
                <div class="row" id="term_selector">
                    <p>Select a Term</p>
                    <div class="form-inline">
                        {!! Form::open(['url' => '', 'class' => 'form-inline', 'id' => 'select_term']) !!}
                        <select name="selected_term_id" id="selected_term_id">
                            @foreach ($terms as $term)
                                <option value={{$term->term_id}}>Term Number:{{$term->term_no}},
                                    Intake Number:{{$term->intake_id}} Start Date:{{$term->term_start_date}} </option>
                            @endforeach
                        </select>
                        {!! Form::submit('Choose Term',['class'=> 'btn btn-primary form-inline']) !!}
                    </div>
                </div>

                <div class="modal fade" id="assignCoursesToInstructor" tabindex="-1" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <!-- TODO retrieve course name -->
                                <h4 class="modal-title">Available Instructors for <b><div id="modalCourseNameUnassigned"></div></b></h4>
                            </div>
                            <div class="modal-body">
                                <!-- TODO need to pull instructors correctly -->
                                @foreach ($instructors as $instructor)
                                    <div class='panel panel-default'>
                                        <div class='panel-body'>
                                            {!! Form::open(['url' => '', 'class' => 'form-inline', 'id' => $instructor]) !!}
                                            Instructor Id: {{$instructor->instructor_id}} <br>
                                            First Name: {{$instructor->first_name}} <br>
                                            Email: {{$instructor->email}} <br>
                                            {!! Form::submit('Assign',['class'=> 'btn btn-primary form-inline']) !!}
                                        </div>
                                    </div>
                                @endforeach
                                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="editInstructors" tabindex="-1" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <!-- TODO retrieve course name -->
                                <h4 class="modal-title">Assigned Instructors for <b><div id="modalCourseNameAssigned"></div></b></h4>
                            </div>
                            <div class="modal-body">
                                <!-- TODO need to pull instructors correctly -->
                                @foreach ($instructors as $instructor)
                                    <div class='panel panel-default'>
                                        <div class='panel-body'>
                                            {!! Form::open(['url' => '', 'class' => 'form-inline', 'id' => $instructor]) !!}
                                            Instructor Id: {{$instructor->instructor_id}} <br>
                                            First Name: {{$instructor->first_name}} <br>
                                            Email: {{$instructor->email}} <br>
                                            {!! Form::submit('Assign',['class'=> 'btn btn-primary form-inline']) !!}
                                            <button class="btn btn-warning">Unassign</button>
                                        </div>
                                    </div>
                                @endforeach
                                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    $(document).ready(function() {
                        $(document).on('submit', '#select_term', function (e) {
                            e.preventDefault();
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            var term_id = $('#selected_term_id').val();
                            $.ajax({
                                type: 'POST',
                                url: '/getCourseOfferingsByTerm',
                                data: {"term_id": term_id},
                                dataType: 'json',
                                success: function (data) {
                                    console.log(data)
                                    //TODO: make this pretty
                                    $('#assigned').empty();
                                    for (let i = 0; i < data['assignedcourses'].length; i++) {
                                        var panel = "<div class='panel panel-default' id='" + data['unassignedcourses'][i]['course_id'] + "-assigned'><div class='panel-heading'>" + data['assignedcourses'][i]['course_id']
                                            + "</div> <div class='panel-body'>" + "Instructor ID: " + data['assignedcourses'][i]['instructor_id']
                                            + " Instructor Name: " + data['assignedcourses'][i]['first_name'] + "</div></div>";
                                        $('#assigned').append(panel);
                                    }
                                    $('#unassigned').empty();
                                    for (let i = 0; i < data['unassignedcourses'].length; i++) {
                                        var panel = "<div class='panel panel-default' id='" + data['unassignedcourses'][i]['course_id'] + "-unassigned'><div class='panel-heading'>" + data['unassignedcourses'][i]['course_id']
                                            + "</div> <div class='panel-body'>" + "</div></div>";
                                        $('#unassigned').append(panel);
                                    }
                                    // show modal for unassigned courses
                                    for (let i = 0; i < data['unassignedcourses'].length; i++) {
                                        var course = data['unassignedcourses'][i]['course_id'];
                                        var courseStr = course.toString();
                                        var courseid = document.getElementById(courseStr + '-unassigned');
                                        courseid.onclick=function() {
                                            $('#assignCoursesToInstructor').modal('show');
                                        };
                                    }
                                    // show modal for assigned courses
                                    for (let i = 0; i < data['unassignedcourses'].length; i++) {
                                        var course = data['unassignedcourses'][i]['course_id'];
                                        var courseStr = course.toString();
                                        var courseid = document.getElementById(courseStr + '-assigned');
                                        courseid.onclick=function() {
                                            $('#editInstructors').modal('show');
                                        };
                                    }
                                }
                            });
                        });
                    });
                </script>
                <div class="row">
                    <div class="col-sm-6">
                        <h4><small>Assign Courses to Instructors for the Term</small></h4>
                        <hr>
                        <div id="unassigned"></div>
                    </div>
                    <div class="col-sm-6">
                        <h4><small>Edit Assigned Instructors by Course</small></h4>
                        <hr>
                        <div id="assigned"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection