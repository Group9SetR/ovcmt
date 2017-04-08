@extends('layouts.viewscheduleapp')

@section('content')
    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-2 sidenav">
                @if(Auth::user()->usertype == 'admin')
                    @include('includes.sidebar')
                @else
                    <br>
                    <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a href="{{ url('/selectinstructorschedule') }}" onClick="">Schedule View</a></li>
                    </ul><br>
                @endif
            </div>
            <div class="col-sm-10">
                <h4><small>Display Schedule</small></h4>
                <hr>
                <!-- TODO Display only schedules by term-->
                <!-- TODO Date picker -->

                <div class="row">
                    <div class="col-md-6">
                        <h3><!--<span class="glyphicon glyphicon-chevron-left"></span>-->
                        {{$schedule_date->format('F Y')}}
                        <!--<span class="glyphicon glyphicon-chevron-right"></span></h3>-->
                            {{Form::open(['url' => 'scheduleinstructor','id' => 'dateSelectForm'])}} </h3>
                        <div class="form-group">
                            <input type="hidden" name="schedule_instructor" value="{{$instructor->instructor_id}}">
                            <!-- TODO Gylphicons clickable to next/prev week-->
                            <!--<button class="glyphicon glyphicon-chevron-left week_date_control" id="week_back"></button>-->
                            <input type="date" id="schedule_select" name="schedule_starting_date" value="{{$schedule_date->format('Y-m-01')}}">
                            <!--<button class="glyphicon glyphicon-chevron-right week_date_control" id="week_forward"></button>-->
                            {{ Form::submit('Submit') }}
                        </div>
                        {{Form::close()}}
                    </div>
                    <div class="col-md-6">
                        <h3 style="float:right">{{$instructor->first_name}}'s Schedule</h3>
                    </div>
                </div>


                <table class="table table-striped table-bordered table-hover text-center" id="schedule_view_table">
                    <thead class="thead-default">
                    <tr class="success">
                        <th>Mon</th>
                        <th>Tues</th>
                        <th>Wed</th>
                        <th>Thurs</th>
                        <th>Fri</th>
                    </tr>
                    </thead>
                    <tbody>
                    @for($i=0; $i<sizeof($weeks);$i++)
                        <tr class="schedule_wk_{{$i}}">
                            <!-- first row -->
                            @if($i==0)
                                @for($j=0; $j<5-sizeof($weeks[$i]); $j++)
                                    <td></td>
                                @endfor
                                @for($j=0; $j<sizeof($weeks[$i]); $j++)
                                    <td><span class="schedule_day_of_month">{{$weeks[$i][$j]}}</span>
                                        <div class="am"></div>
                                        <div class="pm"></div>
                                    </td>
                                @endfor
                            <!-- last row -->
                            @elseif($i == sizeof($weeks)-1)
                                @for($j=0; $j<sizeof($weeks[$i]); $j++)
                                    <td><span class="schedule_day_of_month">{{$weeks[$i][$j]}}</span>
                                        <div class="am"></div>
                                        <div class="pm"></div>
                                    </td>
                                @endfor
                                @for($j=0; $j<5-sizeof($weeks[$i]);$j++)
                                    <td></td>
                                @endfor
                            @else
                                @for($j=0; $j<5; $j++)
                                    <td>
                                        <span class="schedule_day_of_month">{{$weeks[$i][$j]}}</span>
                                        <div class="am"></div>
                                        <div class="pm"></div>
                                    </td>
                                @endfor
                            @endif
                        </tr>
                    @endfor
                    </tbody>
                </table>
                @foreach($courses['am_courses'] as $amcourse)
                    <script>
                        var course_id = '<?php echo $amcourse->course_id;?>';
                        var room_id =  '<?php echo $amcourse->room_id;?>';
                        var color = '<?php echo $amcourse->color;?>';
                        var instructor = '<?php echo $instructor->first_name;?>';
                        var date = new Date('<?php echo $amcourse->cdate;?>').getDate()+1;
                        var dates = document.getElementsByTagName('span');
                        for(var i=0; i<dates.length; i++) {
                            if(dates.item(i).innerHTML == date) {
                                dates.item(i).nextElementSibling.append(new Panel(course_id, room_id, color, instructor));
                                break;
                            }
                        }
                    </script>
                @endforeach

                @foreach($courses['pm_courses'] as $pmcourse)
                    <script>
                        var course_id = '<?php echo $pmcourse->course_id;?>';
                        var room_id =  '<?php echo $pmcourse->room_id;?>';
                        var color = '<?php echo $pmcourse->color;?>';
                        var instructor = '<?php echo $instructor->first_name;?>';
                        var date = new Date('<?php echo $pmcourse->cdate;?>').getDate()+1;
                        var dates = document.getElementsByTagName('span');
                        for(var i=0; i<dates.length; i++) {
                            if(dates.item(i).innerHTML == date) {
                                dates.item(i).nextElementSibling.nextElementSibling.append(new Panel(course_id, room_id, color, instructor));
                                break;
                            }
                        }
                    </script>
                @endforeach
            </div>
        </div>
    </div>


    <script type="text/javascript">
        function tableToJson(table) {
            var data = [];

            // first row needs to be headers
            var headers = [];
            for (var i=0; i<table.rows[0].cells.length; i++) {
                headers[i] = table.rows[0].cells[i].innerHTML.toLowerCase().replace(/ /gi,'');
            }
            data.push(headers);
            // go through cells
            for (var i=1; i<table.rows.length; i++) {

                var tableRow = table.rows[i];
                var rowData = {};

                for (var j=0; j<tableRow.cells.length; j++) {

                    rowData[ headers[j] ] = tableRow.cells[j].innerHTML;

                }

                data.push(rowData);
            }

            return data;
        }

        function callme(){
            var table = tableToJson($('#yourTableIdName').get(0));
            var doc = new jsPDF('p','pt', 'a4', true);

            doc.cellInitialize();
            $.each(table, function (i, row){
                doc.setFontSize(10);

                $.each(row, function (j, cell){
                    doc.cell(50, 50, 70, 30, cell, i);
                })
            })

            doc.save('OvcmtTimetable.pdf');
        }

    </script>


@endsection