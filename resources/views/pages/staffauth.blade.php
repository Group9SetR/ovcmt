@extends('layouts.app')

@section('title')
    <title>asdfaskdfasj</title>
@stop
@section('content')
<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-3 sidenav">
            <h2>Staff name</h2><br><br>
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="{{ url('/schedulestaff') }}" onClick="">Schedule View</a></li>
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