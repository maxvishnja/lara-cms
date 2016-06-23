@extends('layouts.login')

@section('title')
    @parent
    @lang('auth.login-page-title')
@stop

@section('content')
    <div class="animate form login_form">
        <section class="login_content">

            <form method="POST" action="{{ route('sentinel.session.store') }}" accept-charset="UTF-8">
                <h1>{{ trans('auth.login-page-title') }}</h1>

                @include('layouts.notifications')

                <div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' }}">
                    <input class="form-control" placeholder="{{ trans('auth.field-email') }}" autofocus="autofocus"
                           name="email" type="text"
                           value="{{ Request::old('email') }}">
                    @if($errors->has('email'))
                        <div class="alert alert-danger text-left ptb5">{{ $errors->first('email') }}</div>
                    @endif
                </div>

                <div class="form-group {{ ($errors->has('password')) ? 'has-error' : '' }}">
                    <input class="form-control" placeholder="{{ trans('auth.field-password') }}" name="password"
                           value="" type="password">
                    @if($errors->has('password'))
                        <div class="alert alert-danger text-left ptb5">{{ $errors->first('password') }}</div>
                    @endif
                </div>

                <input name="_token" value="{{ csrf_token() }}" type="hidden">

                <div class="text-center">
                    <input class="btn btn-default submit" value="{{ trans('auth.field-submit') }}" type="submit">
                    <a class="btn btn-link"
                       href="{{ route('sentinel.forgot.form') }}">{{ trans('auth.forgot-password') }}</a>
                </div>

                <div class="clearfix"></div>

                <div class="separator">
                    <br/>
                    <div>
                        <p>{{ trans('common.copyright') }}</p>
                    </div>
                </div>
            </form>
        </section>
    </div>

    <div id="register" class="animate form registration_form">
        <section class="login_content">
            <form>
                <h1>Create Account</h1>
                <div>
                    <input type="text" class="form-control" placeholder="Username" required=""/>
                </div>
                <div>
                    <input type="email" class="form-control" placeholder="Email" required=""/>
                </div>
                <div>
                    <input type="password" class="form-control" placeholder="Password" required=""/>
                </div>
                <div>
                    <a class="btn btn-default submit" href="index.html">Submit</a>
                </div>

                <div class="clearfix"></div>

                <div class="separator">
                    <p class="change_link">Already a member ?
                        <a href="#signin" class="to_register"> Log in </a>
                    </p>

                    <div class="clearfix"></div>
                    <br/>

                    <div>
                        <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                        <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and
                            Terms</p>
                    </div>
                </div>
            </form>
        </section>
    </div>
@stop