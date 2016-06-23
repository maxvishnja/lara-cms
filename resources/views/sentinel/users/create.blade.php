@extends('layouts.main')

{{-- Web site Title --}}
@section('title')
    @parent
    @lang('users.page_user-create_title')
@stop

{{-- Content --}}
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="{{ route('sentinel.users.store') }}" accept-charset="UTF-8">

                <div class="form-group {{ ($errors->has('username')) ? 'has-error' : '' }}">
                    <input class="form-control" placeholder="{{ trans('users.user-field-login') }}" name="username" type="text"
                           value="{{ Request::old('username') }}">
                    @if($errors->has('username'))
                        <div class="alert alert-danger ptb5 mt5">{{ $errors->first('username') }}</div>
                    @endif
                </div>

                <div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' }}">
                    <input class="form-control" placeholder="{{ trans('users.user-field-email') }}" name="email" type="text"
                           value="{{ Request::old('email') }}">
                    @if($errors->has('email'))
                        <div class="alert alert-danger ptb5 mt5">{{ $errors->first('email') }}</div>
                    @endif
                </div>

                <div class="form-group {{ ($errors->has('password')) ? 'has-error' : '' }}">
                    <input class="form-control" placeholder="{{ trans('users.user-field-pass') }}" name="password" value="" type="password">
                    @if($errors->has('password'))
                        <div class="alert alert-danger ptb5 mt5">{{ $errors->first('password') }}</div>
                    @endif
                </div>

                <div class="form-group {{ ($errors->has('password_confirmation')) ? 'has-error' : '' }}">
                    <input class="form-control" placeholder="{{ trans('users.user-field-confirm-pass') }}" name="password_confirmation" value=""
                           type="password">
                    @if($errors->has('password_confirmation'))
                        <div class="alert alert-danger ptb5 mt5">{{ $errors->first('password_confirmation') }}</div>
                    @endif
                </div>
                <input name="activate" value="activate" type="hidden">
                <input name="_token" value="{{ csrf_token() }}" type="hidden">
                <input class="btn btn-primary" value="{{ trans('actions.create') }}" type="submit">

            </form>
        </div>
    </div>

    @stop
