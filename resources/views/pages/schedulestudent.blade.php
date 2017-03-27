@extends('layouts.app')

@section('content')
<<<<<<< HEAD
    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-2 sidenav">
                <br><br>
                <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="{{ url('/schedulestudent') }}" onClick="">Schedule View</a></li>
                </ul><br>
            </div>
            <div class="col-sm-8">
                <h4><small>Welcome</small></h4>
                <hr>
                <h2>News updates</h2>
=======
<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-2 sidenav">
            <h2>Student view</h2><br><br>
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="{{ url('/schedulestudent') }}" onClick="">Schedule View</a></li>
            </ul>
        </div>
        <div class="col-sm-8">
            <h4><small>Add schedule</small></h4>
            <hr>
            <div class="row">
                <div class="col-md-10">
                    <div class="form-group col-md-4">

                    </div>
                    <div class="col-md-10">
                        <h4>Month of: </h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <input type="hidden" name="schedule_date" value=""/>
                    <table class='table table-bordered' id='drag_schedule_table'>
                        <thead>
                        <tr>
                            <th>Week #</th>
                            <th>Time</th>
                            <th>Mon </th>
                            <th>Tues </th>
                            <th>Wed </th>
                            <th>Thurs </th>
                            <th>Fri </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">week 1</th>
                            <td>AM</td>
                            <td>C++ Albert room 2002</td>
                            <td>C++ Albert room 2002</td>
                            <td>C++ Albert room 2002</td>
                            <td>C++ Albert room 2002</td>
                            <td>C++ Albert room 2002</td>
                        </tr>
                        <tr>
                            <th scope="row">week 1</th>
                            <td>PM</td>
                            <td>C++ Albert room 2002</td>
                            <td>C++ Albert room 2002</td>
                            <td>C++ Albert room 2002</td>
                            <td>C++ Albert room 2002</td>
                            <td>C++ Albert room 2002</td>
                        </tr>
                        <tr>
                            <th scope="row">week 2</th>
                            <td>Am</td>
                            <td>C++ Albert room 2002</td>
                            <td>C++ Albert room 2002</td>
                            <td>C++ Albert room 2002</td>
                            <td>C++ Albert room 2002</td>
                        </tr>
                        <tr>
                            <th scope="row">week 2</th>
                            <td>PM</td>
                            <td>C++ Albert room 2002</td>
                            <td>C++ Albert room 2002</td>
                            <td>C++ Albert room 2002</td>
                            <td>C++ Albert room 2002</td>
                        </tr>
                        <tr>
                            <th scope="row">week 3</th>
                            <td>Am</td>
                            <td>C++ Albert room 2002</td>
                            <td>C++ Albert room 2002</td>
                            <td>C++ Albert room 2002</td>
                            <td>C++ Albert room 2002</td>
                        </tr>
                        <tr>
                            <th scope="row">week 3</th>
                            <td>PM</td>
                            <td>C++ Albert room 2002</td>
                            <td>C++ Albert room 2002</td>
                            <td>C++ Albert room 2002</td>
                            <td>C++ Albert room 2002</td>
                        </tr>

                     
                        </tbody>
                    </table>
                </div>

>>>>>>> 47057a61781815b505f418a7d4e017fe7af3c820
            </div>
        </div>
    </div>


@endsection s