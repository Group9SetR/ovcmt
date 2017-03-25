@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-2 sidenav">
                @include('includes.sidebar')
            </div>

            <div class="col-sm-10">
                <div class="col-sm-6">
                    <h4><small>Assign Instructors to Courses</small></h4>
                    {{--<hr>
                    @foreach($instructors as $instructor)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                {{$instructor->first_name}}
                            </div>
                            <div class="panel-body">
                                <b>ID:</b> {{$instructor->instructor_id}} <b>Email:</b> {{$instructor->email}}
                            </div>
                        </div>
                    @endforeach--}}
                </div>
                <div class="col-sm-6">
                    <h4><small>Edit Assigned Instructors by Course</small></h4>
                    <hr>
    {{--                @foreach($courseinstructors as $ci)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                {{$ci->course_id}}
                            </div>
                            <div class="panel-body">
                                <b>ID:</b> {{$instructor->instructor_id}} <b>Email:</b> {{$instructor->email}}
                            </div>
                        </div>
                    @endforeach--}}
                </div>
            </div>
        </div>
    </div>
@endsection