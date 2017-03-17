@extends('layouts.app')
@section('content')

    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-2 sidenav">
                @include('includes.sidebar')
            </div>

            <div class="col-sm-6">
                <h4><small>Select Term</small></h4>
                <hr>
                <h3>Select Term</h3>

                <div class="input-group-btn select" id="select1">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="selected">Term 1</span> <span class="caret"></span></button>
                    <ul class="dropdown-menu option" role="menu">
                        <li id="1"><a href="#">Term 1</a></li>
                        <li id="2"><a href="#">Term 2</a></li>
                        <li id="3"><a href="#">Term 3</a></li>
                        <li id="4"><a href="#">Term 4</a></li>
                    </ul>
                </div>

                <script>
                    $('body').on('click','.option li',function(){
                        var i = $(this).parents('.select').attr('id');
                        var v = $(this).children().text();
                        var o = $(this).attr('id');
                        $('#'+i+' .selected').attr('id',o);
                        $('#'+i+' .selected').text(v);
                    });
                </script>
                <br><br><br><br><br>
                <div class="btn pull-right">
                <a href="{{ url('/dragDrop') }}" class="btn btn-primary" role="button">Next</a>
                </div>
            </div>




@endsection