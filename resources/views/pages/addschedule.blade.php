@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-2 sidenav">
                @include('includes.sidebar')
            </div>



            <div class="col-sm-9">
                <h4><small>Add schedule</small></h4>
                <hr>
                <h2>Display schedule</h2>
                <form action="#somePage.php">
                    <button type="submit">Upload</button>
                    <button type="submit">Delete</button>
                </form>
            </div>

        <div class="col-sm-6">
            <h4><small>Add schedule</small></h4>
            <hr>
            <h2>Display schedule</h2>
            @foreach($courseofferings as $offerings)

            @endforeach
        </div>
        <div class="col-sm-3">
            @foreach($courseList as $course)
                <div class="panel panel-default">
                    <div class="panel-heading">{{$course->crs_id}}</div>
                    <div class="panel-body">Sessions Days: {{$course->sessions_days}} && Type: {{$course->type}}</div>
                </div>
            @endforeach

        </div>
    </div>


@endsection