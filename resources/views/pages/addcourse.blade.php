@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-2 sidenav">
                @include('includes.sidebar')
            </div>


        <div class="col-sm-9">
            <h4><small>Drag and drop</small></h4>
            <hr>
            <h2>Placeholder schedule</h2>
            <!-- separate divs for drag and drop can go here -->
        </div>
    </div>
</div>


@endsection