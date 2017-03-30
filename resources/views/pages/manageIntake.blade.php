@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-2 sidenav" >
                @include('includes.sidebar')
            </div>

            <div class="col-sm-10">
                <div class="row">
                    <div class="col-md-4">
                        <h4><small>Manage Intake </small></h4>
                        <hr>
                        <button href="#addNewIntake" class="btn btn-default" data-toggle="collapse">Add Intake</button>
                        <div class="collapse" id="addNewIntake">
                            <h2>Add a New Intake</h2>

                            {!! Form::open(['url' => 'manageIntake', 'id' => 'addIntakeForm']) !!}

                            <div class="form-group">
                                {!! Form::label('start_date', 'Program start (September or January only):', ['class'=>'control-label']) !!}
                                {!! Form::date('start_date', null, ['class'=>'form-control', 'required'=>'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::submit('Add Intake',['class'=> 'btn btn-primary form-control']) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                        <hr>

                    </div>
                    <div class="col-md-8">
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                            <th>ID</th>
                            <th>Program Start</th>
                            <th>Intake</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            </thead>
                            <tbody>
                            @foreach($intakes as $intake)
                                <tr>
                                    <th>{{$intake->intake_id}}</th>
                                    <td>{{$intake->start_date}}</td>
                                    <td>{{$intake->intake_no}}</td>
                                    <td><button class="btn btn-primary open-EditIntakeDialog"
                                            data-toggle="modal"
                                            data-id="{{$intake->intake_id}}"
                                            data-target="#editIntakeModal"
                                            data-start_date = "{{$intake->start_date}}"
                                            data-intake_no="{{$intake->intake_no}}">Edit</button></td>
                                    <td><button class="btn btn-danger">Delete</button></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="modal fade" id="editIntakeModal" tabindex="-1" role="dialog" aria-labeleledby="editIntakeModal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="editIntakeModalLabel">Edit</h4>
                                    </div>
                                    <div class="modal-body">
                                        {{ Form::open(['url' => 'updateIntake']) }}
                                        <p>Edit Intake</p>
                                        <div class="form-group">
                                            {!! Form::label('modal_intake_id', 'Intake ID:', ['class'=>'control-label']) !!}
                                            {!! Form::number('modal_intake_id', '', array('id'=>'modal_intake_id',
                                                    'class'=>'form-control', 'readonly'=>'readonly')) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('modal_start_date', 'Program start:', ['class'=>'control-label']) !!}
                                            {!! Form::date('modal_start_date', '', array('id'=>'modal_start_date',
                                                    'class'=>'form-control')) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('modal_intake_no', 'Intake No:', ['class'=>'control-label']) !!}
                                            {!! Form::text('modal_intake_no', '', ['class'=>'form-control', 'readonly'=>'readonly'])!!}
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <span class="pull-right">
                                            {!! Form::submit('Edit',['class'=> 'btn btn-primary form-control']) !!}
                                        </span>
                                    </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
                        </div>
                        <script>
                            $(document).on('click', '.open-EditIntakeDialog', function() {
                                //reset modal on open everytime
                                //TODO extract values from table is hella ghetto -- please change in future
                                $('.modal-body #modal_start_date').attr('value', '');
                                $('.modal-body #modal_intake_id').attr('value', '');
                                $('.modal-body #modal_intake_no').attr('value', '');
                                $('.modal-body #modal_start_date').attr('value', $(this).data('start_date'));
                                $('.modal-body #modal_intake_id').attr('value', $(this).data('id')).text();
                                $('.modal-body #modal_intake_no').attr('value', $(this).data('intake_no')).text();
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection