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
                {!! Form::open() !!}

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
                <table>
                    <tr>
                        <th>Time</th><th>Mon</th><th>Tues</th><th>Wed</th><th>Thurs</th><th>Fri</th>
                    </tr>
                    <tr>
                        <td>Morn</td>
                        <td><input type="checkbox" name="instructAvail[]" value="mon_am"></td>
                        <td><input type="checkbox" name="instructAvail[]" value="tues_am"></td>
                        <td><input type="checkbox" name="instructAvail[]" value="wed_am"></td>
                        <td><input type="checkbox" name="instructAvail[]" value="th_am"></td>
                        <td><input type="checkbox" name="instructAvail[]" value="fri_am"></td>
                    </tr>
                    <tr>
                        <td>Aft</td>
                        <td><input type="checkbox" name="instructAvail[]" value="mon_pm"></td>
                        <td><input type="checkbox" name="instructAvail[]" value="tues_pm"></td>
                        <td><input type="checkbox" name="instructAvail[]" value="wed_pm"></td>
                        <td><input type="checkbox" name="instructAvail[]" value="thurs_pm"></td>
                        <td><input type="checkbox" name="instructAvail[]" value="fri_pm"></td>
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
                    <th>ID</th>
                    <th>Name</th>
                </thead>
                <tbody>
                @foreach($instructors as $instructor)
                    <tr>
                        <td>{{$instructor->instructor_id}}</td>
                        <td>{{$instructor->first_name}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection