@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-2 sidenav">
            <br><br>
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="{{ url('/schedulestudent') }}" onClick="">Schedule View</a></li>
            </ul>
        </div>
        <div class="col-sm-10">
            <h4><small>Display schedule</small></h4>
            <hr>
            <div>
                {{Form::open(['url' => '',
                                          'id' => 'dateSelectForm'])}}
                {{Form::label('schedule_starting_date', 'Week of:')}}
                {{Form::date('schedule_starting_date', Carbon\Carbon::today(new DateTimeZone('America/Vancouver'),
                                                       ['id' => 'schedule_starting_date']))}}
                {{ Form::submit('Choose Starting Date',['class'=> 'btn btn-primary form-inline']) }}
                {{Form::close()}}
            </div>
            <h3>Display Schedule</h3>
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
                                    <td><span>{{$weeks[$i][$j]}}</span>
                                        <div class="am"></div>
                                        <div class="pm"></div>
                                    </td>
                            @endfor
                        <!-- last row -->
                        @elseif($i == sizeof($weeks)-1)
                            @for($j=0; $j<sizeof($weeks[$i]); $j++)
                                <td><span>{{$weeks[$i][$j]}}</span>
                                    <div class="am"></div>
                                    <div class="pm"></div>
                                </td>
                            @endfor
                            @for($j=0; $j<5-sizeof($weeks[$i]);$j++)
                                <td></td>
                            @endfor
                        @else
                            @for($j=0; $j<5; $j++)
                                <td><span>{{$weeks[$i][$j]}}</span>
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
                        var panel = new Panel('<?php echo $amcourse->course_id;?>', '<?php echo $amcourse->room_id;?>');
                        panel.init();
                        var date = new Date('<?php echo $amcourse->cdate;?>').getDate()+1;
                        var dates = document.getElementsByTagName('span');
                        for(var i=0; i<dates.length; i++) {
                            if(dates.item(i).innerHTML == date) {
                                dates.item(i).parentNode.childNodes[2].append(panel.get());
                                console.log(dates.item(i).parentNode.childNodes[2]);
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