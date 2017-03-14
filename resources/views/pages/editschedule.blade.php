@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Schedule Page</title>
    @section('content')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="/css/basiccss.css" rel="stylesheet">
    <script>		function allowDrop(ev) {
            ev.preventDefault();
        }

        function drag(ev) {
            ev.dataTransfer.setData("text", ev.target.id);
        }

        function drop(ev) {
            ev.preventDefault();
            var data = ev.dataTransfer.getData("text");
            ev.target.appendChild(document.getElementById(data));
        }
    </script>
</head>

<body>
<div class="container-fluid">
    <div class="row content">
        <div id="scheduleFunctionsBox" class="col-sm-2 sidenav">
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
        <div class="col-sm-6">
            <h4><small>Edit schedule</small></h4>
            <hr>
            <h2>Placeholder schedule</h2>
            <table>
                <table>
                    <tr>
                        <th>Date</th>
                    </tr>
                    <tr>
                        <td><div id="div1" ondrop="drop(event)" ondragover="allowDrop(event)">To be</div></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
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
        <div class="col-sm-4">
            <div id="drag1" draggable="true" ondragstart="drag(event)">Hello</div>
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
</body>

</html>
@endsection