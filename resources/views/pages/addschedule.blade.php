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
            <h4><small>Add schedule</small></h4>
            <hr>
            <h2>Display schedule</h2>
            <form action="#somePage.php">
                <button type="submit">Upload</button>
                <button type="submit">Delete</button>
            </form>
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