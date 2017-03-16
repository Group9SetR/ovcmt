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
                {!! Form::open() !!}

                {{csrf_field()}}
                <div class="form-group">
                    {!! Form::label('course_id', 'Course Id:') !!}
                    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('course_name', 'Course Name:') !!}
                    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('course_amen_req', 'Course_amen_req:') !!}
                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Add course',['class'=> 'btn btn-primary form-control']) !!}
                </div>
            </div>

            {!! Form::close() !!}
            <hr/>
            <h2>Display Courses</h2>
            <table>
                <thead>
                    <th>Course ID</th>
                    <th>Session Days</th>
                    <th>Course Type</th>
                    <th>Term No.</th>
                </thead>
                <tbody>
                @foreach($courses as $course)
                    <tr>
                        <td>{{$course->course_id}}</td>
                        <td>{{$course->sessions_days}}</td>
                        <td>{{$course->course_type}}</td>
                        <td>{{$course->term_no}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection