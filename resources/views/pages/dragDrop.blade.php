@extends('layouts.app')
@section('content')
    <script>
        function allowDrop(ev) {
            ev.preventDefault();
        }

        function drag(ev) {
            ev.dataTransfer.setData("text", ev.target.id);
        }

        function drop(ev, el) {
            ev.preventDefault();
            var data = ev.dataTransfer.getData("text");
            /*TODO Change naming of copies so you can easily retrace and find the original -- even when it is hidden*/
            /*TODO Implement a deletion button on all drag_course_offering*/
            /*TODO If a copydrop is deleted, increment the sessions counter*/
            if(document.getElementById(data).classList.contains('drag_course_offering_listing')) {
                var nodeCopy = document.getElementById(data).cloneNode(true);
                nodeCopy.id = 'dropcop'; /* We cannot use the same ID */
                nodeCopy.classList.remove('drag_course_offering_listing');
                var text = $('#'+data+' .drag_course_offering_listing_sessions_days').contents().filter(function() {
                    return this.nodeType == Node.TEXT_NODE;
                }).text();
                var sessionsDays = parseInt(text)-1;
                if(sessionsDays>0) {
                    $('#'+data+' .drag_course_offering_listing_sessions_days').first()[0].innerHTML = sessionsDays;
                    ev.target.appendChild(nodeCopy);
                    $('#'+nodeCopy.id+' .drag_course_offering_listing_sessions').remove();
                } else if(sessionsDays==0){
                    /*TODO hide that listing as an option*/
                    $('#'+data+' .drag_course_offering_listing_sessions_days').first()[0].innerHTML = sessionsDays;
                    ev.target.appendChild(nodeCopy);
                    $('#'+nodeCopy.id+' .drag_course_offering_listing_sessions').remove();
                    $('#'+data).hide();
                }

            } else {
                el.appendChild(document.getElementById(data));
            }
            $("div[id^='dropcop']").attr('id', function(i) {
                return "dropcopy" + ++i;
            });
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
                        <table class='table table-bordered' id='drag_schedule_table'>
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
                                <td ondrop="drop(event, this)" ondragover="allowDrop(event)" name="M1-am[]"></td>
                                <td ondrop="drop(event, this)" ondragover="allowDrop(event)" name="M1-am[]"></td>
                                <td ondrop="drop(event, this)"  ondragover="allowDrop(event)" name="M1-am[]"></td>
                                <td ondrop="drop(event, this)"  ondragover="allowDrop(event)" name="M1-am[]"></td>
                                <td ondrop="drop(event, this)"  ondragover="allowDrop(event)" name="M1-am[]"></td>
                            </tr>
                            <tr class="drag_schedule_row">
                                <th class='drag_schedule_row_head'>A1-AM</th>
                                <td ondrop="drop(event, this)" ondragover="allowDrop(event)" id="A1-AM-0" name="A1-am[]"></td>
                                <td ondrop="drop(event, this)" ondragover="allowDrop(event)" id="A1-AM-1" name="A1-am[]"></td>
                                <td ondrop="drop(event, this)" ondragover="allowDrop(event)" id="A1-AM-2" name="A1-am[]"></td>
                                <td ondrop="drop(event, this)" ondragover="allowDrop(event)" id="A1-AM-3" name="A1-am[]"></td>
                                <td ondrop="drop(event, this)" ondragover="allowDrop(event)" id="A1-AM-4" name="A1-am[]"></td>
                            </tr>
                            <tr class="drag_schedule_row">
                                <th class='drag_schedule_row_head'>P1-AM</th>
                                <td ondrop="drop(event, this)" ondragover="allowDrop(event)" name="P1-am[]"></td>
                                <td ondrop="drop(event, this)" ondragover="allowDrop(event)" name="P1-am[]"></td>
                                <td ondrop="drop(event, this)" ondragover="allowDrop(event)" name="P1-am[]"></td>
                                <td ondrop="drop(event, this)" ondragover="allowDrop(event)" name="P1-am[]"></td>
                                <td ondrop="drop(event, this)" ondragover="allowDrop(event)" name="P1-am[]"></td>
                            </tr>
                            <tr class="drag_schedule_row">
                                <th class='drag_schedule_row_head'>P2-AM</th>

                                <td ondrop="drop(event, this)" ondragover="allowDrop(event)" name="P2-am[]"></td>
                                <td ondrop="drop(event, this)" ondragover="allowDrop(event)" name="P2-am[]"></td>
                                <td ondrop="drop(event, this)" ondragover="allowDrop(event)" name="P2-am[]"></td>
                                <td ondrop="drop(event, this)" ondragover="allowDrop(event)" name="P2-am[]"></td>
                                <td ondrop="drop(event, this)" ondragover="allowDrop(event)" name="P2-am[]"></td>
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
                                <td ondrop="drop(event, this)" ondragover="allowDrop(event)" name="M1-pm[]"></td>
                                <td ondrop="drop(event, this)" ondragover="allowDrop(event)" name="M1-pm[]"></td>
                                <td ondrop="drop(event, this)" ondragover="allowDrop(event)" name="M1-pm[]"></td>
                                <td ondrop="drop(event, this)" ondragover="allowDrop(event)" name="M1-pm[]"></td>
                                <td ondrop="drop(event, this)" ondragover="allowDrop(event)" name="M1-pm[]"></td>
                            </tr>
                            <tr class="drag_schedule_row">
                                <th class='drag_schedule_row_head'>A1-PM</th>
                                <td ondrop="drop(event, this)" ondragover="allowDrop(event)" name="A1-pm[]"></td>
                                <td ondrop="drop(event, this)" ondragover="allowDrop(event)" name="A1-pm[]"></td>
                                <td ondrop="drop(event, this)" ondragover="allowDrop(event)" name="A1-pm[]"></td>
                                <td ondrop="drop(event, this)" ondragover="allowDrop(event)" name="A1-pm[]"></td>
                                <td ondrop="drop(event, this)" ondragover="allowDrop(event)" name="A1-pm[]"></td>
                            </tr>
                            <tr class="drag_schedule_row">
                                <th class='drag_schedule_row_head'>P1-PM</th>
                                <td ondrop="drop(event, this)" ondragover="allowDrop(event)" name="P1-pm[]"></td>
                                <td ondrop="drop(event, this)" ondragover="allowDrop(event)" name="P1-pm[]"></td>
                                <td ondrop="drop(event, this)" ondragover="allowDrop(event)" name="P1-pm[]"></td>
                                <td ondrop="drop(event, this)" ondragover="allowDrop(event)" name="P1-pm[]"></td>
                                <td ondrop="drop(event, this)" ondragover="allowDrop(event)" name="P1-pm[]"></td>
                            </tr>
                            <tr class="drag_schedule_row">
                                <th class='drag_schedule_row_head'>P2-PM</th>
                                <td ondrop="drop(event, this)" ondragover="allowDrop(event)" name="P2-pm[]"></td>
                                <td ondrop="drop(event, this)" ondragover="allowDrop(event)" name="P2-pm[]"></td>
                                <td ondrop="drop(event, this)" ondragover="allowDrop(event)" name="P2-pm[]"></td>
                                <td ondrop="drop(event, this)" ondragover="allowDrop(event)" name="P2-pm[]"></td>
                                <td ondrop="drop(event, this)" ondragover="allowDrop(event)" name="P2-pm[]"></td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                        {!! Form::submit('Save',['class'=> 'btn btn-primary ']) !!}
                        {!! Form::submit('Clear',['class'=> 'btn btn-primary']) !!}
                            <a href="dragDrop"><button class='btn btn-primary'>Clear</button></a>
                        </div>
                        {{ Form::close() }}
                        @foreach ($amRoomsByWeek as $timeslot)
                            <script>
                                var dayOfWeek ='<?php echo $timeslot->cdayOfWeek;?>';
                                dayOfWeek--;
                                dayOfWeek--;
                                var room_id ='<?php echo $timeslot->room_id;?>';
                                var crn='<?php echo $timeslot->am_crn;?>';
                                var course_id ='<?php echo $timeslot->am_course_id;?>';
                                var sb = room_id+'-'+'am[]';
                                var coursePanel= document.createElement('DIV');
                                coursePanel.className=['panel panel-default drag_course_offering'];
                                coursePanel.setAttribute('id', 'slid');
                                coursePanel.setAttribute('draggable', 'true');
                                coursePanel.setAttribute('ondragstart','drag(event)');
                                coursePanel.setAttribute('ondrop','return false;');
                                coursePanel.setAttribute('ondragover', 'return false;');
                                var coursePanelHeading=document.createElement('DIV');
                                coursePanelHeading.className='panel-heading';
                                var heading = document.createElement('P');
                                coursePanelHeading.append(document.createElement('P').appendChild(document.createTextNode(course_id + ' CRN:' +crn)));
                                coursePanel.append(coursePanelHeading);
                                var coursePanelBody = document.createElement('DIV');
                                coursePanelBody.className=['panel-body drag_course_offering_panel'];
                                coursePanelBody.append(document.createElement('P').appendChild(document.createTextNode('Term:\n')));
                                coursePanelBody.append(document.createElement('P').appendChild(document.createTextNode('Type:\n')));
                                coursePanel.append(coursePanelBody);
                                document.getElementsByName(sb)[dayOfWeek].append(coursePanel);
                            </script>
                        @endforeach
                    </div>
                    <div class="col-sm-2 drag_course_offering_list" ondragover="allowDrop(event)" ondrop="drop(event, this)">
                        @foreach($courseofferings as $course)
                            <div class="panel panel-default drag_course_offering drag_course_offering_listing" id="slid" draggable="true"
                                 ondragstart="drag(event)" ondrop="return false;" ondragover="return false;">
                                <div class="panel-heading">
                                    {{$course->course_id}} <b>CRN:</b>{{$course->crn}}
                                </div>
                                <div class="panel-body drag_course_offering_panel">
                                    <b class='drag_course_offering_listing_sessions'>Sessions:
                                        <span class='drag_course_offering_listing_sessions_days'>{{$course->sessions_days}}</span><br></b>
                                    <b>Term: </b> {{$course->term_no}} <br>
                                    <b>Type:</b> {{$course->course_type}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection