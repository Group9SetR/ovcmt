@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-2 sidenav">
                @include('includes.sidebar')
            </div>


            <div class="col-sm-9">
                <h4><small>Add schedule</small></h4>
                <hr>
                <h2>Display schedule</h2>
                <form action="#somePage.php">
                    <button type="submit">Upload</button>
                    <button type="submit">Delete</button>
                </form>
            </div>
        </div>
    </div>


@endsection