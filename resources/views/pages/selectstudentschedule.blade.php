@extends('layouts.viewscheduleapp')

@section('content')
    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-2 sidenav">
                <br><br>
                <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="{{ url('/selectschedulestudent') }}" onClick="">Schedule View</a></li>
                </ul>
            </div>
            <div class="col-sm-10">
                <h4><small>View Schedule</small></h4>
                <hr>
                <div class="col-sm-4">
                    {{Form::open(['url' => 'schedulestudent','id' => ''])}}
                    <div class="form-group">
                        {{Form::label('schedule_intake', 'Your intake and starting year', ['class'=>'control-label'])}}
                        <select name="schedule_intake" class="form-control">
                            @foreach($intakes as $intake)
                                <option value="{{$intake->intake_id}}">{{$intake->start_year}}{{$intake->intake_no}}</option>
                            @endforeach
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