<div class="form-group">
    {!! Form::label('name', trans('reservation::general.columns.name')) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', trans('reservation::general.columns.description')) !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

