@extends('layouts.main')

{{-- Web site Title --}}
@section('title')
    @parent
    @lang('companies.companies-create_title')
@stop

{{-- Content --}}
@section('content')
    <div class="row">
        <div class="col-md-12">
            {!! Form::open(['route' => 'companies.store', 'class' => 'form-horizontal']) !!}

            @include('modules/companies.fieldsForm')

            {!! Form::close() !!}
        </div>
    </div>

@stop
