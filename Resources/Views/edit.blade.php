@extends('layouts.master')

@section('head_extra')
    <!-- Tags css -->
    @include('partials._head_extra_tags_css')
@endsection

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('reservation::general.page.edit.box-title') }}</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">

                    {!! Form::model( $item, ['route' => ['reservation.patch', $item->id], 'method' => 'PATCH'] ) !!}

                    @include('reservation::_item_form')

                    <div class="form-group">
                        {!! Form::submit( trans('general.button.update'), ['class' => 'btn btn-primary'] ) !!}
                        <a href="{!! route('reservation.index') !!}" title="{{ trans('general.button.cancel') }}" class='btn btn-default'>{{ trans('general.button.cancel') }}</a>
                    </div>

                    {!! Form::close() !!}

                </div><!-- /.box-body -->
            </div><!-- /.box -->
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
