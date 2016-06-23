@extends('layouts.login')

@section('title')
    @parent
    @lang('users.page_user-reset_pass_title')
@stop

@section('content')

    <div class="animate form login_form_forgot">
        <section class="login_content">

            <form method="POST" action="{{ route('sentinel.reset.password', [$hash, $code]) }}" accept-charset="UTF-8">

                <h1>{{ trans('users.page_user-reset_pass_title') }}</h1>

                <div class="form-group {{ ($errors->has('password')) ? 'has-error' : '' }}">
                    <input class="form-control" placeholder="{{ trans('users.user-field-pass-new') }}" name="password" type="password"/>
                    @if($errors->has('password'))
                        <div class="alert alert-danger text-left ptb5">{{ $errors->first('password') }}</div>
                    @endif
                </div>

                <div class="form-group {{ ($errors->has('password_confirmation')) ? 'has-error' : '' }}">
                    <input class="form-control" placeholder="{{ trans('users.user-field-confirm-pass') }}" name="password_confirmation"
                           type="password"/>
                    @if($errors->has('password_confirmation'))
                        <div class="alert alert-danger text-left ptb5">{{ $errors->first('password_confirmation') }}</div>
                    @endif
                </div>

                <input name="_token" value="{{ csrf_token() }}" type="hidden">

                <input class="btn btn-primary" value="{{ trans('actions.confirm') }}" type="submit">

            </form>

        </section>
    </div>

@stop