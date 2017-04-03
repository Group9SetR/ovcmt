@extends('layouts.viewscheduleapp')

@section('content')
<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-2 sidenav">
            <br><br>
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="{{ url('/selectschedulestudent') }}" onClick="">Schedule View</a></li>
            </ul>
        </div>
        <div class="col-sm-10">
            <h4><small>Display schedule</small></h4>
            <hr>
            <!-- TODO Display only schedules by term-->
            <!-- TODO Date picker -->

            <div class="row">
                <div class="col-md-6">
                    <h3><!--<span class="glyphicon glyphicon-chevron-left"></span>-->
                        {{$details['schedule_date']->format('F Y')}}
                        <!--<span class="glyphicon glyphicon-chevron-right"></span></h3>-->
                        {{Form::open(['url' => 'schedulestudent','id' => 'dateSelectForm'])}}
                        <div class="form-group">
                            <input type="hidden" name="schedule_intake" value="{{$details['intake_id']}}">

                            <!-- TODO Gylphicons clickable to next/prev week-->
                            <span class="glyphicon glyphicon-chevron-left"></span>
                            <input type="date" name="schedule_starting_date" value="{{$details['schedule_date']->format('Y-m-01')}}">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                            {{ Form::submit('Submit') }}
                        </div>
                    {{Form::close()}}
                </div>
                <div class="col-md-6">
                    <h3 style="float:right">Intake {{$details['intake_info']->start_date->format('Y')}}{{$details['intake_info']->intake_no}}</h3>
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
                        var color = '<?php echo $amcourse->color;?>'
                        var date = new Date('<?php echo $amcourse->cdate;?>').getDate()+1;
                        var dates = document.getElementsByTagName('span');
                        for(var i=0; i<dates.length; i++) {
                            if(dates.item(i).innerHTML == date) {
                                dates.item(i).nextElementSibling.append(new Panel(course_id, room_id, color));
                                break;
                            }
                        }
                    </script>
                @endforeach

                @foreach($courses['pm_courses'] as $pmcourse)
                    <script>
                        var course_id = '<?php echo $pmcourse->course_id;?>';
                        var room_id =  '<?php echo $pmcourse->room_id;?>';
                        var color = '<?php echo $pmcourse->color;?>'
                        var date = new Date('<?php echo $pmcourse->cdate;?>').getDate()+1;
                        var dates = document.getElementsByTagName('span');
                        for(var i=0; i<dates.length; i++) {
                            if(dates.item(i).innerHTML == date) {
                                dates.item(i).nextElementSibling.nextElementSibling.append(new Panel(course_id, room_id, color));
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