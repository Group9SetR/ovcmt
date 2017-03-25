@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-2 sidenav">
                @include('includes.sidebar')
            </div>

            <div class="col-sm-10">
                <div class="row" id="term_selector">
                    <p>Select a Term</p>
                    <div class="form-inline">
                        {!! Form::open(['url' => '', 'class' => 'form-inline', 'id' => 'select_term']) !!}
                        <select name="selected_term_id">
                            @foreach ($terms as $term)
                                <option value={{$term->term_id}}>Term Number:{{$term->term_no}}, Intake Number:{{$term->intake_no}} Start Date:{{$term->term_start_date}} </option>
                            @endforeach
                        </select>
                        {!! Form::submit('Choose Term',['class'=> 'btn btn-primary form-inline']) !!}
                    </div>
                </div>
                <script>
                    $(document).ready(function() {
                        $(document).on('submit', '#select_term', function (e) {
                            event.preventDefault();
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            //var term_id = $('#selected_term_id').val();
                            var term_id = 1;
                            //console.log(term_id);
                            $.ajax({
                                type: 'POST',
                                url: '/getCourseOfferingsByTerm',
                                data: {"term_id": term_id},
                                dataType: 'json',
                                success: function (data) {
                                    alert('success!');
                                    $('#unasscourses').append('success!');
                                }
                            });
                        });
                    });
                </script>
                <div class="row">
                    <div class="col-sm-6" id="unasscourses">
                        <h4><small>Assign Courses to Instructors for the Term</small></h4>
{{--                        @foreach($unassignedcourses as $unassignedcourse)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    {{$unassignedcourse->course_id}}
                                </div>
                                <div class="panel-body">

                                </div>
                            </div>
                        @endforeach--}}
                    </div>
                    <div class="col-sm-6">
                        <h4><small>Edit Assigned Instructors by Course</small></h4>
                        <hr>
        {{--                @foreach($courseinstructors as $ci)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    {{$ci->course_id}}
                                </div>
                                <div class="panel-body">
                                    <b>ID:</b> {{$instructor->instructor_id}} <b>Email:</b> {{$instructor->email}}
                                </div>
                            </div>
                        @endforeach--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection