@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-2 sidenav">
                @include('includes.sidebar')
            </div>

            <div class="col-sm-10">
                <h4><small>Generate Schedule</small></h4>
                <div class="form-inline">
                    {!! Form::open(['url' => '/dragDrop', 'class' => 'form-inline', 'id' => 'select_term']) !!}
                    <select name="selected_term_id" id="selected_term_id" class="form-control">
                        @foreach ($terms as $term)
                            <option value="{{$term->term_id}}">
                                {{$term->intake_no}}{{DateTime::createFromFormat('Y-m-d', $term->program_start)->format('Y')}}
                                Term {{$term->term_no}} Start:{{$term->term_start_date}} </option>
                        @endforeach
                    </select>
                    {!! Form::submit('Choose Term',['class'=> 'btn btn-primary form-inline']) !!}
                </div>

            </div>
        </div>
    </div>
@endsection