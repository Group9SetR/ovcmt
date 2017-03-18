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
            <div class="col-sm-10">
                <h4><small>Add schedule</small></h4>
                <hr>
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <h2>Display schedule</h2>
                            {{Form::open(['url'=>'dragDrop'])}}

                            {{Form::label('schedule_starting_date', 'Week of:')}}
                            {{Form::date('schedule_starting_date', \Carbon\Carbon::now())}}

                            {{Form::submit()}}
                            {{Form::close()}}
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <h2>Course List</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        {!! Form::open(['url' => 'dragDrop']) !!}
                        <table ondrop="drop(event)" class='table table-bordered' id='drag_schedule_table'>
                            <thead>
                            <tr>
                                <th class='drag_schedule_row_head'>Room</th>
                                <th>Mon</th>
                                <th>Tues</th>
                                <th>Wed</th>
                                <th>Thurs</th>
                                <th>Fri</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="drag_schedule_row">
                                <th class='drag_schedule_row_head'>M1-AM</th>
                                <td ondragover="allowDrop(event)" name="M1-am[]"></td>
                                <td ondragover="allowDrop(event)" name="M1-am[]"></td>
                                <td ondragover="allowDrop(event)" name="M1-am[]"></td>
                                <td ondragover="allowDrop(event)" name="M1-am[]"></td>
                                <td ondragover="allowDrop(event)" name="M1-am[]"></td>
                            </tr>
                            <tr class="drag_schedule_row">
                                <th class='drag_schedule_row_head'>A1-AM</th>
                                <td ondragover="allowDrop(event)" name="A1-am[]"></td>
                                <td ondragover="allowDrop(event)" name="A1-am[]"></td>
                                <td ondragover="allowDrop(event)" name="A1-am[]"></td>
                                <td ondragover="allowDrop(event)" name="A1-am[]"></td>
                                <td ondragover="allowDrop(event)" name="A1-am[]"></td>
                            </tr>
                            <tr class="drag_schedule_row">
                                <th class='drag_schedule_row_head'>P1-AM</th>
                                <td ondragover="allowDrop(event)" name="P1-am[]"></td>
                                <td ondragover="allowDrop(event)" name="P1-am[]"></td>
                                <td ondragover="allowDrop(event)" name="P1-am[]"></td>
                                <td ondragover="allowDrop(event)" name="P1-am[]"></td>
                                <td ondragover="allowDrop(event)" name="P1-am[]"></td>
                            </tr>
                            <tr class="drag_schedule_row">
                                <th class='drag_schedule_row_head'>P2-AM</th>

                                <td ondragover="allowDrop(event)" name="P2-am[]"></td>
                                <td ondragover="allowDrop(event)" name="P2-am[]"></td>
                                <td ondragover="allowDrop(event)" name="P2-am[]"></td>
                                <td ondragover="allowDrop(event)" name="P2-am[]"></td>
                                <td ondragover="allowDrop(event)" name="P2-am[]"></td>
                            </tr>
                            <tr > <!--Spacing row-->
                                <th></th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="drag_schedule_row">
                                <th class='drag_schedule_row_head'>M1-PM</th>
                                <td ondragover="allowDrop(event)" name="M1-pm[]"></td>
                                <td ondragover="allowDrop(event)" name="M1-pm[]"></td>
                                <td ondragover="allowDrop(event)" name="M1-pm[]"></td>
                                <td ondragover="allowDrop(event)" name="M1-pm[]"></td>
                                <td ondragover="allowDrop(event)" name="M1-pm[]"></td>
                            </tr>
                            <tr class="drag_schedule_row">                                
                                <th class='drag_schedule_row_head'>A1-PM</th>
                                <td ondragover="allowDrop(event)" name="A1-pm[]"></td>
                                <td ondragover="allowDrop(event)" name="A1-pm[]"></td>
                                <td ondragover="allowDrop(event)" name="A1-pm[]"></td>
                                <td ondragover="allowDrop(event)" name="A1-pm[]"></td>
                                <td ondragover="allowDrop(event)" name="A1-pm[]"></td>
                            </tr>
                            <tr class="drag_schedule_row">
                                <th class='drag_schedule_row_head'>P1-PM</th>
                                <td ondragover="allowDrop(event)" name="P1-pm[]"></td>
                                <td ondragover="allowDrop(event)" name="P1-pm[]"></td>
                                <td ondragover="allowDrop(event)" name="P1-pm[]"></td>
                                <td ondragover="allowDrop(event)" name="P1-pm[]"></td>
                                <td ondragover="allowDrop(event)" name="P1-pm[]"></td>
                            </tr>
                            <tr class="drag_schedule_row">
                                <th class='drag_schedule_row_head'>P2-PM</th>
                                <td ondragover="allowDrop(event)" name="P2-pm[]"></td>
                                <td ondragover="allowDrop(event)" name="P2-pm[]"></td>
                                <td ondragover="allowDrop(event)" name="P2-pm[]"></td>
                                <td ondragover="allowDrop(event)" name="P2-pm[]"></td>
                                <td ondragover="allowDrop(event)" name="P2-pm[]"></td>
                            </tr>
                            </tbody>
                        </table>
                        @foreach ($amRoomsByWeek as $timeslot)
                            <script>
                                var dayOfWeek ='<?php echo $timeslot->cdayOfWeek;?>';
                                dayOfWeek--;
                                var room_id ='<?php echo $timeslot->room_id;?>';
                                var crn='<?php echo $timeslot->am_crn;?>';
                                var sb = room_id+'-'+'am[]';
                                var coursePanel= document.createElement('DIV');
                                coursePanel.className=['panel panel-default drag_course_offering'];
                                coursePanel.setAttribute('id', 'slid');
                                coursePanel.setAttribute('draggable', 'true');
                                coursePanel.setAttribute('ondragstart','drag(event)');
                                var coursePanelHeading=document.createElement('DIV');
                                coursePanelHeading.append(document.createElement('P').appendChild(document.createTextNode(dayOfWeek+sb)));
                                console.log(crn);
                                coursePanel.append(coursePanelHeading);
                                var coursePanelBody = document.createElement('DIV');
                                coursePanelBody.className=['panel-body drag_course_offering_panel'];
                                coursePanelBody.append(document.createElement('P').appendChild(document.createTextNode('sessions')));
                                coursePanelBody.append(document.createElement('P').appendChild(document.createTextNode('term')));
                                coursePanelBody.append(document.createElement('P').appendChild(document.createTextNode('type')));
                                coursePanel.append(coursePanelBody);
                                document.getElementsByName(sb)[dayOfWeek].append(coursePanel);
                            </script>
                        @endforeach
                        <br>
                        <div class="form-group">
                        {!! Form::submit('Save',['class'=> 'btn btn-primary ']) !!}
                        <!-- {!! Form::submit('Clear',['class'=> 'btn btn-primary']) !!} -->
                            <a href="dragDrop"><button class='btn btn-primary'>Clear</button></a>
                        </div>
                        {{ Form::close() }}
                    </div>

                    <div class="col-sm-2 drag_course_offering_list" ondragover="allowDrop(event)" ondrop="drop(event)">
                        @foreach($courseofferings as $course)
                            <div class="panel panel-default drag_course_offering" id="slid" draggable="true" ondragstart="drag(event)">
                                <div class="panel-heading">
                                    {{$course->course_id}} <b>CRN:</b>{{$course->crn}}
                                </div>
                                <div class="panel-body drag_course_offering_panel">
                                    <b>Sessions:</b> {{$course->sessions_days}}<br>
                                    <b>Term: </b> {{$course->term_no}} <br>
                                    <b>Type:</b> {{$course->course_type}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <br>


        </div>
@endsection