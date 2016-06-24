@extends('layouts.main')

{{-- Web site Title --}}
@section('title')
    @parent
    {{ trans('users.page_group-edit_title') }}
@stop

{{-- Content --}}
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="{{ route('sentinel.groups.update', $group->hash) }}" accept-charset="UTF-8">

                <div class="form-group {{ ($errors->has('name')) ? 'has-error' : '' }}">
                    <input class="form-control" placeholder="{{ trans('users.group-field-name') }}" name="name"
                           value="{{ Request::old('name') ? Request::old('name') : $group->name }}" type="text">
                    {{ ($errors->has('name') ? $errors->first('name') : '') }}
                </div>

                <label for="Permissions">{{ trans('users.group-field-permissions') }}</label>
                <div class="form-group checkbox">
                    <?php $defaultPermissions = config('sentinel.default_permissions', []); ?>
                    @foreach ($defaultPermissions as $permission)
                        <label class="checkbox-inline ">
                            <input name="permissions[{{ $permission }}]" value="1"
                                   type="checkbox" {{ (isset($permissions[$permission]) ? 'checked' : '') }}>
                            {{ ucwords($permission) }}
                        </label>
                    @endforeach
                </div>

                <input name="_method" value="PUT" type="hidden">
                <input name="_token" value="{{ csrf_token() }}" type="hidden">
                <input class="btn btn-success" value="{{ trans('actions.save') }}" type="submit">

            </form>
        </div>
    </div>

    @stop

    @push('styles')
    <!-- iCheck -->
    <link href="/libs/iCheck/skins/flat/green.css" rel="stylesheet">
    @endpush

    @push('scripts')
    <!-- iCheck -->
    <script src="/libs/iCheck/icheck.min.js"></script>
    @endpush