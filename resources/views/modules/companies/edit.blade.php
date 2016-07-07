@extends('layouts.main')

{{-- Web site Title --}}
@section('title')
    @parent
    @lang('companies.edit_title')
@stop

{{-- Content --}}
@section('content')

    <div class="row">
        <h4>{{ trans('companies.company-profile') }}</h4>
        <div class="well">
            {!! Form::model($company, ['route' => ['companies.update',  $company->id], 'method' => 'put', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
            <div class="row">
                <div class="col-md-3 text-center">
                    <img src="/{{ $company->avatar }}" alt="{{ $company->name}}" width="200"
                         class="img-circle mb20">

                    <div class="form-group {{ ($errors->has('name')) ? 'has-error' : '' }}" for="first_name">
                        <label class="btn btn-primary btn-file btn-sm">
                            {{ trans('actions.edit-logo') }} <input type="file" name="avatar"
                                                                    style="display: none;">
                        </label>
                    </div>
                </div>

                <div class="col-md-9">
                    @include('modules/companies.fieldsForm')
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>

@stop