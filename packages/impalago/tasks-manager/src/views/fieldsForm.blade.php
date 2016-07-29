<div class="form-group">
    {!! Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => trans('tasks::tasks.form-fields.name')] ) !!}
</div>

<div class="form-group">
    {!! Form::select('company_id', $companies->lists('name', 'id'), null, [
        'class' => 'form-control',
        'placeholder' => trans('tasks::tasks.form-fields.company')
    ]) !!}
</div>

<div class="form-group">
    {!! Form::select('responsible[]', $users, null, [
        'class' => 'form-control select-multiple',
        'multiple' => 'multiple'
    ]) !!}
</div>

<div class="form-group">
    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => trans('tasks::tasks.form-fields.description')]) !!}
</div>

<h4 class="mt20">Дополнительно</h4>
<hr>

<div class="form-group">
    {!! Form::label('deadline', trans('tasks::tasks.form-fields.deadline'), ['class' => 'control-label']) !!}
    {!! Form::text('deadline', null, ['class' => 'form-control'] ) !!}
</div>

<div class="form-group">
    {!! Form::label('priority', trans('tasks::tasks.form-fields.priority'), ['class' => 'control-label']) !!}
    {!! Form::select('priority', config('tasks.priority_task'), null, [
    'class' => 'form-control'
    ]) !!}
</div>

<div class="row">
    <div class="col-md-12">{!! Form::submit(trans('actions.save'), ['class' => 'btn btn-success']) !!}</div>
</div>