@extends('layouts.main')

{{-- Web site Title --}}
@section('title')
    @parent
    @lang('customers.customer-create_title')
@stop

{{-- Content --}}
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="{{ route('customers.store') }}" accept-charset="UTF-8">

                <div class="form-group {{ ($errors->has('name')) ? 'has-error' : '' }}">
                    <input class="form-control" placeholder="{{ trans('customers.field-name') }}" name="name"
                           type="text"
                           value="{{ Request::old('name') }}">
                    @if($errors->has('name'))
                        <div class="alert alert-danger ptb5 mt5">{{ $errors->first('name') }}</div>
                    @endif
                </div>

                <div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' }}">
                    <input class="form-control" placeholder="{{ trans('users.user-field-email') }}" name="email"
                           type="text"
                           value="{{ Request::old('email') }}">
                    @if($errors->has('email'))
                        <div class="alert alert-danger ptb5 mt5">{{ $errors->first('email') }}</div>
                    @endif
                </div>

                <div class="form-group {{ ($errors->has('phone')) ? 'has-error' : '' }}">
                    <input class="form-control" placeholder="{{ trans('customers.field-phone') }}" name="phone" value=""
                           type="text">
                    @if($errors->has('phone'))
                        <div class="alert alert-danger ptb5 mt5">{{ $errors->first('phone') }}</div>
                    @endif
                </div>

                <div class="form-group {{ ($errors->has('skype')) ? 'has-error' : '' }}">
                    <input class="form-control" placeholder="{{ trans('customers.field-skype') }}" name="skype" value=""
                           type="text">
                </div>

                <div class="form-group">
                    <select name="manager" type="text" class="form-control">
                        <option class="form-control" value="" disabled
                                selected>{{ trans('customers.field-manager') }}</option>
                        @foreach($managers as $manager)
                            <option class="form-control"
                                    value="{{ $manager->id }}">{{ $manager->first_name.' '.$manager->last_name }}</option>
                        @endforeach
                    </select>
                </div>
                <input name="activate" value="activate" type="hidden">
                <input name="_token" value="{{ csrf_token() }}" type="hidden">
                <input class="btn btn-primary" value="{{ trans('actions.create') }}" type="submit">

            </form>
        </div>
    </div>

@stop
