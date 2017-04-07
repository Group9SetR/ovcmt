@extends('layouts.viewscheduleapp')

@section('content')
    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-2 sidenav">
                @if(Auth::user()->usertype == 'admin')
                    @include('includes.sidebar')
                @else
                    <br>
                    <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a href="{{ url('/selectinstructorschedule') }}" onClick="">Schedule View</a></li>
                    </ul><br>
                @endif
            </div>
            <div class="col-sm-10">
                <h4><small>View Schedule</small></h4>
                <hr>
                <div class="col-sm-4">
                    {{Form::open(['url' => 'scheduleinstructor','id' => ''])}}
                    <div class="form-group">
                        {{Form::label('schedule_instructor', 'Instructor:', ['class'=>'control-label'])}}
                        <select name="schedule_instructor" class="form-control">
                            @if(isset($instructors))
                                @foreach($instructors as $instructor)
                                    <option value="{{$instructor->instructor_id}}">{{$instructor->first_name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        {{ Form::submit('Submit',['class'=> 'btn btn-primary form-inline']) }}
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
@endsection