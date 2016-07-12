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

        </div>
    </div>

@stop