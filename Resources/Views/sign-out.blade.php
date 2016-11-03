@extends('layouts.master')

@section('head_extra')
    <!-- bootstrap datepicker -->
    <link href="{{ asset("/bower_components/admin-lte/plugins/datepicker/datepicker3.css") }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('reservation::general.page.sign-out.box-title') }}</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">

                    {!! Form::model($item, ['route' => 'reservation.post-sign-out', 'method' => 'POST']) !!}
                    {!! Form::hidden('item_id', $item->id, [ 'id' => 'item_id']) !!}
                    {!! Form::hidden('user_id', Auth::user()->id, [ 'id' => 'user_id']) !!}

                    <div class="form-group">
                            {!! Form::label('name', trans('reservation::general.columns.name')) !!}
                            {!! Form::text('name', null, ['class' => 'form-control', 'readonly']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('description', trans('reservation::general.columns.description')) !!}
                            {!! Form::text('description', null, ['class' => 'form-control', 'readonly']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::submit(trans('reservation::general.button.sign-out'), ['class' => 'btn btn-primary']) !!}
                            <a href="{!! route('reservation.index') !!}" title="{{ trans('general.button.cancel') }}" class='btn btn-default'>{{ trans('general.button.cancel') }}</a>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>{{ trans('reservation::general.columns.user_name') }}</th>
                                    <th>{{ trans('reservation::general.columns.reason') }}</th>
                                    <th>{{ trans('reservation::general.columns.from_date') }}</th>
                                    <th>{{ trans('reservation::general.columns.to_date') }}</th>
                                    <th>{{ trans('reservation::general.columns.return_date') }}</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>{{ trans('reservation::general.columns.user_name') }}</th>
                                    <th>{{ trans('reservation::general.columns.reason') }}</th>
                                    <th>{{ trans('reservation::general.columns.from_date') }}</th>
                                    <th>{{ trans('reservation::general.columns.to_date') }}</th>
                                    <th>{{ trans('reservation::general.columns.return_date') }}</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                    <tr>
                                        <td>{{ Auth::user()->username }}</td>
                                        <td>{!! Form::text('reason', null, ['class' => 'form-control']) !!}</td>
                                        <td>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input name="from_date" type="text" class="form-control pull-right" id="datepickerFrom" placeholder="{{trans('reservation::general.page.sign-out.from_date')}}" readonly="readonly">
                                            </div><!-- /.input group -->
                                        </td>
                                        <td>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input name="to_date" type="text" class="form-control pull-right" id="datepickerTo" placeholder="{{trans('reservation::general.page.sign-out.to_date')}}" readonly="readonly">
                                            </div><!-- /.input group -->
                                        </td>
                                        <td></td>
                                    </tr>
                                    @foreach($item->reservations as $res)
                                        <tr>
                                            <td>{{ $res->user->username }}</td>
                                            <td>{{ $res->reason }}</td>
                                            <td>{{ date('Y-m-d', strtotime($res->from_date)) }}</td>
                                            <td>{{ date('Y-m-d', strtotime($res->to_date)) }}</td>
                                            <td>{{ ($res->return_date)?date('Y-m-d', strtotime($res->return_date)):'' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- table-responsive -->

                    {!! Form::close() !!}


                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div><!-- /.row -->
@endsection


<!-- Optional bottom section for modals etc... -->
@section('body_bottom')
    <!-- bootstrap datepicker -->
    <script src="{{ asset ("/bower_components/admin-lte/plugins/datepicker/bootstrap-datepicker.js") }}" type="text/javascript"></script>


    <script>
        $(function () {
            //Date picker
            $('#datepickerFrom').datepicker({
                autoclose: true,
                format: 'yyyy/mm/dd',
                todayHighlight: true
            });
            $('#datepickerTo').datepicker({
                autoclose: true,
                format: 'yyyy/mm/dd',
                todayHighlight: true
            });
        });
    </script>



@endsection
