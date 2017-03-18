@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-2 sidenav">
                @include('includes.sidebar')
            </div>

        <div class="col-sm-6">
            <h4><small>Manage Course </small></h4>
            <hr>
            <button href="#addNewCourse" class="btn btn-default" data-toggle="collapse">Add Course</button>
            <div class="collapse" id="addNewCourse">
                <h2>Add a New Course</h2>

            {!! Form::open(['url' => 'manageCourse']) !!}
            {{csrf_field()}}
            <div class="form-group">
                {!! Form::label('course_id', 'Course Id:') !!}
                {!! Form::text('course_id', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('sessions_days', 'Session Days:') !!}
                {!! Form::text('sessions_days', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('course_type', 'Course Type:') !!}
                {!! Form::text('course_type', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('term_no', 'Term No:') !!}
                {!! Form::text('term_no', null, ['class' => 'form-control']) !!}
            </div>
                <div class="form-group">
                    {!! Form::submit('Add course',['class'=> 'btn btn-primary form-control']) !!}
                </div>
            </div>

            {!! Form::close() !!}
            <hr/>
            <h2>Display Courses</h2>
            <table id="myTable" class="table table-striped table-bordered table-hover table-condensed text-center">
                <thead class="thead-default">
                    <th class="text-center">Course ID</th>
                    <th class="text-center">Sessions days</th>
                    <th class="text-center">Course Type</th>
                    <th class="text-center">Term No</th>
                    <th class="text-center">Edit Course</th>
                </thead>
                <tbody>
                @foreach($courses as $course)
                    <tr>
                        <td>{{$course->course_id}}</td>
                        <td>{{$course->sessions_days}}</td>
                        <td>{{$course->course_type}}</td>
                        <td>{{$course->term_no}}</td>
                        <td>
                            <button class="btn btn-primary open-EditCourseDialog"
                                    data-toggle="modal"
                                    data-courseid="{{$course->course_id}}"
                                    data-sessiondays="{{$course->sessions_days}}"
                                    data-coursetype="{{$course->course_type}}"
                                    data-termno="{{$course->term_no}}"
                                    data-target="#editCourseModal"
                            >Edit</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="modal fade" id="editCourseModal" tabindex="-1" role="dialog" aria-labeleledby="editCourseModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="editCourseModalLabel">Edit</h4>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(['url' => 'manageCourse']) !!}
                            <p>Edit Course</p>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-3">
                                        {!! Form::label('modal_courseid_name', 'Course Id:') !!}<br>
                                        {!! Form::label('modal_sessionDays_name', 'Session Days:') !!}<br>
                                        {!! Form::label('modal_courseType_name', 'Course Type:') !!}<br>
                                        {!! Form::label('modal_termNo_name', 'Term No:') !!}
                                    </div>
                                    <div class="col-sm-3">
                                        {!! Form::text('modal_courseid_name', '', array('id'=>'modal_courseid_name'))!!}
                                        {!! Form::text('modal_sessionDays_name', '', array('id'=>'modal_sessionDays_name'))!!}
                                        {!! Form::text('modal_courseType_name', '', array('id'=>'modal_courseType_name'))!!}
                                        {!! Form::text('modal_termNo_name', '', array('id'=>'modal_termNo_name'))!!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">

                            </div>
                            {!! Form::close() !!}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                            <span class="pull-right">
                                <button type="button" class="btn btn-primary">
                                    Edit
                                </button>
                            </span>
                        </div>
                        <script>
                            $(document).on('click', '.open-EditCourseDialog', function() {
                                var course_id = $(this).data('courseid');
                                var session_days = $(this).data('sessiondays');
                                var course_type = $(this).data('coursetype');
                                var term_no = $(this).data('termno');
                                console.log(course_id);
                                console.log(session_days);
                                console.log(course_type);
                                console.log(term_no);
                                $('.modal-body #modal_courseid_name').attr('value', course_id);
                                $('.modal-body #modal_sessionDays_name').attr('value', session_days);
                                $('.modal-body #modal_courseType_name').attr('value', course_type);
                                $('.modal-body #modal_termNo_name').attr('value', term_no);
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection