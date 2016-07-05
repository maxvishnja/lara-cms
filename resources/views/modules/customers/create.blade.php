@extends('layouts.main')

{{-- Web site Title --}}
@section('title')
    @parent
    @lang('customers.customer-create_title')
@stop

{{-- Content --}}
@section('content')
    <div class="row">
        <div class="col-md-12">
            {!! Form::open(['route' => 'customers.store', 'class' => 'form-horizontal']) !!}

            @include('modules/customers.fieldsForm')

            {!! Form::close() !!}
        </div>
    </div>

@stop
