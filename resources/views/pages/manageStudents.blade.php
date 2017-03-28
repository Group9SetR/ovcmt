@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-2 sidenav" >
                @include('includes.sidebar')
            </div>

            <div class="col-sm-10">
                <div class="row">
                    <div class="col-md-6">
                        <!-- TODO Change id's and names and classes to reflect Terms not course/instructors-->
                        <h4><small>Manage Student </small></h4>
                        <h2>Display Students</h2>
                        <table class="table table-condensed">
                            <thead>
                            <th>Name</th>
                            <th>Email</th>
                            </thead>
                            <tbody>
                            @foreach($students as $student)
                                <td>{{$student->name}}</td>
                                <td>{{$student->email}}</td>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">


                    </div>
                </div>
            </div>
        </div>



@endsection