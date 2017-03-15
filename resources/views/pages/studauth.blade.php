@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-3 sidenav">
            <h2>Student name</h2><br><br>
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="{{ url('/schedulestudent') }}" onClick="">Schedule View</a></li>
            </ul><br>
        </div>
        <div class="col-sm-9">
            <h4><small>Welcome</small></h4>
            <hr>
            <h2>News updates</h2>
        </div>
    </div>
</div>


@endsection