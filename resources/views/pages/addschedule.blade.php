@extends('layouts.app')
@section('content')

    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-2 sidenav">
                @include('includes.sidebar')
            </div>

            <div class="col-sm-6">
                <h4><small>Select Term</small></h4>
                <hr>
                <h3>Select Term</h3>

                <div class="input-group-btn select" id="select1">
                    <select class="form-control" id="sel1">
                        <option>Term 1</option>
                        <option>Term 2</option>
                        <option>Term 3</option>
                        <option>Term 4</option>
                    </select>
                </div>


                <br><br><br><br><br>
                <div class="btn pull-right">
                <a href="{{ url('/assign') }}" class="btn btn-primary" role="button">Next</a>
                </div>
            </div>




@endsection