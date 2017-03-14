@extends('layouts.app')

@section('content')
<script>
    function allowDrop(ev) {
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
        <div class="col-sm-9">
            <h4><small>Drag and drop schedule</small></h4>
            <hr>
            <h4>Courses</h4>
            <table ondrop="drop(event)" ondragover="allowDrop(event)">
                <tr>
                    <td>1 - &nbsp;<div id="drag1" draggable="true" ondragstart="drag(event)" style="border: .25px solid black;">Course 1</div></td>
                    <td>2 - &nbsp;<div id="drag2" draggable="true" ondragstart="drag(event)" style="border: .25px solid black;">Course 2</div></td>
                    <td>3 - &nbsp;<div id="drag3" draggable="true" ondragstart="drag(event)" style="border: .25px solid black;">Course 3</div></td>
                    <td>4 - &nbsp;<div id="drag4" draggable="true" ondragstart="drag(event)" style="border: .25px solid black;">Course 4</div></td>
                    <td>5 - &nbsp;<div id="drag5" draggable="true" ondragstart="drag(event)" style="border: .25px solid black;">Course 5</div></td>
                </tr>
                <tr>
                    <td>6 - &nbsp;<div id="drag6" draggable="true" ondragstart="drag(event)" style="border: .25px solid black;">Course 6</div></td>
                    <td>7 - &nbsp;<div id="drag7" draggable="true" ondragstart="drag(event)" style="border: .25px solid black;">Course 7</div></td>
                    <td>8 - &nbsp;<div id="drag8" draggable="true" ondragstart="drag(event)" style="border: .25px solid black;">Course 8</div></td>
                    <td>9 - &nbsp;<div id="drag9" draggable="true" ondragstart="drag(event)" style="border: .25px solid black;">Course 9</div></td>
                    <td>10 - &nbsp;<div id="drag10" draggable="true" ondragstart="drag(event)" style="border: .25px solid black;">Course 10</div></td>
                </tr>
                <!--
                <div class="col-sm-4">
                    <div id="drag1" draggable="true" ondragstart="drag(event)">Hello</div>
                </div>
                -->
            </table>

            <h4>Schedule</h4>
            <table>
                <table ondrop="drop(event)" ondragover="allowDrop(event)">
                    <tr>
                        <th>&nbsp;</th>
                        <th>Rm P1</th>
                        <th>Rm P2</th>
                        <th>Rm A1</th>
                        <th>Rm P2</th>
                    </tr>
                    <tr>
                        <td>MON - AM</td>
                        <div>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        </div>
                    </tr>
                    <tr>
                        <td>MON - PM</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>TUE - AM</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>TUE - PM</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>WED - AM</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>WED - PM</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>THU - AM</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>THU - PM</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>FRI - AM</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>FRI - PM</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
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