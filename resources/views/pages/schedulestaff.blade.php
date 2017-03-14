@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-3 sidenav">
            <h2>Staff Name</h2><br><br>
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="{{ url('/schedulestaff') }}" onClick="">Schedule View</a></li>
            </ul>
        </div>

        <div class="col-sm-9">
            <h4><small>Schedule Download</small></h4>
            <hr>
            <h2>Download Schedule</h2>
            <table>
                <table>
                    <tr>
                        <th>Date</th>
                        <th>Monday</th>
                        <th>Tuesday</th>
                        <th>Wednesday</th>
                        <th>Thursday</th>
                        <th>Friday</th>
                    </tr>
                    <tr>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                    </tr>
                </table>
            </table>
            <br>
            <form action="#somePage.php">
                <button type="submit">Download</button>
            </form>
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