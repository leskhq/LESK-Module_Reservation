@extends('layouts.master')

@section('head_extra')
    <!-- Tags css -->
    @include('partials._head_extra_tags_css')

    <!-- Resize the tag input field in the toolbar -->
    <style>
        #header-box .bootstrap-tagsinput {
            width:50% !important;
        }
    </style>

    <!-- Make the tag input field in the main table
         read-only and the border of the
         surrounding div invisible. -->
    <style>
        #items-table .bootstrap-tagsinput {
            border:hidden !important;
        }
        #items-table .bootstrap-tagsinput input{
            visibility:hidden !important;
        }
        #items-table .bootstrap-tagsinput > span > span{
            display:none !important;
        }
    </style>
@endsection

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            {!! Form::open( array('route' => 'reservation.search', 'id' => 'frmSearch') ) !!}
                <div class="box box-primary">
                    <div id="header-box" class="box-header with-border">
                        <h3 class="box-title">{{ trans('reservation::general.page.index.box-title') }}</h3>
                        &nbsp;
                        @permission('reservation.create-item')
                        <a class="btn btn-default btn-sm" href="{!! route('reservation.create') !!}" title="{{ trans('reservation::general.button.item.create') }}">
                                <i class="fa fa-plus-square"></i>
                            </a>
                        @endpermission
                            {!! Form::text('txtTagFilter', $tagFilter, [ 'placeholder' => 'Enter tag filter', 'style' => 'max-width:150px;', 'id' => 'txtTagFilter', 'data-role' => 'tagsinput']) !!}
                            <a class="btn btn-default btn-sm" href="#" onclick="document.forms['frmSearch'].action = '{{ route('reservation.search') }}';  document.forms['frmSearch'].submit(); return false;" title="{{ trans('reservation::general.action.tag-filter') }}">
                                <i class="fa fa-search"></i>
                            </a>
                        &nbsp;
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>

                    <div class="box-body">

                        <div class="table-responsive">
                            <table id="items-table" class="table table-hover">
                                <thead>
                                <tr>
                                    <th>{{ trans('reservation::general.columns.available') }}</th>
                                    <th>{{ trans('reservation::general.columns.name') }}</th>
                                    <th width="30%">{{ trans('reservation::general.columns.description') }}</th>
                                    <th width="30%">{{ trans('reservation::general.columns.tags') }}</th>
                                    <th>{{ trans('reservation::general.columns.user_name') }}</th>
                                    <th>{{ trans('reservation::general.columns.return_date') }}</th>
                                    <th>{{ trans('reservation::general.columns.actions') }}</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>{{ trans('reservation::general.columns.available') }}</th>
                                    <th>{{ trans('reservation::general.columns.name') }}</th>
                                    <th>{{ trans('reservation::general.columns.description') }}</th>
                                    <th>{{ trans('reservation::general.columns.tags') }}</th>
                                    <th>{{ trans('reservation::general.columns.user_name') }}</th>
                                    <th>{{ trans('reservation::general.columns.return_date') }}</th>
                                    <th>{{ trans('reservation::general.columns.actions') }}</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($items as $item)
                                    <tr>
                                        <td>
                                        @if ( $item->available )
                                                <i class="fa fa-circle fa-colour-green" title="{{ trans('reservation::general.status.available') }}"></i>
                                            @else
                                                <i class="fa fa-times fa-colour-orange" title="{{ trans('reservation::general.status.unavailable') }}"></i>
                                            @endif
                                        </td>
                                        <td>{!! link_to_route('reservation.show', $item->name, [$item->id], []) !!}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>
                                            <input data-role="tagsinput" name="tags" type="text" value="{{ implode(",", $item->tagNames()) }}">
                                        </td>

                                    @if ( $item->available )
                                            <td></td>
                                            <td>
                                            </td>
                                        @else
                                            <td>
                                                {{ $item->latest_reservation()->user->username }}
                                            </td>
                                            <td>
                                                {{ $item->latest_reservation()->to_date->toDateString() }}
                                            </td>
                                        @endif

                                        <td>
                                        @if ( $item->available )
                                                @permission('reservation.sign-out')
                                                <a href="{!! route('reservation.sign-out', $item->id) !!}" title="{{ trans('reservation::general.button.sign-out') }}"><i class="fa fa-sign-out fa-colour-green"></i></a>
                                                @endpermission
                                            @else
                                                @permission('reservation.sign-in')
                                                <a href="{!! route('reservation.confirm-sign-in', $item->id) !!}" data-toggle="modal" data-target="#modal_dialog" title="{{ trans('reservation::general.button.sign-in') }}"><i class="fa fa-sign-in fa-colour-blue"></i></a>
                                                @endpermission
                                            @endif

                                            @permission('reservation.edit-item')
                                            <a href="{!! route('reservation.edit', $item->id) !!}" title="{{ trans('general.button.edit') }}"><i class="fa fa-pencil-square-o"></i></a>
                                            @endpermission


                                            @permission('reservation.delete-item')
                                            <a href="{!! route('reservation.confirm-delete-item', $item->id) !!}" data-toggle="modal" data-target="#modal_dialog" title="{{ trans('general.button.delete') }}"><i class="fa fa-trash-o deletable"></i></a>
                                            @endpermission
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {!! $items->render() !!}
                        </div> <!-- table-responsive -->

                    </div><!-- /.box-body -->

                </div><!-- /.box -->
            {!! Form::close() !!}
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection


<!-- Optional bottom section for modals etc... -->
@section('body_bottom')
    <!-- Tags css -->
    @include('partials._body_bottom_tags_js')

    <script>
        var tagNames = new Bloodhound({
            initialize: false,
            local: [{!! $tagNames !!}],
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            datumTokenizer: Bloodhound.tokenizers.whitespace
        });

        var tagNamesInit = tagNames.initialize();

        $("input[data-role='tagsinput']").tagsinput({
            typeaheadjs: ({
                hint: true,
                highlight: true,
                minLength: 1
            },
                {
                    source: tagNames
                })
        });
    </script>

@endsection
