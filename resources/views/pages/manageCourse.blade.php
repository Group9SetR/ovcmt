@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-2 sidenav">
                @include('includes.sidebar')
            </div>

        <div class="col-sm-8">
            <h4><small>Manage Course </small></h4>
            <hr>
            <button href="#addNewCourse" class="btn btn-default" data-toggle="collapse">Add Course</button>
            <div class="collapse" id="addNewCourse">
                <h2>Add a New Course</h2>

                {!! Form::open(['url' => 'manageCourseStore']) !!}
                <div class="form-group">
                    {!! Form::label('course_id2', 'Course Id:') !!}
                    {!! Form::text('course_id2', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('sessions_days2', 'Session Days:') !!}
                    {!! Form::number('sessions_days2', '', array('id'=>'modal_sessionDays_name',
                                                                                    'class'=>'form-control',
                                                                                    'min'=>1,
                                                                                    'max'=>99))!!}
                </div>

                <div class="form-group">
                    {!! Form::label('course_type2', 'Course Type:') !!}
                    {{ Form::select('course_type2', ['Academic'=>'Academic', 'Practical'=>'Practical'], null, array('id'=>'modal_courseType_name',
                                                                                                                                        'class'=>'form-control')) }}
                </div>

                <div class="form-group">
                    {!! Form::label('term_no2', 'Term No:') !!}
                    {{ Form::radio('term_no2', 1, false, array('id'=>'modal_termNo_name1')) }}1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    {{ Form::radio('term_no2', 2, false, array('id'=>'modal_termNo_name2')) }}2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    {{ Form::radio('term_no2', 3, false, array('id'=>'modal_termNo_name3')) }}3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    {{ Form::radio('term_no2', 4, false, array('id'=>'modal_termNo_name4')) }}4
                </div>

                <div class="form-group">
                    {!! Form::submit('Add course',['class'=> 'btn btn-primary form-control']) !!}
                </div>
                {!! Form::close() !!}
            </div>
            <hr/>
            <h2>Display Courses</h2>
            <table id="myTable" class="table table-striped table-bordered table-hover table-condensed text-center">
                <thead class="thead-default">
                    <th class="text-center">Course Id</th>
                    <th class="text-center">Sessions Days</th>
                    <th class="text-center">Course Type</th>
                    <th class="text-center">Term No</th>
                    <th class="text-center">Edit Course</th>
                </thead>
                <tbody>
                @foreach($courses as $course)
                    <tr>
                        <td>{{$course->course_id}}</td>
                        <td>{{$course->sessions_days}}</td>
                        <td>{{$course->course_type}}</td>
                        <td>{{$course->term_no}}</td>
                        <td>
                            <button class="btn btn-primary open-EditCourseDialog"
                                    data-toggle="modal"
                                    data-courseid="{{$course->course_id}}"
                                    data-sessiondays="{{$course->sessions_days}}"
                                    data-coursetype="{{$course->course_type}}"
                                    data-termno="{{$course->term_no}}"
                                    data-target="#editCourseModal"
                            >Edit</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="modal fade" id="editCourseModal" tabindex="-1" role="dialog" aria-labeleledby="editCourseModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="editCourseModalLabel">Edit Individual Course</h4>
                        </div>

                        {!! Form::open(['url' => 'updateCourse']) !!}
                        <div class="modal-body">
                            <div class="form-group">
                                <table class="table table-bordered table-condensed">
                                    <tr class="active">
                                        <td>{!! Form::label('course_id', 'Course Id') !!}</td>
                                        <td>{!! Form::text('course_id', '', array('id'=>'modal_courseid_name',
                                                                                'class'=>'form-control',
                                                                                'readonly'=>'readonly'))!!}</td>
                                    </tr>
                                    <tr>
                                        <td>{!! Form::label('sessions_days', 'Session Days') !!}</td>
                                        <td>{!! Form::number('sessions_days', '', array('id'=>'modal_sessionDays_name',
                                                                                    'class'=>'form-control',
                                                                                    'min'=>1,
                                                                                    'max'=>99))!!}</td>
                                    </tr>
                                    <tr>
                                        <td>{!! Form::label('course_type', 'Course Type') !!}</td>
                                        <td>{{ Form::select('course_type', ['Academic'=>'Academic', 'Practical'=>'Practical'], null, array('id'=>'modal_courseType_name',
                                                                                                                                        'class'=>'form-control')) }}</td>
                                    </tr>
                                    <tr>
                                        <td>{!! Form::label('term_no', 'Term No') !!}</td>
                                        <td>{{ Form::radio('term_no', 1, false, array('id'=>'modal_termNo_name1')) }}1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            {{ Form::radio('term_no', 2, false, array('id'=>'modal_termNo_name2')) }}2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            {{ Form::radio('term_no', 3, false, array('id'=>'modal_termNo_name3')) }}3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            {{ Form::radio('term_no', 4, false, array('id'=>'modal_termNo_name4')) }}4
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="closeEditCourseBtn" class="btn btn-warning" data-dismiss="modal">Close</button>
                            {!! Form::submit('Save',['class'=> 'btn btn-primary form-control', 'id' => 'editCourseBtn']) !!}
                        </div>
                        {!! Form::close() !!}

                        <script>
                            $(document).on('click', '.open-EditCourseDialog', function() {
                                var course_id = $(this).data('courseid');
                                var session_days = $(this).data('sessiondays');
                                var course_type = $(this).data('coursetype');
                                var term_no = $(this).data('termno');
                                $('.modal-body #modal_courseid_name').attr('value', course_id);
                                $('.modal-body #modal_sessionDays_name').attr('value', session_days);
                                $('.modal-body #modal_courseType_name').val(course_type);
                                if (term_no == 1) {
                                    $('.modal-body #modal_termNo_name1').attr('checked', 'checked');
                                } else if (term_no == 2) {
                                    $('.modal-body #modal_termNo_name2').attr('checked', 'checked');
                                } else if (term_no == 3) {
                                    $('.modal-body #modal_termNo_name3').attr('checked', 'checked');
                                } else {
                                    // value is none other than 4 folks
                                    $('.modal-body #modal_termNo_name4').attr('checked', 'checked');
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection