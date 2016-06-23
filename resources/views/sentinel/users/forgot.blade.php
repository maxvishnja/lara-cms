@extends('layouts.login')

@section('title')
    @parent
    @lang('users.user-forgot-password')
@stop

@section('content')
    <div class="animate form login_form_forgot">
        <section class="login_content">

            <form method="POST" action="{{ route('sentinel.reset.request') }}" accept-charset="UTF-8">
                <h1>{{ trans('users.user-forgot-password') }}</h1>
                @include('layouts.notifications')
                <div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' }}">
                    <input class="form-control" placeholder="E-mail" autofocus="autofocus" name="email" type="text"
                           value="{{ Request::old('name') }}">
                    {{ ($errors->has('email') ? $errors->first('email') : '') }}
                </div>

                <input name="_token" value="{{ csrf_token() }}" type="hidden">
                <input class="btn btn-primary" value="{{ trans('actions.restore') }}" type="submit">
            </form>

        </section>
    </div>
@stop