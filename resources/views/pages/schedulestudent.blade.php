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
        <div class="col-sm-9">
            <h4><small>Display schedule</small></h4>
            <hr>
            <button id="exportpdf" class="btn btn-lg btn-danger clearfix" onclick="javascript:callme();" >
                <span class="fa fa-file-pdf-o"></span> Save as PDF</button>

            <h3>Select Month</h3>
            <hr>

                <div class="col-md-10" >
                    <table class='table table-bordered' id ="yourTableIdName" >
                        <colgroup>
                            <col width="10%">
                            <col width="10%">
                            <col width="10%">
                            <col width="10%">
                            <col width="10%">
                            <col width="10%">
                            <col width="10%">
                            <col width="10%">
                        </colgroup>
                        <thead>
                        <tr class = "success">
                            <th>Week</th>
                            <th>Time</th>
                            <th>Monday </th>
                            <th>Tuesday </th>
                            <th>Wednesday </th>
                            <th>Thursday </th>
                            <th>Friday </th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr >
                            <th rowspan="1"> Week1 </th>
                            <td>AM</td>
                            <td>C++ Albert </td>
                            <td>C++ Albert </td>
                            <td>C++ Albert </td>
                            <td>C++ Albert </td>
                            <td>C++ Albert </td>
                        </tr>
                        <tr>
                            <th rowspan="1"> Week1 </th>
                            <td>PM</td>
                            <td>C++ Albert </td>
                            <td>C++ Albert </td>
                            <td>C++ Albert </td>
                            <td>C++ Albert </td>
                            <td>C++ Albert </td>
                        </tr>
                        <tr>
                            <th rowspan="1"> Week2 </th>
                            <td>PM</td>
                            <td>C++ Albert </td>
                            <td>C++ Albert </td>
                            <td>C++ Albert </td>
                            <td>C++ Albert </td>
                            <td>C++ Albert </td>

                        </tr>
                        <tr>
                            <th rowspan="1"> Week2 </th>
                            <td>PM</td>
                            <td>C++ Albert </td>
                            <td>C++ Albert </td>
                            <td>C++ Albert </td>
                            <td>C++ Albert </td>
                            <td>C++ Albert </td>

                        </tr>
                        <tr>
                            <th rowspan="1"> Week3 </th>
                            <td>PM</td>
                            <td>C++ Albert </td>
                            <td>C++ Albert </td>
                            <td>C++ Albert </td>
                            <td>C++ Albert </td>
                            <td>C++ Albert </td>
                        </tr>
                        <tr>
                            <th rowspan="1"> Week3 </th>
                            <td>PM</td>
                            <td>C++ Albert </td>
                            <td>C++ Albert </td>
                            <td>C++ Albert </td>
                            <td>C++ Albert </td>
                            <td>C++ Albert </td>
                        </tr>
                        <tr>
                            <th rowspan="1"> Week4 </th>
                            <td>PM</td>
                            <td>C++ Albert </td>
                            <td>C++ Albert </td>
                            <td>C++ Albert </td>
                            <td>C++ Albert </td>
                            <td>C++ Albert </td>
                        </tr>
                        <tr>
                            <th rowspan="1"> Week4 </th>
                            <td>PM</td>
                            <td>C++ Albert </td>
                            <td>C++ Albert </td>
                            <td>C++ Albert </td>
                            <td>C++ Albert </td>
                            <td>C++ Albert </td>
                        </tr>
                        </tbody>
                    </table>
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
        </div>
    </div>


@endsection s