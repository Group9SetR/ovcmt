@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-2 sidenav">
                @include('includes.sidebar')
            </div>
            <div class="col-md-10">
                @if(isset($status['message']))
                    <h4><small>Propagation succeeded for {{$status['weeks']}} weeks!</small></h4>
                @else
                    <h4><small>Propagation failed on {{$status['date']}}!</small></h4>
                @endif
            </div>
        </div>
    </div>
@endsection
