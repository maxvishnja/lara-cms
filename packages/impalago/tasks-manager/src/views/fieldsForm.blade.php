<div class="form-group {{ ($errors->has('name')) ? 'has-error' : '' }}">
    {!! Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => trans('tasks::tasks.form-fields.name')] ) !!}
    @if($errors->has('name'))
        <div class="alert alert-danger ptb5 mt5">{{ $errors->first('name') }}</div>
    @endif
</div>

<div class="form-group {{ ($errors->has('description')) ? 'has-error' : '' }}">
    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => trans('tasks::tasks.form-fields.description')]) !!}
    @if($errors->has('description'))
        <div class="alert alert-danger ptb5 mt5">{{ $errors->first('description') }}</div>
    @endif
</div>


<div class="row">
    <div class="col-md-12">{!! Form::submit(trans('actions.save'), ['class' => 'btn btn-success']) !!}</div>
</div>