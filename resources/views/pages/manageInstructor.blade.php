@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-2 sidenav">
            @include('includes.sidebar')
        </div>


        <div class="col-sm-6">
            <h4><small>Manage Instructors </small></h4>
            <hr>
            <button href="#addNewInstructor" class="btn btn-default" data-toggle="collapse">Add Instructor</button>
            <div class="collapse" id="addNewInstructor">
                <h2>Add a New Instructor</h2>
            {!! Form::open(['url' => 'manageInstructor']) !!}
                    {{csrf_field()}}
                    <div class="form-group">
                    {!! Form::label('first_name', 'First Name:') !!}
                    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                    {!! Form::label('email', 'Email:') !!}
                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                    </div>
                <p>Check all time slots for which instructor is available:</p>
                <div class="form-group">
                    {!! Form::label('date_start', 'Date effective:') !!}
                    {!! Form::date('date_start') !!}
                </div>
                <div class="form-group">
                <table>
                    <tr>
                        <th>Time</th><th>Mon</th><th>Tues</th><th>Wed</th><th>Thurs</th><th>Fri</th>
                    </tr>
                    <tr>
                        <td>Morn</td>
                        <td>{!! Form::checkbox('instructAvail[]', '0', false) !!}</td>
                        <td>{!! Form::checkbox('instructAvail[]', '1', false) !!}</td>
                        <td>{!! Form::checkbox('instructAvail[]', '2', false) !!}</td>
                        <td>{!! Form::checkbox('instructAvail[]', '3', false) !!}</td>
                        <td>{!! Form::checkbox('instructAvail[]', '4', false) !!}</td>

                    </tr>
                    <tr>
                        <td>Aft</td>
                        <td>{!! Form::checkbox('instructAvail[]', '5', false) !!}</td>
                        <td>{!! Form::checkbox('instructAvail[]', '6', false) !!}</td>
                        <td>{!! Form::checkbox('instructAvail[]', '7', false) !!}</td>
                        <td>{!! Form::checkbox('instructAvail[]', '8', false) !!}</td>
                        <td>{!! Form::checkbox('instructAvail[]', '9', false) !!}</td>
                    </tr>
                </table>
                </div>
                <div class="form-group">
                    {!! Form::submit('Add instructor',['class'=> 'btn btn-primary form-control']) !!}
                </div>
            </div> <!-- Close the add instructor div-->
            {!! Form::close() !!}
            <hr/>

            <h2>Display Instructors</h2>
            <table>
                <thead>
                    <th>ID</th><th>Name</th>
                    <th>Mon AM</th><th>Tues AM</th><th>Wed AM</th><th>Thurs AM</th><th>Fri AM</th>
                    <th>Mon PM</th><th>Tues PM</th><th>Wed PM</th><th>Thurs PM</th><th>Fri PM</th>
                </thead>
                <tbody>
                @foreach($instructors as $instructor)
                    <tr>
                        <td>{{$instructor->instructor_id}}</td>
                        <td>{{$instructor->first_name}}</td>
                        <td>{{$instructor->mon_am}}</td>
                        <td>{{$instructor->tues_am}}</td>
                        <td>{{$instructor->wed_am}}</td>
                        <td>{{$instructor->thurs_am}}</td>
                        <td>{{$instructor->fri_am}}</td>
                        <td>{{$instructor->mon_pm}}</td>
                        <td>{{$instructor->tues_pm}}</td>
                        <td>{{$instructor->wed_pm}}</td>
                        <td>{{$instructor->thurs_pm}}</td>
                        <td>{{$instructor->fri_pm}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>


@endsection