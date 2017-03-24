@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-2 sidenav" >
            @include('includes.sidebar')
        </div>
        <div class="col-sm-8">
            <h4><small>Manage Instructors </small></h4>
            <hr>
            <button href="#addNewInstructor" class="btn btn-default" data-toggle="collapse">Add Instructor</button>
            <div class="collapse" id="addNewInstructor">
                <h2>Add a New Instructor</h2>
            {!! Form::open(['url' => 'manageInstructor']) !!}
                    {{csrf_field()}}
                    <div class="form-group">
                    {!! Form::label('first_name', 'First Name:') !!}
                    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                    {!! Form::label('email', 'Email:') !!}
                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                    </div>
                <p>Check all time slots for which instructor is available:</p>
                <div class="form-group">
                    {!! Form::label('date_start', 'Date effective:') !!}
                    {!! Form::date('date_start') !!}
                </div>
                <div class="form-group">
                <table>
                    <tr>
                        <th>Time</th><th>Mon</th><th>Tues</th><th>Wed</th><th>Thurs</th><th>Fri</th>
                    </tr>
                    <tr>
                        <td>Morn</td>
                        <td>{!! Form::checkbox('mon_am') !!}</td>
                        <td>{!! Form::checkbox('tues_am') !!}</td>
                        <td>{!! Form::checkbox('wed_am') !!}</td>
                        <td>{!! Form::checkbox('thurs_am') !!}</td>
                        <td>{!! Form::checkbox('fri_am') !!}</td>

                    </tr>
                    <tr>
                        <td>Aft</td>
                        <td>{!! Form::checkbox('mon_pm') !!}</td>
                        <td>{!! Form::checkbox('tues_pm') !!}</td>
                        <td>{!! Form::checkbox('wed_pm') !!}</td>
                        <td>{!! Form::checkbox('thurs_pm') !!}</td>
                        <td>{!! Form::checkbox('fri_pm') !!}</td>
                    </tr>
                </table>
                </div>

                <div class="form-group">
                    {!! Form::submit('Add instructor',['class'=> 'btn btn-primary form-control']) !!}
                </div>

                {!! Form::close() !!}

            </div> <!-- Close the add instructor div-->


            <hr>
            <button href="#assignInstructor" class="btn btn-default" data-toggle="collapse">Assign instructor</button>
            <div class="collapse" id="assignInstructor">
                <hr>
                <h4><small>Assign an Instructor's Teachable Courses</small></h4>
                {!! Form::open(['url' => 'courseInstructor']) !!}
                <div class="form-group">

                    <select id="instructor_id" name="instructor_id">
                        @foreach($instructors as $instructor)
                            <option value="{{$instructor->instructor_id}}">{{$instructor->first_name}}</option>
                        @endforeach
                    </select>&nbsp

                    <select id="course_id" name="course_id">
                        @foreach($courses as $course)
                            <option name="course_id">{{$course->course_id}}</option>
                        @endforeach
                    </select>

                     &nbsp &nbsp Option A
                    <input type="radio" id = "a" name ="intake_no" value ="A" checked="checked" />

                    &nbsp &nbsp Option B
                    <input type="radio" id = "b" name ="intake_no" value ="B" />
                    &nbsp

                    &nbsp &nbsp TA
                    <input type="radio" id = "ta" name ="instructor_type" value ="0" />
                    |&nbsp &nbsp Instructor
                    <input type="radio" id = "inst" name ="instructor_type" value ="1" checked="checked"/>
                    <br><br>

                    <div class="form-group">
                        {!! Form::submit('Assign course',['class'=> 'btn btn-primary ', 'id'=>'addbtn']) !!}
                        {!! Form::close() !!}
                    </div>
                    <hr>
                </div>
            </div>
            <hr/>


<!-- Display instructor -->
            <h2>Display Instructors</h2><br>
                <div class="form-group col-md-7">
                    <div class="input-group">
                        <span class="input-group-addon">Search</span>
                        <input type="text" name="search" id ="search" placeholder="Search instructor name" class ="form-control">
                    </div>
                </div>
                <br><br><br>
                <hr>
            <table class="table table-striped table-bordered table-hover table-condensed">
                <thead class="thead-default">
                    <tr>
                        <th>ID</th><th>Name</th><th>Date</th>
                        <th>Mon AM</th><th>Tues AM</th><th>Wed AM</th><th>Thur AM</th><th>Fri AM</th>
                        <th>Mon PM</th><th>Tues PM</th><th>Wed PM</th><th>Thur PM</th><th>Fri PM</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>

                </tbody>

              </table>
            <script type = "text/javascript">
                $('#search').on('keyup',function(){
                    $value = $(this).val();
                    $.ajax ({
                        type : 'GET',
                        url  : '/searchInstructor',
                        data: { 'search' : $value },
                        success: function (data) {
                                $('tbody').html(data);
                        }
                    });
                })
            </script>




<!-- end display -->


            <div class="modal fade" id="editInstructorModal" tabindex="-1" role="dialog" aria-labeleledby="editInstructorModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="editInstructorModalLabel">Edit</h4>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(['url' => 'editInstructor']) !!}
                            <p>New Availability</p>
                            <div class="form-group">
                                {!! Form::hidden('modal_instructor_id', '', array('id'=>'modal_instructor_id')) !!}
                                {!! Form::label('modal_instructor_name', 'Instructor:') !!}
                                {!! Form::text('modal_instructor_name', '', array('id'=>'modal_instructor_name'))!!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('modal_instruct_avail_start_date', 'Effective date:') !!}
                                {!! Form::date('modal_instruct_avail_start_date')!!}
                            </div>
                            <div class="form-group">
                                <table>
                                    <tr>
                                        <th>Time</th><th>Mon</th><th>Tues</th><th>Wed</th><th>Thurs</th><th>Fri</th>
                                    </tr>
                                    <tr>
                                        <td>Morn</td>
                                        <td>{!! Form::checkbox('modal_mon_am') !!}</td>
                                        <td>{!! Form::checkbox('modal_tues_am') !!}</td>
                                        <td>{!! Form::checkbox('modal_wed_am') !!}</td>
                                        <td>{!! Form::checkbox('modal_thurs_am') !!}</td>
                                        <td>{!! Form::checkbox('modal_fri_am') !!}</td>
                                    </tr>
                                    <tr>
                                        <td>Aft</td>
                                        <td>{!! Form::checkbox('modal_mon_pm') !!}</td>
                                        <td>{!! Form::checkbox('modal_tues_pm') !!}</td>
                                        <td>{!! Form::checkbox('modal_wed_pm') !!}</td>
                                        <td>{!! Form::checkbox('modal_thurs_pm') !!}</td>
                                        <td>{!! Form::checkbox('modal_fri_pm') !!}</td>
                                    </tr>
                                </table>
                            </div>
                            <div>
                                <h4>Courses this instructor can teach</h4>
                                <div id="courseListing"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <span class="pull-right">
                                {!! Form::submit('Edit',['class'=> 'btn btn-primary form-control']) !!}
                            </span>
                            {!! Form::close() !!}
                        </div>
                        <script>
                            $(document).on('click', '.open-EditInstructorDialog', function() {
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                var instructor_id = $(this).data('id');
                                var instructor_name = $(this).data('name');
                                $('.modal-body #modal_instructor_id').attr('value',instructor_id);
                                $('.modal-body #modal_instructor_name').attr('value',instructor_name);
                                $.ajax({
                                    type: 'POST',
                                    url: '/showInstructorDetails',
                                    data: {"instructor_id": instructor_id},
                                    dataType: 'json',
                                    success: function (data) {
                                        $('#courseListing').empty();
                                        for (let i = 0; i < data['courses'].length; i++) {
                                            var panel = "<div class='panel panel-default'><div class='panel-heading'>" + data['courses'][i]['course_id']
                                                + "</div> <div class='panel-body'>" + "Intake: " + data['courses'][i]['intake_no'] + "</div></div>";
                                            $('#courseListing').append(panel);
                                        }
                                        var avail = data['avail'][0];
                                        $('input[name="modal_instruct_avail_start_date"]').val(avail['date_start']);
                                        $('input:checkbox[name="modal_mon_am"]')
                                            .prop('checked', (avail['mon_am'] == 1) ? true : false);
                                        $('input:checkbox[name="modal_tues_am"]')
                                            .prop('checked', (avail['tues_am'] == 1) ? true : false);
                                        $('input:checkbox[name="modal_wed_am"]')
                                            .prop('checked', (avail['wed_am'] == 1) ? true : false);
                                        $('input:checkbox[name="modal_thurs_am"]')
                                            .prop('checked', (avail['thurs_am'] == 1) ? true : false);
                                        $('input:checkbox[name="modal_fri_am"]')
                                            .prop('checked', (avail['fri_am'] == 1) ? true : false);
                                        $('input:checkbox[name="modal_mon_pm"]')
                                            .prop('checked', (avail['mon_pm'] == 1) ? true : false);
                                        $('input:checkbox[name="modal_tues_pm"]')
                                            .prop('checked', (avail['tues_pm'] == 1) ? true : false);
                                        $('input:checkbox[name="modal_wed_pm"]')
                                            .prop('checked', (avail['wed_pm'] == 1) ? true : false);
                                        $('input:checkbox[name="modal_thurs_pm"]')
                                            .prop('checked', (avail['thurs_pm'] == 1) ? true : false);
                                        $('input:checkbox[name="modal_fri_pm"]')
                                            .prop('checked', (avail['fri_pm'] == 1) ? true : false);
                                    }
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection