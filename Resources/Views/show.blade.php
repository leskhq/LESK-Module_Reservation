@extends('layouts.master')

@section('head_extra')
@endsection

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('reservation::general.page.show.box-title') }}</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">

                    {!! Form::model($item, ['route' => 'reservation.index', 'method' => 'GET']) !!}

                        <div class="form-group">
                            {!! Form::label('name', trans('reservation::general.columns.name')) !!}
                            {!! Form::text('name', null, ['class' => 'form-control', 'readonly']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('description', trans('reservation::general.columns.description')) !!}
                            {!! Form::text('description', null, ['class' => 'form-control', 'readonly']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::submit(trans('general.button.close'), ['class' => 'btn btn-primary']) !!}
                            @permission('reservation.edit-item')
                                <a href="{!! route('reservation.edit', $item->id) !!}" title="{{ trans('general.button.edit') }}" class='btn btn-default'>{{ trans('general.button.edit') }}</a>
                            @endpermission
                            @if ( $item->available )
                                @permission('reservation.sign-out')
                                    <a href="{!! route('reservation.sign-out', $item->id) !!}" title="{{ trans('reservation::general.button.sign-out') }}" class='btn btn-default'><i class="fa fa-sign-out fa-colour-green"></i>&nbsp;{{ trans('reservation::general.button.sign-out') }}</a>
                                @endpermission
                            @else
                                @permission('reservation.sign-in')
                                    <a href="{!! route('reservation.sign-in', $item->id) !!}" title="{{ trans('reservation::general.button.sign-in') }}" class='btn btn-default'><i class="fa fa-sign-in fa-colour-blue"></i>&nbsp;{{ trans('reservation::general.button.sign-in') }}</a>
                                @endpermission
                            @endif
                        </div>

                    {!! Form::close() !!}

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

                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div><!-- /.row -->
@endsection


<!-- Optional bottom section for modals etc... -->
@section('body_bottom')
@endsection
