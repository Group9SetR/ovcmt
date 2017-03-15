@extends('layouts.app')

@section('content')
<script>
    function allowDrop(ev) {
        ev.preventDefault();
    }

    function drag(ev) {
        ev.dataTransfer.setData("text", ev.target.id);
    }

    function drop(ev) {
        ev.preventDefault();
        var data = ev.dataTransfer.getData("text");
        ev.target.appendChild(document.getElementById(data));
    }
</script>

<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-2 sidenav">
            @include('includes.sidebar')
        </div>



        <div class="col-sm-6">
            <h4><small>Edit schedule</small></h4>
            <hr>
            <h2>Placeholder schedule</h2>
            <table>
                <table>
                    <tr>
                        <th>Date</th>
                    </tr>
                    <tr>
                        <td><div id="div1" ondrop="drop(event)" ondragover="allowDrop(event)">To be</div></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                </table>
            </table>
            <br>
            <form action="#somePage.php">
                <button type="submit" class="btn btn-success">Save changes</button>
                <button type="submit" class="btn btn-warning">Undo</button>
                <button type="submit" class="btn btn-warning">Redo</button>
                <button type="submit" class="btn btn-danger">Discard changes</button>
            </form>
        </div>
        <div class="col-sm-4">
            <div id="drag1" draggable="true" ondragstart="drag(event)">Hello</div>
        </div>
    </div>
</div>


@endsection