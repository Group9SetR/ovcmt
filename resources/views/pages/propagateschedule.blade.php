@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-2 sidenav">
                @include('includes.sidebar')
            </div>
            <div class="col-sm-10">
                <h4><small>Propagate Schedule</small></h4>
                <hr>
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group col-md-10 offset-2" id="propagateform">
                            {{Form::open(['url' => '',
                                          'id' => 'dateSelectForm'])}}
                                {{Form::label('schedule_starting_date', 'Week of:')}}
                                {{Form::date('schedule_starting_date', Carbon\Carbon::today(new DateTimeZone('America/Vancouver'),
                                                                       ['id' => 'schedule_starting_date']))}}
                                {{ Form::submit('Choose Term',['class'=> 'btn btn-primary form-inline']) }}
                            {{Form::close()}}
                        </div>
                                <script>
                                    // update page on submit
                                    $(document).ready(function() {
                                        $('#dateSelectForm').on('submit', function(e) {
                                            e.preventDefault();
                                            var selectedDate = $('#schedule_starting_date').val();
                                            $('#propagateform').empty();
                                            var header = "<h4><small>Week of: " + selectedDate + "</small></h4><hr>";
                                            $('#propagateform').append(header);
                                            $.ajaxSetup({
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                }
                                            });
                                            $.ajax({
                                                type: 'POST',
                                                url: '/getWeeklySchedule',
                                                data: {"selected_date": selectedDate},
                                                dataType: 'json',
                                                success: function (data) {
                                                    console.log(data['roomsbyday']);
                                                    alert("worked");
                                                }
                                            });
                                        });
                                    });
                                </script>
                        <div id='mondayTable' style='visibility: hidden'>
                            <table class='table table-bordered' id='drag_schedule_table'>
                                <tr>
                                    <th class='drag_schedule_row_head'>Room</th>
                                    <th>Mon</th>
                                    <th>Tues</th>
                                    <th>Wed</th>
                                    <th>Thurs</th>
                                    <th>Fri</th>
                                </tr>
                                <tbody>
                                    <tr>
                                        <th>M1-AM</th>
                                        @for($i = 0; $i < 5; $i++)
                                            <td class="M1-am[] drop-timeslot">
                                                {!! Form::hidden('M1-am[]','empty', ['id' => 'm1am' . $i]) !!}
                                            </td>
                                        @endfor
                                    </tr>
                                    <tr>
                                        <th>A1-AM</th>
                                        @for($i = 0; $i < 5; $i++)
                                            <td class="A1-am[] drop-timeslot">
                                                {!! Form::hidden('A1-am[]','empty', ['id' => 'a1am' . $i]) !!}
                                            </td>
                                        @endfor
                                    </tr>
                                    <tr>
                                        <th>P1-AM</th>
                                        @for($i = 0; $i < 5; $i++)
                                            <td class="P1-am[] drop-timeslot">
                                                {!! Form::hidden('P1-am[]','empty', ['id' => 'p1am' . $i]) !!}
                                            </td>
                                        @endfor
                                    </tr>
                                    <tr>
                                        <th>P2-AM</th>
                                        @for($i = 0; $i < 5; $i++)
                                            <td class="P2-am[] drop-timeslot">
                                                {!! Form::hidden('P2-am[]','empty', ['id' => 'p2am' . $i]) !!}
                                            </td>
                                        @endfor
                                    </tr>
                                    <tr > <!--Spacing row-->
                                        <th></th>
                                        @for($i=0; $i<5; $i++)
                                            <td></td>
                                        @endfor
                                    </tr>
                                    <tr>
                                        <th>M1-PM</th>
                                        @for($i = 0; $i < 5; $i++)
                                            <td class="M1-pm[] drop-timeslot">
                                                {!! Form::hidden('M1-pm[]','empty', ['id' => 'm1pm' . $i]) !!}
                                            </td>
                                        @endfor
                                    </tr>
                                    <tr>
                                        <th>A1-PM</th>
                                        @for($i = 0; $i < 5; $i++)
                                            <td class="A1-pm[] drop-timeslot">
                                                {!! Form::hidden('A1-pm[]','empty', ['id' => 'a1pm' . $i]) !!}
                                            </td>
                                        @endfor
                                    </tr>
                                    <tr>
                                        <th>P1-PM</th>
                                        @for($i = 0; $i < 5; $i++)
                                            <td class="P1-pm[] drop-timeslot">
                                                {!! Form::hidden('P1-pm[]','empty', ['id' => 'p1pm' . $i]) !!}
                                            </td>
                                        @endfor
                                    </tr>
                                    <tr>
                                        <th>P2-PM</th>
                                        @for($i = 0; $i < 5; $i++)
                                            <td class="P2-pm[] drop-timeslot">
                                                {!! Form::hidden('P2-pm[]','empty', ['id' => 'p2pm' . $i]) !!}
                                            </td>
                                        @endfor
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div id='numberWeeksPropForm' style="visibility: hidden">
                    {{Form::open(['url'=>'dragDrop'])}}
                        {{Form::label('weeks_to_propagate', 'Number of weeks to propagate:')}}
                        {{Form::number('weeks_to_propagate', '', array('id'=>'weeks_to_propagate',
                                                                        'min'=>1,
                                                                        'max'=>99,
                                                                        'required'=>'true'))}}
                        {!! Form::hidden('monday_start_hidden', '', array('id'=>'monday_start_hidden')) !!}
                        <br>
                        {{Form::submit()}}
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
@endsection