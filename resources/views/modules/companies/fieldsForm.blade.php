<div class="form-group">
    {!! Form::label('type_id', trans('companies.type_company'), ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('type_id', config('company.types_of_companies'), null, [
            'class' => 'form-control'
        ]) !!}
    </div>
</div>

<div class="form-group {{ ($errors->has('name')) ? 'has-error' : '' }}">
    {!! Form::label('name', trans('companies.field-name'), ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('name', null, ['class' => 'form-control', 'required'] ) !!}
        @if($errors->has('name'))
            <div class="alert alert-danger ptb5 mt5">{{ $errors->first('name') }}</div>
        @endif
    </div>
</div>

<div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' }}">
    {!! Form::label('email', trans('users.user-field-email'), ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('email', null, ['class' => 'form-control'] ) !!}
        @if($errors->has('email'))
            <div class="alert alert-danger ptb5 mt5">{{ $errors->first('email') }}</div>
        @endif
    </div>
</div>

<div class="form-group {{ ($errors->has('phone')) ? 'has-error' : '' }}">
    {!! Form::label('phone', trans('companies.field-phone'), ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('phone', null, ['class' => 'form-control']) !!}
        @if($errors->has('phone'))
            <div class="alert alert-danger ptb5 mt5">{{ $errors->first('phone') }}</div>
        @endif
    </div>
</div>

<div class="form-group {{ ($errors->has('skype')) ? 'has-error' : '' }}">
    {!! Form::label('skype', trans('companies.field-skype'), ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('skype', null, ['class' => 'form-control']) !!}
        @if($errors->has('skype'))
            <div class="alert alert-danger ptb5 mt5">{{ $errors->first('phone') }}</div>
        @endif
    </div>
</div>

<div class="form-group {{ ($errors->has('date_of_contract')) ? 'has-error' : '' }}">
    {!! Form::label('date_of_contract', trans('companies.company-date_of_contract'), ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('date_of_contract', null, ['class' => 'datepicker form-control']) !!}
        {{ ($errors->has('date_of_contract') ? $errors->first('date_of_contract') : '') }}
    </div>
</div>

<div class="form-group {{ ($errors->has('discount')) ? 'has-error' : '' }}">
    {!! Form::label('discount', trans('companies.companies-discount'), ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('discount', null, ['class' => 'form-control']) !!}
        {{ ($errors->has('discount') ? $errors->first('discount') : '') }}
    </div>
</div>

<div class="form-group {{ ($errors->has('description')) ? 'has-error' : '' }}">
    {!! Form::label('description', trans('companies.user-description'), ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3]) !!}
        {{ ($errors->has('description') ? $errors->first('description') : '') }}
    </div>
</div>

<div class="form-group">
    {!! Form::label('manager', trans('companies.field-manager'), ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('manager', $managers, null, [
            'class' => 'form-control'
        ]) !!}
    </div>
</div>

<div class="row text-right">
    <div class="col-md-12">{!! Form::submit(trans('actions.save'), ['class' => 'btn btn-success']) !!}</div>
</div>