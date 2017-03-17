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
            </div>
            <br>
            <div class="col-sm-6">
                {!! Form::open(['url' => 'dragDrop']) !!}
                {!! Form::open() !!}
                <table ondrop="drop(event)" ondragover="allowDrop(event)">
                    <tr>
                        <th></th>
                        <th>Rm P1</th>
                        <th>Rm P2</th>
                        <th>Rm A1</th>
                        <th>Rm P2</th>
                    </tr>
                    <tr>
                        <td>MON - AM</td>
                        <div>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </div>
                    </tr>
                    <tr>
                        <td >MON - PM</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>TUE - AM</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>TUE - PM</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>WED - AM</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>WED - PM</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>THU - AM</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>THU - PM</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>FRI - AM</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>FRI - PM</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
                <br>
                <div class="form-group">
                    {!! Form::submit('Save',['class'=> 'btn btn-primary ']) !!}
                    <!-- {!! Form::submit('Clear',['class'=> 'btn btn-primary']) !!} -->
                    <a href="dragDrop"><buton class='btn btn-primary'>Clear</buton></a>
                </div>
                {{ Form::close() }}
            </div>

            <div class="col-sm-4">
                <h2>Course List</h2>
                @foreach($courseList as $course)
                    <div class="panel panel-default" id="slid" draggable="true" ondragstart="drag(event)">
                        <div class="panel-heading">
                            {{$course->course_id}}
                        </div>
                        <div class="panel-body">
                            <b>Sessions Days:</b> {{$course->sessions_days}} <b>Type:</b> {{$course->course_type}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
@endsection