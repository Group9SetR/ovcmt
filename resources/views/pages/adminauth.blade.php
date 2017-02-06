@extends('layouts.app')

@section('content')
        <!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin page</title>
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
    </div>
</div>

<footer class="container-fluid">
    <div>
        <a id="footerLinks" href="http://www.ovcmt.com/index.php">Home</a>
        <a id="footerLinks" href="http://www.ovcmt.com/index.php/about">About</a>
        <a id="footerLinks" href="http://www.ovcmt.com/index.php/apply/request-information-application">Apply</a>
        <a id="footerLinks" href="http://www.ovcmt.com/index.php/alumni">Alumni</a>
        <a id="footerLinks" href="http://www.ovcmt.com/index.php/clinic">Clinic</a>
        <a id="footerLinks" href="http://www.ovcmt.com/index.php/shopl">Shop</a>
        <a id="footerLinks" href="http://www.ovcmt.com/index.php/about/location-contact-info">Contact</a>
    </div>
</footer>

</body>
</html>
@endsection