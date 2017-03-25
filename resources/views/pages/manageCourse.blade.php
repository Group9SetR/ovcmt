@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-2 sidenav" >
                @include('includes.sidebar')
            </div>

        <div class="col-sm-8">
            <h4><small>Manage Course </small></h4>
            <hr>
            <button href="#addNewCourse" class="btn btn-default" data-toggle="collapse">Add Course</button>
            <div class="collapse" id="addNewCourse">
                <h2>Add a New Course</h2>

                {!! Form::open(['url' => 'manageCourseStore', 'id' => 'addCourseForm']) !!}
                <div class="form-group">
                    {!! Form::label('course_id2', 'Course Id:') !!}
                    {!! Form::text('course_id2', null, ['class' => 'form-control',
                                                        'required'=> 'true']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('sessions_days2', 'Session Days:') !!}
                    {!! Form::number('sessions_days2', '', array('id'=>'modal_sessionDays_name',
                                                                    'class'=>'form-control',
                                                                    'min'=>1,
                                                                    'max'=>99,
                                                                    'required'=>'true'))!!}
                </div>

                <div class="form-group">
                    {!! Form::label('course_type2', 'Course Type:') !!}
                    {{ Form::select('course_type2', ['Academic'=>'Academic', 'Practical'=>'Practical'], null, array('id'=>'modal_courseType_name',
                                                                                                                     'class'=>'form-control',
                                                                                                                     'required'=>'true')) }}
                </div>

                <div class="form-group">
                    {!! Form::label('term_no2', 'Term No:') !!}&nbsp;&nbsp;&nbsp;&nbsp;
                    {{ Form::radio('term_no2', 1, false, array('id'=>'modal_termNo_name1', 'required'=>'true')) }}&nbsp 1&nbsp;&nbsp;
                    {{ Form::radio('term_no2', 2, false, array('id'=>'modal_termNo_name2', 'required'=>'true')) }}&nbsp 2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    {{ Form::radio('term_no2', 3, false, array('id'=>'modal_termNo_name3', 'required'=>'true')) }}&nbsp 3&nbsp;&nbsp;&nbsp;
                    {{ Form::radio('term_no2', 4, false, array('id'=>'modal_termNo_name4', 'required'=>'true')) }}&nbsp 4
                </div>

                <div class="form-group">
                    {!! Form::submit('Add course',['class'=> 'btn btn-primary form-control']) !!}
                </div>
                {!! Form::close() !!}
            </div>
            <hr/>
            <h2>Display Courses</h2>
            <div class="form-group col-md-7">
                <div class="input-group">
                    <span class="input-group-addon">Search</span>
                    <input type="text" name="search" id ="search" placeholder="Search Course id" class ="form-control">
                </div>
            </div>
            <table id="myTalbe" class="table table-striped table-bordered table-hover table-condensed text-center">
                <thead class="thead-default">
                <th class="text-center">Course Id</th>
                <th class="text-center">Sessions Days</th>
                <th class="text-center">Course Type</th>
                <th class="text-center">Term No</th>
                <th class="text-center">Edit Course</th>
                <th class="text-center">Delete Course</th>
                </thead>

                <tbody class = "searchCourseBody">

                </tbody>

            </table>
            <script type = "text/javascript">
                $('#search').on('keyup',function(){
                    $value = $(this).val();
                    $.ajax ({
                        type : 'GET',
                        url  : '/searchCourse',
                        data: { 'search' : $value },
                        success: function (data) {
                            $('.searchCourseBody').html(data);
                        }
                    });
                })
            </script>


            <div class="modal fade" id="addCourseSaved" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">New course added: <b><span id="courseNameAdd"></span></b></h4>
                        </div>
                        <div class="modal-body">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="changesSaved" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Changes saved for Course Id: <b><span id="courseName"></span></b></h4>
                        </div>
                        <div class="modal-body">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="editCourseModal" tabindex="-1" role="dialog" aria-labeleledby="editCourseModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="editCourseModalLabel">Edit Individual Course</h4>
                        </div>

                        {!! Form::open(['url' => 'manageCourseUpdate', 'id' => 'editCourseForm']) !!}
                        <div class="modal-body">
                            <div class="form-group">
                                <table class="table table-bordered table-condensed">
                                    <tr class="active">
                                        <td>{!! Form::label('course_id', 'Course Id') !!}</td>
                                        <td>{!! Form::text('course_id', '', array('id'=>'modal_courseid_name',
                                                                                'class'=>'form-control',
                                                                                'readonly'=>'readonly'))!!}</td>
                                    </tr>
                                    <tr>
                                        <td>{!! Form::label('sessions_days', 'Session Days') !!}</td>
                                        <td>{!! Form::number('sessions_days', '', array('id'=>'modal_sessionDays_name',
                                                                                    'class'=>'form-control',
                                                                                    'min'=>1,
                                                                                    'max'=>99))!!}</td>
                                    </tr>
                                    <tr>
                                        <td>{!! Form::label('course_type', 'Course Type') !!}</td>
                                        <td>{{ Form::select('course_type', ['Academic' => 'Academic', 'Practical'=> 'Practical'], array('id'=>'modal_courseType_name',
                                                                                                                                        'class'=>'form-control')) }}</td>
                                    </tr>
                                    <tr>
                                        <td>{!! Form::label('term_no', 'Term No') !!}</td>
                                        <td>{{ Form::radio('term_no', 1, false, array('id'=>'modal_termNo_name1')) }}1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            {{ Form::radio('term_no', 2, false, array('id'=>'modal_termNo_name2')) }}2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            {{ Form::radio('term_no', 3, false, array('id'=>'modal_termNo_name3')) }}3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            {{ Form::radio('term_no', 4, false, array('id'=>'modal_termNo_name4')) }}4
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="closeEditCourseBtn" class="btn btn-warning" data-dismiss="modal">Close</button>
                            {!! Form::submit('Save',['class'=> 'btn btn-primary form-control open-EditCourseDialog',
                                                     'id' => 'editCourseBtn']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('click', '.open-EditCourseDialog', function() {
        var course_id = $(this).data('courseid');
        var session_days = $(this).data('sessiondays');
        var course_type = $(this).data('coursetype');
        var term_no = $(this).data('termno');
        // retaining original values when edit modal comes up
        $('.modal-body #modal_courseid_name').attr('value', course_id);
        $('.modal-body #modal_sessionDays_name').attr('value', session_days);
        $('.modal-body #modal_courseType_name').val(course_type);
        if (term_no == 1) {
            $('.modal-body #modal_termNo_name1').attr('checked', 'checked');
        } else if (term_no == 2) {
            $('.modal-body #modal_termNo_name2').attr('checked', 'checked');
        } else if (term_no == 3) {
            $('.modal-body #modal_termNo_name3').attr('checked', 'checked');
        } else {
            // value is none other than 4 folks
            $('.modal-body #modal_termNo_name4').attr('checked', 'checked');
        }
    });

    // show success modal after add course
    $(document).ready(function() {
        $('#addCourseForm').on('submit', function(event) {
            var form = this;
            event.preventDefault();
            $(document).ready(function() {
                var newCourse = $('#course_id2').val();
                // show course id
                $('#courseNameAdd').html(newCourse);
                $('#addCourseSaved').modal('show');
            });
            setTimeout(function () {
                form.submit();
            }, 2000); // wait 2 seconds until form process - so user can read success message
        });
    });

    // show success modal after edit course
    $(document).ready(function() {
        $('#editCourseForm').on('submit', function(event) {
            var form = this;
            event.preventDefault();
            // close edit course modal
            $('#editCourseModal').modal('hide');
            $(document).ready(function() {
                var course_id = $('#modal_courseid_name').val();
                // show course id
                $('#courseName').html(course_id);
                $('#changesSaved').modal('show');
            });
            setTimeout(function () {
                form.submit();
            }, 2000); // wait 2 seconds until form process - so user can read success message
        });
    });
</script>
@endsection