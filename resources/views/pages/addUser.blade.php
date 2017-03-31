@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-2 sidenav" >
                @include('includes.sidebar')
            </div>

            <div class="col-sm-9">
                <h4><small>Manage Course </small></h4>
                <hr>
                <div class="col-sm-9">
                <form class="form-group" role="form" method="POST" action="{{ url('/addUsers') }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <div class="col-sm-3">
                            <label for="name">Name</label>
                        </div>
                        <div class="col-sm-6">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <br>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <br>
                        <div class="col-sm-3">
                            <label for="email" >E-Mail Address</label>
                        </div>
                        <div class="col-sm-6">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <br>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <br>
                        <div class="col-sm-3">
                        <label for="password" >Password</label>
                        </div>
                        <div class="col-sm-6">
                            <input id="password" type="password"  class="form-control" name="password" required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <br>
                        <div class="col-sm-3">
                            <label for="password-confirm" >Confirm Password</label>
                        </div>
                        <div class="col-sm-6">
                        <input id="password-confirm" type="password"  class="form-control" name="password_confirmation" required>
                        </div>
                    </div>

                    <br>
                    <div class="form-group">
                        <br>
                        <div class="col-sm-9">
                        <label for="usertype" >Select Account Type</label> &nbsp
                        <input type="radio" name="usertype" value="admin" checked > Admin<br>
                        </div>
                    </div>
                    <div class="col-sm-9 form-group">
                        <br>
                        <button type="submit" class="btn btn-primary pull-right">Register</button>
                    </div>
                </form>
            </div>

                <div class="col-sm-9">
                    <hr>
                <h2>Display Admin User</h2>
                <table class="table table-striped table-bordered table-hover table-condensed text-center ">
                    <thead>
                    <tr class = "success">
                        <th class="text-center">Name</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Delete</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($admins as $admin)
                        <tr>
                            <td class="text-center">{{$admin->name}}</td>
                            <td class="text-center">{{$admin->email}}</td>
                            <td class="text-center"><button class="btn btn-danger">Delete</button></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
            </div>

        </div>
    </div>

@endsection
