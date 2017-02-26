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
                <li class="active"><a href="{{ url('/masterscheduleview') }}" onClick="">Total Schedule View</a></li>
            </ul><br>
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a  href="{{ url('/addschedule') }}" onClick="">Add Schedule</a></li>
            </ul><br>
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="{{ url('/manageInstructor') }}" onClick="">Manage Instructor</a></li>
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

            <h2>make form</h2>


            <h2>Add a New Instructor</h2>
            <button href="#addInstructForm" class="btn btn-action" data-toggle="collapse">Add Instructor</button>
            <div class="collapse" id="addInstructForm">
                <form action="#somePage.php">
                    First name: <input type="text" name="instructFname">
                    <br>
                    Last name: <input type="text" name="instructLname">
                    <br>
                    Email: <input type="text" name="instructEmail">
                    <p>Check all time slots for which instructor is available:</p>
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
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
            <h2>Display Instructors</h2>


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