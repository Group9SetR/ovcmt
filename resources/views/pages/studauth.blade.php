@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-2 sidenav">
            <br><br>
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="{{ url('/selectschedulestudent') }}" onClick="">Schedule View</a></li>
            </ul><br>
        </div>
        <div class="col-sm-8">
            <h4><small>Welcome</small></h4>
            <hr>
            <h2>News updates</h2>
        </div>
    </div>
</div>


@endsection