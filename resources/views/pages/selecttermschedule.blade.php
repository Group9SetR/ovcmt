@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-2 sidenav">
                @include('includes.sidebar')
            </div>

            <div class="col-sm-10">
                <h4><small>Propagate Schedule</small></h4>
                <div class="form-inline">
                    {!! Form::open(['url' => '/dragDrop', 'class' => 'form-inline', 'id' => 'select_term']) !!}
                    <select name="selected_term_id" id="selected_term_id">
                        @foreach ($terms as $term)
                            <option value={{$term->term_id}}>Term Number:{{$term->term_no}},
                                Intake Number:{{$term->intake_id}} Start Date:{{$term->term_start_date}} </option>
                        @endforeach
                    </select>
                    {!! Form::submit('Choose Term',['class'=> 'btn btn-primary form-inline']) !!}
                </div>

            </div>
        </div>
    </div>
@endsection