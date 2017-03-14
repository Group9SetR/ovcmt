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

<footer class="container-fluid">
    <div>
        <a id="footerLinks" target="_blank" href="http://www.ovcmt.com/index.php">Home</a> -
        <a id="footerLinks" target="_blank" href="http://www.ovcmt.com/index.php/about">About</a> -
        <a id="footerLinks" target="_blank" href="http://www.ovcmt.com/index.php/apply/request-information-application">Apply</a> -
        <a id="footerLinks" target="_blank" href="http://www.ovcmt.com/index.php/alumni">Alumni</a> -
        <a id="footerLinks" target="_blank" href="http://www.ovcmt.com/index.php/clinic">Clinic</a> -
        <a id="footerLinks" target="_blank" href="http://www.ovcmt.com/index.php/shopl">Shop</a> -
        <a id="footerLinks" target="_blank" href="http://www.ovcmt.com/index.php/about/location-contact-info">Contact</a>
    </div>
</footer>
@endsection