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

    $(document).ready(function() {
        $("div[id^='slid']").attr('id', function(i) {
            return "slide" + ++i;
        });
    });
</script>
    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-2 sidenav">
                @include('includes.sidebar')
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
        <div class="col-sm-6">
            <h4><small>Add schedule</small></h4>
            <hr>
            <h2>Display schedule</h2>
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
                    <td >MON - PM</td>
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
        </div>
        <div class="col-sm-3">
            @foreach($offeringswithsessions as $course)
                <div class="panel panel-default" id="slid" draggable="true" ondragstart="drag(event)">
                    <div class="panel-heading">{{$course->crs_id}}</div>
                    <div class="panel-body">Sessions Days: {{$course->sessions_days}} && Type: {{$course->type}}</div>
                </div>
            @endforeach

        </div>
    </div>


@endsection