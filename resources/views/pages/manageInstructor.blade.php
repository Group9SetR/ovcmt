@extends('layouts.app')

@section('content')
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
            <h4><small>Manage Instructors </small></h4>
            <hr>
            <h2>Add a New Instructor</h2>

        {!! Form::open(['url' => 'manageInstructor']) !!}
            {!! Form::open() !!}

                {{csrf_field()}}
                <div class="form-group">
                {!! Form::label('first_name', 'First Name:') !!}
                {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                {!! Form::label('last_name', 'Last Name:') !!}
                {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
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


            <hr/>
            <h2>Display Instructors</h2>
            {!! Form::close() !!}

            <!--
            <button href="#addInstructForm" class="btn btn-action" data-toggle="collapse">Add Instructor</button>

            <div class="collapse" id="addInstructForm">
                <form action="#somePage.php">
                    First name: <input type="text" name="instructFname">
                    <br>
                    Last name: <input type="text" name="instructLname">
                    <br>
                    Email: <input type="text" name="instructEmail">

                </form>
            </div>
            -->



        </div>
    </div>
</div>

<footer class="container-fluid">
    <div>
        <a id="footerLinks" target="_blank" href="http://www.ovcmt.com/index.php">Home</a> -
        <a id="footerLinks" target="_blank" href="http://www.ovcmt.com/index.php/about">About</a> -
        <a id="footerLinks" target="_blank" href="http://www.ovcmt.com/index.php/apply/request-information-application">Apply</a> -
        <a id="footerLinks" target="_blank" href="http://www.ovcmt.com/index.php/alumni">Alumni</a> -
        <a id="footerLinks" target="_blank" href="http://www.ovcmt.com/index.php/clinic">Clinic</a> -
        <a id="footerLinks" target="_blank" href="http://www.ovcmt.com/index.php/shopl">Shop</a> -
        <a id="footerLinks" target="_blank" href="http://www.ovcmt.com/index.php/about/location-contact-info">Contact</a>
    </div>
</footer>
@endsection