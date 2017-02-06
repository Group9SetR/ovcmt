@extends('layouts.app')

@section('content')
        <!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Schedule Page</title>
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
        <div id="scheduleFunctionsBox" class="col-sm-3 sidenav">
            <h2>Admin name</h2><br><br>
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="{{ url('/tolschedualview') }}" onClick="">Total schedule view</a></li>
            </ul><br>
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a  href="{{ url('/addschedual') }}" onClick="">Add schedule</a></li>
            </ul><br>
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="#section1">Add user</a></li>
            </ul><br>
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="{{ url('/editSchedule') }}" onClick="">Edit schedule</a></li>
            </ul><br>
        </div>
        <div class="col-sm-9">
            <h4><small>Edit schedule</small></h4>
            <hr>
            <h2>Drag and drop? Or whatever functionality to alter selected schedule.</h2>
            Placeholder schedule
            <table>
                <table>
                    <tr>
                        <th>Date</th>
                        <th>Monday</th>
                        <th>Tuesday</th>
                        <th>Wednesday</th>
                        <th>Thursday</th>
                        <th>Friday</th>
                    </tr>
                    <tr>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                    </tr>
                </table>
            </table>
            <br>
            <form action="#somePage.php">
                <button type="submit" class="btn btn-success">Save changes</button>
                <button type="submit" class="btn btn-warning">Undo</button>
                <button type="submit" class="btn btn-warning">Redo</button>
                <button type="submit" class="btn btn-danger">Discard changes</button>
            </form>
        </div>
    </div>
</div>

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