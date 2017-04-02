@extends('layouts.app')
@section('content')
    @if((session('error')))
        <script>alert("Course not assigned, please specify at least one of Instructor or TA for {{session('error')}}")</script>
    @endif
    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-2 sidenav">
                @include('includes.sidebar')
            </div>

            <div class="col-sm-10">
                <h4><small>Select a Term</small></h4>
                <hr>
                {!! Form::open(['url' => '', 'class' => 'form-inline', 'id' => 'select_term']) !!}
                <div class="form-inline">
                    <select name="selected_term_id" id="selected_term_id" class="form-control">
                        @foreach ($terms as $term)
                            <option value={{$term->term_id}}>Term Id: {{$term->term_id}}, Term Number:{{$term->term_no}},
                                Intake Number:{{$term->intake_id}}, Start Date:{{$term->term_start_date}} </option>
                        @endforeach
                    </select>
                    {!! Form::submit('Choose Term',['class'=> 'btn btn-primary form-inline']) !!}
                </div>
                {!! Form::close() !!}

                <div class="modal fade" id="assignCoursesToInstructor" tabindex="-1" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 id="modalCourseNameUnassigned" class="modal-title"></h4>
                            </div>
                            <div class="modal-body">
                                <!-- made dropdown instead of another modal -->
                                {!! Form::open(['url' => 'assignCourse', 'class' => 'form-inline', 'id' => 'select_instructor']) !!}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div id="availableInstructors">
                                            <h3>Instructor</h3>
                                                <p id="noInstructorsMsg"></p>
                                                <select class="form-control" name='instructor_id' id='selected_instructor_id'>
                                                    <!-- inserting options here through ajax request -->
                                                </select>
                                                <br><br>
                                                {{Form::hidden('term_id', '', array('id'=>'term_id_instructor'))}}
                                                {{Form::hidden('course_id', '', array('id'=>'course_id_instructor'))}}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="availableTAs">
                                            <h3>TA</h3>
                                                <p id="noTasMsg"></p>
                                                <select class="form-control" name='ta_id' id='selected_ta_id'>
                                                    <!-- inserting options here through ajax request -->
                                                </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div id="assignTaBtn">
                                    {!! Form::submit('Assign Instructor/TA',['class'=> 'btn btn-primary form-inline']) !!}
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            {!! Form::close() !!}
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
                                    console.log(data['assignedcourses']);
                                    $('#assigned').empty();
                                    for (let i = 0; i < data['assignedcourses'].length; i++) {
                                        var term = $('#selected_term_id').val();
                                        var panel = "<div class='panel panel-default' id='" + data['assignedcourses'][i]['course_id'] + "-assigned'>" +
                                            "<div class='panel-heading color-panel' style='background-color:"+ data['assignedcourses'][i]['color'] + ";'>"
                                            + data['assignedcourses'][i]['course_id']
                                            + " - <span id='heading" + i + "i'></span>"
                                            + "<span id='heading" + i + "t'></span>"
                                            + "<span class='pull-right'>"
                                            + "<form action='unassignCourse'>"
                                            + "<input type='hidden' name='course_id' value='" + data['assignedcourses'][i]['course_id'] + "'>"
                                            + "<input type='hidden' name='instructor_id' value='" + data['assignedcourses'][i]['instructor_id'] + "'>"
                                            + "<input type='hidden' name='term_id' value='" + term + "'>"
                                            + "<input type='hidden' name='intake_no' value='" + data['assignedcourses'][i]['intake_no'] + "'>"
                                            + "<input type='submit' class='btn-danger' value='Unassign'>"
                                            + "</form>"
                                            + "</span></div>"
                                            + "<div class='panel-body' id='panel" + i + "'>"
                                            + "</div></div>";
                                        $('#assigned').append(panel);
                                        if (data['assignedcourses'][i]['instructor_id'] != null && data['assignedcourses'][i]['instructor_id'] != 0) {
                                            console.log(data['assignedcourses'][i]['instructor_id']);
                                            $('#heading' + i + "i").css('color', 'white');
                                            $('#heading' + i + "i").append(document.createTextNode("[Instructor] "));
                                            $('#panel' + i).append(document.createTextNode("Instructor: " + data['assignedcourses'][i]['first_name']));
                                            $('#panel' + i).append(document.createElement('br'));
                                        }
                                        if(data['assignedcourses'][i]['ta_id'] != null && data['assignedcourses'][i]['ta_id'] != 0) {
                                            $('#heading' + i + "t").css('color', 'white');
                                            $('#heading' + i + "t").append(document.createTextNode("[TA]"));
                                            $('#panel' + i).append(document.createTextNode("TA: " + data['assignedcourses'][i]['ta_first_name']));
                                        }
                                    }

                                    $('#unassigned').empty();
                                    for (let i = 0; i < data['unassignedcourses'].length; i++) {
                                        var panel = "<div class='panel panel-default' id='" + data['unassignedcourses'][i]['course_id']
                                            + "'>"
                                            + "<div class='panel-heading color-panel' style='background-color:"+ data['unassignedcourses'][i]['color'] + ";'>"
                                            + data['unassignedcourses'][i]['course_id']
                                            + "</div><div class='panel-body'>Session Days: " + + data['unassignedcourses'][i]['sessions_days']
                                            + " Type: " + data['unassignedcourses'][i]['course_type']
                                            + " Term No: " + data['unassignedcourses'][i]['term_no']
                                            + "</div>";
                                        $('#unassigned').append(panel);
                                    }
                                    // show modal for unassigned courses
                                    for (let i = 0; i < data['unassignedcourses'].length; i++) {
                                        var course = data['unassignedcourses'][i]['course_id'];
                                        var courseStr = course.toString();
                                        var courseid = document.getElementById(courseStr);
                                        courseid.onclick=function() {
                                            var courseToPass = $(this).attr('id');
                                            var term = $('#selected_term_id').val();
                                            $('#course_id_instructor').val(courseToPass);
                                            $('#course_id_ta').val(courseToPass);
                                            $('#term_id_instructor').val(term);
                                            $('#term_id_ta').val(term);
                                            $('#assignCoursesToInstructor').modal('show');
                                            $('#modalCourseNameUnassigned').html('Available Instructors and TAs for ' + courseToPass);
                                            $.ajaxSetup({
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                }
                                            });
                                            $.ajax({
                                                type: 'POST',
                                                url: '/getInstructorsForACourse',
                                                data: {"course_id": courseToPass},
                                                dataType: 'json',
                                                success: function (data) {
                                                    $('#selected_instructor_id').empty();
                                                    $('#selected_ta_id').empty();
                                                    $('#noInstructorsMsg').empty();
                                                    $('#noTasMsg').empty();

                                                    var emptyOption = "<option value='none'>None</option>";
                                                    $('#selected_instructor_id').append(emptyOption);
                                                    $('#selected_ta_id').append(emptyOption);


                                                    for (let i = 0; i < data['instructorsbycourse'].length; i++) {
                                                        var instructorDropdown = "<option value='" + data['instructorsbycourse'][i]['instructor_id'] + "'>" + data['instructorsbycourse'][i]['first_name'] + "</option>";
                                                        $('#selected_instructor_id').append(instructorDropdown);
                                                    }
                                                    for (let i = 0; i < data['tasbycourse'].length; i++) {
                                                        var taDropdown = "<option value='" + data['tasbycourse'][i]['instructor_id'] + "'>" + data['tasbycourse'][i]['first_name'] + "</option>";
                                                        $('#selected_ta_id').append(taDropdown);
                                                    }
                                                }
                                            });
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