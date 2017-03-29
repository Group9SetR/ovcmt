@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-2 sidenav" >
                @include('includes.sidebar')
            </div>

            <div class="col-sm-10">
                <div class="row">
                    <div class="col-md-6">
                        <h4><small>Manage Intake </small></h4>
                        <hr>
                        <button href="#addNewIntake" class="btn btn-default" data-toggle="collapse">Add Intake</button>
                        <div class="collapse" id="addNewIntake">
                            <h2>Add a New Intake</h2>

                            {!! Form::open(['url' => 'manageIntake', 'id' => 'addIntakeForm']) !!}

                            <div class="form-group">
                                {!! Form::label('start_date', 'Program start:', ['class'=>'control-label']) !!}
                                {!! Form::date('start_date', null, ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::submit('Add Intake',['class'=> 'btn btn-primary form-control']) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                            <th>Intake</th>
                            <th>Program Start</th>
                            <th>Intake No</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            </thead>
                            <tbody>
                            @foreach($intakes as $intake)
                                <tr>
                                    <th>{{$intake->intake_id}}</th>
                                    <td>{{$intake->start_date}}</td>
                                    <td>{{$intake->intake_no}}</td>
                                    <td><button class="btn btn-success">Edit</button></td>
                                    <td><button class="btn btn-danger">Delete</button></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection