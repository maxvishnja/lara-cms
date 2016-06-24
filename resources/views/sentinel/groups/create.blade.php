@extends('layouts.main')

{{-- Web site Title --}}
@section('title')
    @parent
    {{ trans('users.page_group-create_title') }}
@stop

{{-- Content --}}
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="{{ route('sentinel.groups.store') }}" accept-charset="UTF-8">


                <div class="form-group {{ ($errors->has('name')) ? 'has-error' : '' }}">
                    <input class="form-control" placeholder="{{ trans('users.group-field-name') }}" name="name"
                           type="text"
                           value="{{ Request::old('email') }}">
                    {{ ($errors->has('name') ? $errors->first('name') : '') }}
                </div>

                <label for="Permissions">{{ trans('users.group-field-permissions') }}</label>
                <div class="form-group checkbox">
                    <?php $defaultPermissions = config('sentinel.default_permissions', []); ?>
                    @foreach ($defaultPermissions as $permission)
                        <label class="checkbox-inline">
                            <input name="permissions[{{ $permission }}]" value="1" type="checkbox"
                                   @if (Request::old('permissions[' . $permission .']'))
                                   checked
                                    @endif
                            > {{ ucwords($permission) }}
                        </label>
                    @endforeach
                </div>

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