@extends('layouts.main')

{{-- Web site Title --}}
@section('title')
    @parent
    @lang('customers.customer-edit_title')
@stop

{{-- Content --}}
@section('content')

    <div class="row">
        <h4>{{ trans('customers.customer-profile') }}</h4>
        <div class="well">

            <form method="POST" action="{{ route('customers.update',  $customer->id) }}" accept-charset="UTF-8" class="form-horizontal"
                  role="form" enctype="multipart/form-data">
                <input name="_method" value="PUT" type="hidden">
                <input name="_token" value="{{ csrf_token() }}" type="hidden">

                <div class="row">
                    <div class="col-md-3 text-center">
                        <img src="/{{ $customer->avatar }}" alt="{{ $customer->name}}" width="200"
                             class="img-circle mb20">

                        <div class="form-group {{ ($errors->has('name')) ? 'has-error' : '' }}" for="first_name">
                            <label class="btn btn-primary btn-file btn-sm">
                                {{ trans('actions.edit-image') }} <input type="file" name="avatar"
                                                                         style="display: none;">
                            </label>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="form-group {{ ($errors->has('name')) ? 'has-error' : '' }}" for="first_name">
                            <label for="first_name"
                                   class="col-sm-2 control-label">{{ trans('customers.field-name') }}</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="name" type="text"
                                       value="{{ Request::old('name') ? Request::old('name') : $customer->name }}">
                                {{ ($errors->has('name') ? $errors->first('name') : '') }}
                            </div>
                        </div>

                        <div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' }}" for="email">
                            <label for="email" class="col-sm-2 control-label">{{ trans('customers.field-email') }}</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="email" type="text"
                                       value="{{ Request::old('email') ? Request::old('email') : $customer->email }}">
                                {{ ($errors->has('email') ? $errors->first('email') : '') }}
                            </div>
                        </div>

                        <div class="form-group {{ ($errors->has('phone')) ? 'has-error' : '' }}" for="phone">
                            <label for="phone" class="col-sm-2 control-label">{{ trans('customers.field-phone') }}</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="phone" type="text"
                                       value="{{ Request::old('phone') ? Request::old('phone') : $customer->phone }}">
                                {{ ($errors->has('phone') ? $errors->first('phone') : '') }}
                            </div>
                        </div>

                        <div class="form-group {{ ($errors->has('skype')) ? 'has-error' : '' }}" for="skype">
                            <label for="skype" class="col-sm-2 control-label">{{ trans('customers.field-skype') }}</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="skype" type="text"
                                       value="{{ Request::old('skype') ? Request::old('skype') : $customer->skype }}">
                                {{ ($errors->has('skype') ? $errors->first('skype') : '') }}
                            </div>
                        </div>

                        <div class="form-group {{ ($errors->has('date_of_contract')) ? 'has-error' : '' }}"
                             for="date_of_birth">
                            <label for="date_of_birth"
                                   class="col-sm-2 control-label">{{ trans('customers.customer-date_of_contract') }}</label>
                            <div class="col-sm-10">
                                <input class="datepicker form-control" required="required" type="text"
                                       name="date_of_contract"
                                       value="{{ Request::old('date_of_contract') ? Request::old('date_of_contract') : $customer->date_of_contract }}">
                                {{ ($errors->has('date_of_contract') ? $errors->first('date_of_contract') : '') }}
                            </div>
                        </div>

                        <div class="form-group {{ ($errors->has('discount')) ? 'has-error' : '' }}"
                             for="discount">
                            <label for="discount"
                                   class="col-sm-2 control-label">{{ trans('customers.customer-discount') }}</label>
                            <div class="col-sm-10">
                                <input class="form-control" required="required" type="text"
                                       name="discount"
                                       value="{{ Request::old('discount') ? Request::old('discount') : $customer->discount }}">
                                {{ ($errors->has('discount') ? $errors->first('discount') : '') }}
                            </div>
                        </div>

                        <div class="form-group"
                             for="manager">
                            <label for="manager"
                                   class="col-sm-2 control-label">{{ trans('customers.field-manager') }}</label>
                            <div class="col-sm-10">
                                <select name="manager" type="text" class="form-control">
                                    <option class="form-control" value="" disabled
                                            selected>{{ trans('customers.field-manager') }}</option>
                                    @foreach($managers as $manager)
                                        <option class="form-control"
                                                value="{{ $manager->id }}" {{ $customer->manager == $manager->id ? 'selected' : '' }}>{{ $manager->first_name.' '.$manager->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group {{ ($errors->has('date_of_birth')) ? 'has-error' : '' }}" for="description">
                            <label for="description"
                                   class="col-sm-2 control-label">{{ trans('customers.user-description') }}</label>
                            <div class="col-sm-10">
                        <textarea class="form-control" name="description"
                                  rows="3">{{ Request::old('description') ? Request::old('description') : $customer->description }}</textarea>
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

@stop