<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'OVCMT') }}</title>
        <!-- Styles -->
        <link href="/css/login.css" rel="stylesheet">
        <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'OVCMT') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
</div>

<!-- Scripts -->
<script src="/js/app.js"></script>

        <div class="container" style="margin-top:80px">
            <div class="row">
                <div class="col-md-6 col-md-5 col-md-offset-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <strong> Sign in </strong>
                        </div>
                        <div class="panel-body">
                            <form role="form" method="POST" action="{{ url('/login') }}">
                                <fieldset>
                                    <div class="row">
                                        <div class="center">
                                            <img class="logo"
                                                 src="logo_ovcmt.png">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-10  col-md-offset-1 ">
                                            <div class="form-group">
                                                <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="glyphicon glyphicon-user"></i>
                                                        </span>
                                                         <input id="email" type="email" placeholder="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                                        @if ($errors->has('email'))
                                                        <span class="help-block">
                                                         <strong>{{ $errors->first('email') }}</strong>
                                                          </span>
                                                        @endif

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="glyphicon glyphicon-lock"></i>
                                                        </span>
                                                    <input id="password" type="password" placeholder="password" class="form-control" name="password" required>

                                                    @if ($errors->has('password'))
                                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                                    @endif

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-lg btn-primary btn-block" value="Log in">


                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>



                        <div class="panel-footer ">
                            Don't have an account! <a href="{{ url('register') }}" onClick=""> Sign Up Here </a>
                        </div>

                        <div class="panel-footer">
                            Forgot Your Password? <a href="{{ url('/password/reset') }}" onclick="">Reset password </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </body>
</html>