@extends('layouts.app')
@section('content')
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
                                @for($i=0; $i<5; $i++)
                                    <td ondrop="drop(event, this)" ondragover="allowDrop(event)" name="M1-am[]"></td>
                                @endfor
                            </tr>
                            <tr class="drag_schedule_row">
                                <th class='drag_schedule_row_head'>A1-AM</th>
                                @for($i=0; $i<5; $i++)
                                    <td ondrop="drop(event, this)" ondragover="allowDrop(event)" name="A1-am[]"></td>
                                @endfor
                            </tr>
                            <tr class="drag_schedule_row">
                                <th class='drag_schedule_row_head'>P1-AM</th>
                                @for($i=0; $i<5; $i++)
                                    <td ondrop="drop(event, this)" ondragover="allowDrop(event)" name="P1-am[]"></td>
                                @endfor
                            </tr>
                            <tr class="drag_schedule_row">
                                <th class='drag_schedule_row_head'>P2-AM</th>
                                @for($i=0; $i<5; $i++)
                                    <td ondrop="drop(event, this)" ondragover="allowDrop(event)" name="P2-am[]"></td>
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
                                    <td ondrop="drop(event, this)" ondragover="allowDrop(event)" name="M1-pm[]"></td>
                                @endfor
                            </tr>
                            <tr class="drag_schedule_row">
                                <th class='drag_schedule_row_head'>A1-PM</th>
                                @for($i=0; $i<5; $i++)
                                    <td ondrop="drop(event, this)" ondragover="allowDrop(event)" name="A1-pm[]"></td>
                                @endfor
                            </tr>
                            <tr class="drag_schedule_row">
                                <th class='drag_schedule_row_head'>P1-PM</th>
                                @for($i=0; $i<5; $i++)
                                    <td ondrop="drop(event, this)" ondragover="allowDrop(event)" name="P1-pm[]"></td>
                                @endfor
                            </tr>
                            <tr class="drag_schedule_row">
                                <th class='drag_schedule_row_head'>P2-PM</th>
                                @for($i=0; $i<5; $i++)
                                    <td ondrop="drop(event, this)" ondragover="allowDrop(event)" name="P2-pm[]"></td>
                                @endfor
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
                                var dayOfWeek ='<?php echo $timeslot->cdayOfWeek;?>' - 2; //decrement to account for array and MySQL
                                var room_id ='<?php echo $timeslot->room_id;?>';
                                var crn='<?php echo $timeslot->am_crn;?>';
                                var course_id ='<?php echo $timeslot->am_course_id;?>';
                                var timeSlotName = room_id+'-'+'am[]';
                                appendToTimeSlot(createCourseOfferingSessionPanel(course_id, crn, 1, 'practical', undefined, false),
                                    timeSlotName, dayOfWeek);
                            </script>
                        @endforeach
                    </div>
                    <div class="col-sm-2 drag_course_offering_list" id='courses_listing_panel'>
                        @foreach($courseofferings as $course)
                            <script>
                                var course_id = '<?php echo $course->course_id;?>';
                                var crn = '<?php echo $course->crn;?>';
                                var sessions = '<?php echo $course->sessions_days;?>';
                                var term = '<?php echo $course->term_no;?>';
                                var type = '<?php echo $course->course_type;?>';
                                appendToCourseListings(createCourseOfferingSessionPanel(course_id, crn, term, type, sessions, true));
                            </script>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection