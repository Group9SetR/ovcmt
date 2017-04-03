@extends('layouts.app')
@section('content')
    <head>
        <link href="/css/color.css" rel="stylesheet">
    </head>
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
                            <h2>Week of {{$calendarDetails['firstOfWeek']}}</h2>
                            {{Form::open(['url'=>'dragDrop'])}}
                            <div class="form-group">
                                <!-- TODO Gylphicons clickable to next/prev week-->
                                <input type="hidden" name="selected_term_id" value="{{$term->term_id}}"/>
                                <button class="glyphicon glyphicon-chevron-left week_date_control" id="week_back"></button>
                                <input type="date" id="schedule_select" name="schedule_select_date" value="{{$calendarDetails['goToDate']}}">
                                <button class="glyphicon glyphicon-chevron-right week_date_control" id="week_forward"></button>
                                {{Form::submit('Submit')}}
                            </div>
                            {{Form::close()}}
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <h2>Course List</h2>
                        <h3>{{DateTime::createFromFormat('Y-m-d', $term->start_date)->format('Y')}}{{$term->intake_no}} Term:{{$term->term_no}}</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        {!! Form::open(['url' => 'addschedule']) !!}
                        <input type="hidden" name="selected_term_id" value="{{$term->term_id}}"/>
                        <!-- This is so we know where to send the application when we finish saving-->
                        <input type="hidden" name="schedule_date" value="{{$calendarDetails['goToDate']}}"/>
                        <table class='table table-bordered' id='drag_schedule_table'>
                            <thead>
                            <tr>
                                <th class='drag_schedule_row_head'>Room</th>
                                <th>Mon {{$calendarDetails['mon']}}</th>
                                <th>Tues {{$calendarDetails['tues']}}</th>
                                <th>Wed {{$calendarDetails['wed']}}</th>
                                <th>Thurs {{$calendarDetails['thurs']}}</th>
                                <th>Fri {{$calendarDetails['fri']}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="drag_schedule_row">
                                <th class='drag_schedule_row_head'>M1-AM</th>
                                @for($i=0; $i<5; $i++)
                                    <td ondrop="drop(event, this)" ondragover="allowDrop(event)" class="M1-am[] drop-timeslot">
                                        {!! Form::hidden('M1-am[]','empty', ['class'=>'timeslot_input']) !!}</td>
                                @endfor
                            </tr>
                            <tr class="drag_schedule_row">
                                <th class='drag_schedule_row_head'>A1-AM</th>
                                @for($i=0; $i<5; $i++)
                                    <td ondrop="drop(event, this)" ondragover="allowDrop(event)" class="A1-am[] drop-timeslot">
                                        {!! Form::hidden('A1-am[]', 'empty',['class'=>'timeslot_input']) !!}</td>
                                @endfor
                            </tr>
                            <tr class="drag_schedule_row">
                                <th class='drag_schedule_row_head'>P1-AM</th>
                                @for($i=0; $i<5; $i++)
                                    <td ondrop="drop(event, this)" ondragover="allowDrop(event)" class="P1-am[] drop-timeslot">
                                        {!! Form::hidden('P1-am[]', 'empty', ['class'=>'timeslot_input']) !!}</td>
                                @endfor
                            </tr>
                            <tr class="drag_schedule_row">
                                <th class='drag_schedule_row_head'>P2-AM</th>
                                @for($i=0; $i<5; $i++)
                                    <td ondrop="drop(event, this)" ondragover="allowDrop(event)" class="P2-am[] drop-timeslot">
                                        {!! Form::hidden('P2-am[]', 'empty', ['class'=>'timeslot_input']) !!}</td>
                                @endfor
                            </tr>
                            <tr > <!--Spacing row-->
                                <th></th>
                                @for($i=0; $i<5; $i++)
                                    <td></td>
                                @endfor
                            </tr>
                            <tr class="drag_schedule_row">
                                <th class='drag_schedule_row_head'>M1-PM</th>
                                @for($i=0; $i<5; $i++)
                                    <td ondrop="drop(event, this)" ondragover="allowDrop(event)" class="M1-pm[] drop-timeslot">
                                        {!! Form::hidden('M1-pm[]', 'empty', ['class'=>'timeslot_input']) !!}</td>
                                @endfor
                            </tr>
                            <tr class="drag_schedule_row">
                                <th class='drag_schedule_row_head'>A1-PM</th>
                                @for($i=0; $i<5; $i++)
                                    <td ondrop="drop(event, this)" ondragover="allowDrop(event)" class="A1-pm[] drop-timeslot">
                                        {!! Form::hidden('A1-pm[]', 'empty', ['class'=>'timeslot_input']) !!}</td>
                                @endfor
                            </tr>
                            <tr class="drag_schedule_row">
                                <th class='drag_schedule_row_head'>P1-PM</th>
                                @for($i=0; $i<5; $i++)
                                    <td ondrop="drop(event, this)" ondragover="allowDrop(event)" class="P1-pm[] drop-timeslot">
                                        {!! Form::hidden('P1-pm[]', 'empty', ['class'=>'timeslot_input']) !!}</td>
                                @endfor
                            </tr>
                            <tr class="drag_schedule_row">
                                <th class='drag_schedule_row_head'>P2-PM</th>
                                @for($i=0; $i<5; $i++)
                                    <td ondrop="drop(event, this)" ondragover="allowDrop(event)" class="P2-pm[] drop-timeslot">
                                        {!! Form::hidden('P2-pm[]', 'empty', ['class'=>'timeslot_input']) !!}</td>
                                @endfor
                            </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            {!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
                            {!! Form::close() !!}
                            <button class='btn btn-primary' id='clearScheduleBtn' onclick="clearSchedule()">Clear</button>
                        </div>
                        @foreach ($roomsByWeek as $timeslot)
                            <script>
                                var dayOfWeek ='<?php echo $timeslot->cdayOfWeek;?>' - 2; //decrement to account for array and MySQL
                                var room_id ='<?php echo $timeslot->room_id;?>';
                                var crn='<?php echo $timeslot->crn;?>';
                                var start_year = '<?php $date= DateTime::createFromFormat('Y-m-d', $term->start_date);
                                                            echo $date->format('Y');?>';
                                var intake_no = '<?php echo $term->intake_no;?>';
                                var color = '<?php echo $timeslot->color;?>';
                                var course_id ='<?php echo $timeslot->course_id;?>';
                                var timeSlotName = room_id+'-'+'<?php echo $timeslot->time;?>'+'[]';
                                var instructor = '<?php echo $timeslot->name;?>';
                                //TODO set to not hardcoded practical
                                appendToTimeSlot(new CourseOfferingPanel(course_id, crn, instructor, intake_no, start_year, color),
                                    timeSlotName, dayOfWeek);
                            </script>
                        @endforeach
                    </div>
                    <div class="col-sm-2 drag_course_offering_list" id='courses_listing_panel'>
                        @foreach($courseOfferings as $course)
                            <script>
                                var course_id = '<?php echo $course->course_id;?>';
                                var crn = '<?php echo $course->crn;?>';
                                var start_year = '<?php $date= DateTime::createFromFormat('Y-m-d', $term->start_date);
                                    echo $date->format('Y');?>';
                                var intake_no = '<?php echo $term->intake_no;?>';
                                var color = '<?php echo $course->color;?>';
                                var sessions = '<?php echo $courseOfferingsSessions[$course->crn];?>';
                                var instructor = '<?php echo $course->name;?>';
                                appendToCourseListings(new CourseListingPanel(course_id, crn, instructor, intake_no, start_year, color, sessions));
                            </script>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection