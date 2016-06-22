@extends('layouts.main')

{{-- Web site Title --}}
@section('title')
    @parent
    @lang('users.page_group-show_title')
@stop

{{-- Content --}}
@section('content')
    <h3>{{ $group['name'] }}</h3>
    <div class="well clearfix">
        <div class="col-md-10">
            <strong>{{ trans('users.group-field-permissions') }}:</strong>
            <ul>
                @foreach ($group->getPermissions() as $key => $value)
                    <li>{{ ucfirst($key) }}</li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-2">
            <a class="btn btn-primary" href="{{ route('sentinel.groups.edit', array($group->hash)) }}">{{ trans('actions.edit') }}</a>
        </div>
    </div>

@stop
