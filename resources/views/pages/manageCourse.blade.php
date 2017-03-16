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
            <h2>Add a New Course</h2>

            {!! Form::open(['url' => 'manageCourse']) !!}
            {!! Form::open() !!}

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

            {!! Form::close() !!}
            <hr/>
            <h2>Display Courses</h2>
            <table>
                <thead>
                <th>Course ID</th>
                <th>Sessions days</th>
                <th>Course Type</th>
                <th>Term No</th>
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