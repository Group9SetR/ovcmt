@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-2 sidenav">
                <br><br>
                <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="{{ url('/schedulestudent') }}" onClick="">Schedule View</a></li>
                </ul><br>
            </div>
            <div class="col-sm-8">

                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group col-md-4">
                            <h2>Display schedule</h2>
                            {{Form::open(['url'=>'dragDrop'])}}

                            {{Form::label('schedule_starting_date', 'Week of:')}}
                            {{Form::date('schedule_starting_date', Carbon\Carbon::today(new DateTimeZone('America/Vancouver')))}}

                            {{Form::close()}}
                        </div>

                    </div>

                </div>


            </div>
        </div>
    </div>


@endsection s