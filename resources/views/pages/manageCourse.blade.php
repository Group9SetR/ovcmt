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

            {!! Form::close() !!}
            <hr/>
            <h2>Display Course</h2>
            <?php
            $courses = DB::table('course')->pluck('crs_id');
            foreach($courses as $x) {
                echo '<h3>' . $x . '</h3>' . ', ';
            }
            ?>
        </div>
    </div>
</div>


@endsection