@extends('layouts.main')

{{-- Web site Title --}}
@section('title')
    @parent
    @lang('users.page_user-edit_title')
@stop

{{-- Content --}}
@section('content')

    <?php
    // Pull the custom fields from config
    $isProfileUpdate = ($user->email == Sentry::getUser()->email);
    $customFields = config('sentinel.additional_user_fields');

    // Determine the form post route
    if ($isProfileUpdate) {
        $profileFormAction = route('sentinel.profile.update');
        $passwordFormAction = route('sentinel.profile.password');
    } else {
        $profileFormAction = route('sentinel.users.update', $user->hash);
        $passwordFormAction = route('sentinel.password.change', $user->hash);
    }
    ?>

    @if (! empty($customFields))
        <div class="row">
            <h4>{{ trans('users.user-profile') }}</h4>
            <div class="well">
                <form method="POST" action="{{ $profileFormAction }}" accept-charset="UTF-8" class="form-horizontal"
                      role="form">
                    <input name="_method" value="PUT" type="hidden">
                    <input name="_token" value="{{ csrf_token() }}" type="hidden">

                    @foreach(config('sentinel.additional_user_fields') as $field => $rules)
                        <div class="form-group {{ ($errors->has($field)) ? 'has-error' : '' }}" for="{{ $field }}">
                            <label for="{{ $field }}" class="col-sm-2 control-label">
                                @if($field == 'first_name')
                                    @lang('users.user-first-name')
                                @elseif('last_name')
                                    @lang('users.user-last-name')
                                @endif
                            </label>
                            <div class="col-sm-10">
                                <input class="form-control" name="{{ $field }}" type="text"
                                       value="{{ Request::old($field) ? Request::old($field) : $user->$field }}">
                                {{ ($errors->has($field) ? $errors->first($field) : '') }}
                            </div>
                        </div>
                    @endforeach

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input class="btn btn-success" value="{{ trans('actions.save') }}" type="submit">
                        </div>
                    </div>

                </form>
            </div>
        </div>
    @endif

    @if (Sentry::getUser()->hasAccess('admin'))
        <div class="row">
            <h4>{{ trans('users.user-groups') }}</h4>
            <div class="well">
                <form method="POST" action="{{ route('sentinel.users.memberships', $user->hash) }}"
                      accept-charset="UTF-8" class="form-horizontal" role="form">

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            @foreach($groups as $group)
                                <label class="checkbox-inline checkbox">
                                    <input type="checkbox" name="groups[{{ $group->name }}]"
                                           value="1" {{ ($user->inGroup($group) ? 'checked' : '') }}> {{ $group->name }}
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input name="_token" value="{{ csrf_token() }}" type="hidden">
                            <input class="btn btn-success" value="{{ trans('actions.save') }}" type="submit">
                        </div>
                    </div>

                </form>
            </div>
        </div>
    @endif

    <div class="row">
        <h4>{{ trans('users.user-change-pass') }}</h4>
        <div class="well">
            <form method="POST" action="{{ $passwordFormAction }}" accept-charset="UTF-8" class="form-inline"
                  role="form">

                @if(! Sentry::getUser()->hasAccess('admin'))
                    <div class="form-group {{ $errors->has('oldPassword') ? 'has-error' : '' }}">
                        <label for="oldPassword" class="sr-only">Old Password</label>
                        <input class="form-control" placeholder="Old Password" name="oldPassword" value=""
                               id="oldPassword" type="password">
                    </div>
                @endif

                <div class="form-group {{ $errors->has('newPassword') ? 'has-error' : '' }}">
                    <input class="form-control" placeholder="{{ trans('users.user-field-pass-new') }}"
                           name="newPassword" value="" id="newPassword"
                           type="password">
                </div>

                <div class="form-group {{ $errors->has('newPassword_confirmation') ? 'has-error' : '' }}">
                    <input class="form-control" placeholder="{{ trans('users.user-field-confirm-pass') }}"
                           name="newPassword_confirmation"
                           value="" id="newPassword_confirmation" type="password">
                </div>

                <input name="_token" value="{{ csrf_token() }}" type="hidden">
                <input class="btn btn-success" value="{{ trans('actions.save') }}" type="submit">

                @if($errors->has('newPassword') or $errors->has('newPassword_confirmation'))
                    <div class="alert alert-danger ptb5 mt5">
                        <ul>
                            <li>{{ ($errors->has('newPassword') ?  $errors->first('newPassword') : '') }}</li>
                            <li>{{ ($errors->has('newPassword_confirmation') ? $errors->first('newPassword_confirmation') : '') }}</li>
                        </ul>
                    </div>
                @endif

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
