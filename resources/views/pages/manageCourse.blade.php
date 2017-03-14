@extends('layouts.app')

@section('content')
        <!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Instructor page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="/css/basiccss.css" rel="stylesheet">
</head>
<body>

<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-3 sidenav">
            <h2>Admin name</h2><br><br>
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="{{ url('/masterscheduleview') }}" onClick="">Master Schedule</a></li>
            </ul><br>
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a  href="{{ url('/addschedule') }}" onClick="">Add Schedule</a></li>
            </ul><br>
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="{{ url('/manageInstructor') }}" onClick="">Manage Instructor</a></li>
            </ul><br>

            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="{{ url('/manageCourse') }}" onClick="">Manage Course</a></li>
            </ul><br>
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="{{ url('/editschedule') }}" onClick="">Edit Schedule</a></li>
            </ul><br>

            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="{{ url('/draganddropschedule') }}" onClick="">Create New Schedule from Drag and Drop</a></li>
            </ul><br>
        </div>

        <div class="col-sm-9">
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


            <hr/>
            <h2>Display Course</h2>
        {!! Form::close() !!}

        </div>
    </div>
</div>

<!--
Dan > Was wondering if links should redirect to new tab?
-->
<footer class="container-fluid">
    <div>
        <a id="footerLinks" href="http://www.ovcmt.com/index.php">Home</a> -
        <a id="footerLinks" href="http://www.ovcmt.com/index.php/about">About</a> -
        <a id="footerLinks" href="http://www.ovcmt.com/index.php/apply/request-information-application">Apply</a> -
        <a id="footerLinks" href="http://www.ovcmt.com/index.php/alumni">Alumni</a> -
        <a id="footerLinks" href="http://www.ovcmt.com/index.php/clinic">Clinic</a> -
        <a id="footerLinks" href="http://www.ovcmt.com/index.php/shopl">Shop</a> -
        <a id="footerLinks" href="http://www.ovcmt.com/index.php/about/location-contact-info">Contact</a>
    </div>
</footer>

</body>
</html>
@endsection