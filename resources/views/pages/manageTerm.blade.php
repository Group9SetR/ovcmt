@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-2 sidenav" >
                @include('includes.sidebar')
            </div>

            <div class="col-sm-10">
                <div class="row">
                    <div class="col-md-4">

                        <!-- TODO Change id's and names and classes to reflect Terms not course/instructors-->
                        <h4><small>Manage Term </small></h4>
                        <hr>
                        <button href="#addNewTerm" class="btn btn-default" data-toggle="collapse">Add Term</button>
                        <div class="collapse" id="addNewTerm">
                            <h2>Add a New Term</h2>
                            {!! Form::open(['url' => 'manageTerm']) !!}
                            <!--TODO display intakes from available intakes-->
                            <div class="form-group">
                                {!! Form::label('intake_id', 'Intake ID:') !!}
                                <select name="intake_id" class="form-control">
                                    @foreach($intakes as $intake)
                                        <option value="{{$intake->intake_id}}">{{$intake->intake_no}}:{{$intake->start_date}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                {!! Form::label('term_no2', 'Term No:',['class'=>'control-label']) !!}&nbsp;&nbsp;&nbsp;&nbsp;
                                {{ Form::radio('term_no2', 1, false, array('id'=>'modal_termNo_name1', 'required'=>'true')) }}&nbsp 1&nbsp;&nbsp;
                                {{ Form::radio('term_no2', 2, false, array('id'=>'modal_termNo_name2', 'required'=>'true')) }}&nbsp 2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                {{ Form::radio('term_no2', 3, false, array('id'=>'modal_termNo_name3', 'required'=>'true')) }}&nbsp 3&nbsp;&nbsp;&nbsp;
                                {{ Form::radio('term_no2', 4, false, array('id'=>'modal_termNo_name4', 'required'=>'true')) }}&nbsp 4
                            </div>
                            <div class="form-group">
                                {!! Form::label('course_weeks', 'Course Weeks:', ['class'=>'control-label']) !!}
                                {!! Form::number('course_weeks' , null,
                                    ['class'=>'form-control', 'required'=>'required', 'min'=>'0', 'max'=>'50']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('break_weeks', 'Break Weeks:', ['class'=>'control-label']) !!}
                                {!! Form::number('break_weeks' , null,
                                    ['class'=>'form-control' , 'required'=>'required', 'min'=>'0', 'max'=>'10']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('exam_weeks', 'Exam Weeks:', ['class'=>'control-label']) !!}
                                {!! Form::number('exam_weeks' , null,
                                    ['class'=>'form-control', 'required'=>'required', 'min'=>'0', 'max'=>'10']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::submit('Add Term',['class'=> 'btn btn-primary form-control']) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h2>Display Term</h2>
                        <br>
                        <!-- Search bar -->
                        <div class="form-group col-md-7">
                            <div class="input-group">
                                <span class="input-group-addon">Search</span>
                                <input type="text" name="search" id ="search" placeholder="Search Term" class ="form-control">
                            </div>
                        </div>
                        <br><br><br>
                        <hr>
                        <table class="table table-striped table-bordered table-hover table-condensed text-center">
                            <thead class="thead-default">
                            <tr class = "success">
                                <th class="text-center">Id</th>
                                <th class="text-center">Start Date</th>
                                <th class="text-center">Intake</th>
                                <th class="text-center">Term #</th>
                                <th class="text-center">Ttl (wks)</th>
                                <th class="text-center">Crs (wks)</th>
                                <th class="text-center">Exam (wks)</th>
                                <th class="text-center">Break (wks)</th>
                                <th class="text-center">Holidays</th>
                                <th class="text-center">Edit</th>
                                <th class="text-center">Delete</th>
                            </tr>
                            </thead>

                            <tbody class = "searchbody">

                            </tbody>
                        </table>
                        <script type = "text/javascript">
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $('#search').on('keyup',function(){
                                $value = $(this).val();
                                $.ajax ({
                                    type : 'GET',
                                    url  : '/searchTerm',
                                    data: { 'search' : $value },
                                    success: function (data) {
                                        $('.searchbody').html(data);
                                    }
                                });
                            });
                        </script>
                        <script>
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $(document).on('click', '.open-EditTermDialog', function() {
                                //reset modal on open everytime
                                //TODO extract values from table is hella ghetto -- please change in future
                                $('.modal-body input').attr('value', "");
                                var term_id = $(this).parent().siblings(":nth-child(4)").text();
                                var intake_id = $(this).parent().siblings(":nth-child(3)").text();
                                var course_weeks = $(this).parent().siblings(":nth-child(6)").text();
                                var break_weeks = $(this).parent().siblings(":nth-child(8)").text();
                                var exam_weeks = $(this).parent().siblings(":nth-child(7)").text();
                                var term_start_date = $(this).parent().siblings(":nth-child(2)").text();
                                $('.modal-body #modal_term_start_date').attr('value', term_start_date);
                                $('.modal-body #modal_term_id').attr('value', term_id).text();
                                $('.modal-body #modal_intake_id').attr('value', intake_id).text();
                                $('.modal-body #modal_course_weeks').attr('value', course_weeks).text();
                                $('.modal-body #modal_break_weeks').attr('value', break_weeks).text();
                                $('.modal-body #modal_exam_weeks').attr('value', exam_weeks).text();
                            });
                        </script>
                        </table>
                        <!-- TODO edit term functionality -->
                        <div class="modal fade" id="editTermModal" tabindex="-1" role="dialog" aria-labeleledby="editTermModal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="editTermModalLabel">Edit</h4>
                                    </div>
                                    <div class="modal-body">
                                        {!! Form::open(['url' => 'manageTerm']) !!}
                                        <p>Edit Term</p>
                                            <div class="form-group">
                                                {!! Form::label('modal_term_id', 'Term ID:', ['class'=>'control-label']) !!}
                                                {!! Form::text('modal_term_id', '', array('id'=>'modal_term_id',
                                                        'class'=>'form-control', 'readonly'=>'readonly')) !!}
                                            </div>
                                            <div class="form-group">
                                                {!! Form::label('modal_intake_id', 'Intake:', ['class'=>'control-label']) !!}
                                                {!! Form::text('modal_intake_id', '', array('id'=>'modal_intake_id',
                                                        'class'=>'form-control','readonly'=>'readonly'))!!}
                                            </div>
                                            <div class="form-group">
                                                {!! Form::label('modal_term_start_date', 'Term start:', ['class'=>'control-label']) !!}
                                                {!! Form::date('modal_term_start_date', '', array('id'=>'modal_term_start_date',
                                                        'class'=>'form-control')) !!}
                                            </div>
                                            <div class="form-group">
                                                {!! Form::label('modal_course_weeks', 'Course Weeks:', ['class'=>'control-label']) !!}
                                                {!! Form::number('modal_course_weeks', '', ['class'=>'form-control'])!!}
                                            </div>
                                            <div class="form-group">
                                                {!! Form::label('modal_break_weeks', 'Break Weeks:', ['class'=>'control-label']) !!}
                                                {!! Form::number('modal_break_weeks', '', ['class'=>'form-control'])!!}
                                            </div>
                                            <div class="form-group">
                                                {!! Form::label('modal_exam_weeks', 'Exam Weeks:', ['class'=>'control-label']) !!}
                                                {!! Form::number('modal_exam_weeks', '', ['class'=>'form-control'])!!}
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <span class="pull-right">
                                            {!! Form::submit('Edit',['class'=> 'btn btn-primary form-control']) !!}
                                        </span>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
            </div>
        </div>
    </div>



@endsection