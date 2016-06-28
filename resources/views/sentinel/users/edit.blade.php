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

    <div class="row">
        <h4>{{ trans('users.user-profile') }}</h4>
        <div class="well">

            <form method="POST" action="{{ $profileFormAction }}" accept-charset="UTF-8" class="form-horizontal"
                  role="form" enctype="multipart/form-data">
                <input name="_method" value="PUT" type="hidden">
                <input name="_token" value="{{ csrf_token() }}" type="hidden">

                <div class="row">
                    <div class="col-md-3 text-center">
                        <img src="/{{ $user->avatar }}" alt="{{ $user->first_name.' '.$user->last_name }}" width="200"
                             class="img-circle mb20">

                        <div class="form-group {{ ($errors->has('first_name')) ? 'has-error' : '' }}" for="first_name">
                            <label class="btn btn-primary btn-file btn-sm">
                                {{ trans('actions.edit-image') }} <input type="file" name="avatar"
                                                                         style="display: none;">
                            </label>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="form-group {{ ($errors->has('first_name')) ? 'has-error' : '' }}" for="first_name">
                            <label for="first_name"
                                   class="col-sm-2 control-label">{{ trans('users.user-first-name') }}</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="first_name" type="text"
                                       value="{{ Request::old('first_name') ? Request::old('first_name') : $user->first_name }}">
                                {{ ($errors->has('first_name') ? $errors->first('first_name') : '') }}
                            </div>
                        </div>

                        <div class="form-group {{ ($errors->has('middle_name')) ? 'has-error' : '' }}"
                             for="middle_name">
                            <label for="middle_name"
                                   class="col-sm-2 control-label">{{ trans('users.user-middle-name') }}</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="middle_name" type="text"
                                       value="{{ Request::old('last_name') ? Request::old('middle_name') : $user->middle_name }}">
                                {{ ($errors->has('middle_name') ? $errors->first('middle_name') : '') }}
                            </div>
                        </div>

                        <div class="form-group {{ ($errors->has('last_name')) ? 'has-error' : '' }}" for="last_name">
                            <label for="last_name"
                                   class="col-sm-2 control-label">{{ trans('users.user-last-name') }}</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="last_name" type="text"
                                       value="{{ Request::old('last_name') ? Request::old('last_name') : $user->last_name }}">
                                {{ ($errors->has('last_name') ? $errors->first('last_name') : '') }}
                            </div>
                        </div>

                        <div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' }}" for="email">
                            <label for="email" class="col-sm-2 control-label">{{ trans('users.user-field-email') }}</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="email" type="text"
                                       value="{{ Request::old('email') ? Request::old('email') : $user->email }}">
                                {{ ($errors->has('email') ? $errors->first('email') : '') }}
                            </div>
                        </div>

                        <div class="form-group {{ ($errors->has('phone')) ? 'has-error' : '' }}" for="phone">
                            <label for="phone" class="col-sm-2 control-label">{{ trans('users.user-phone') }}</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="phone" type="text"
                                       value="{{ Request::old('phone') ? Request::old('phone') : $user->phone }}">
                                {{ ($errors->has('phone') ? $errors->first('phone') : '') }}
                            </div>
                        </div>

                        <div class="form-group {{ ($errors->has('skype')) ? 'has-error' : '' }}" for="skype">
                            <label for="skype" class="col-sm-2 control-label">{{ trans('users.user-skype') }}</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="skype" type="text"
                                       value="{{ Request::old('skype') ? Request::old('skype') : $user->skype }}">
                                {{ ($errors->has('skype') ? $errors->first('skype') : '') }}
                            </div>
                        </div>

                        <div class="form-group {{ ($errors->has('date_of_birth')) ? 'has-error' : '' }}"
                             for="date_of_birth">
                            <label for="date_of_birth"
                                   class="col-sm-2 control-label">{{ trans('users.user-date_of_birth') }}</label>
                            <div class="col-sm-10">
                                <input class="datepicker form-control" required="required" type="text"
                                       name="date_of_birth"
                                       value="{{ Request::old('date_of_birth') ? Request::old('date_of_birth') : $user->date_of_birth }}">
                                {{ ($errors->has('date_of_birth') ? $errors->first('date_of_birth') : '') }}
                            </div>
                        </div>

                        <div class="form-group {{ ($errors->has('date_of_birth')) ? 'has-error' : '' }}" for="description">
                            <label for="description"
                                   class="col-sm-2 control-label">{{ trans('users.user-description') }}</label>
                            <div class="col-sm-10">
                        <textarea class="form-control" name="description"
                                  rows="3">{{ Request::old('description') ? Request::old('description') : $user->description }}</textarea>
                                {{ ($errors->has('description') ? $errors->first('description') : '') }}
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-group text-right">
                    <div class="col-md-12">
                        <input class="btn btn-success" value="{{ trans('actions.save') }}" type="submit">
                    </div>
                </div>
            </form>
        </div>
    </div>

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
