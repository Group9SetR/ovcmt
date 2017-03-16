@extends('layouts.app')
@section('content')

    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-2 sidenav">
                @include('includes.sidebar')
            </div>



            <div class="col-sm-9">
                <h4><small>Create</small></h4>
                <hr>
                <h3>Select Term</h3>

                <br>
                <a href="{{ url('/dragDrop') }}" onClick="">NEXT</a>
            </div>




@endsection