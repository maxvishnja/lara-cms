@extends('layouts.main')

{{-- Web site Title --}}
@section('title')
    @parent
    {{ trans('users.title') }}
@stop

{{-- Content --}}
@section('content')
    <div class="row">
        <div class='page-header'>
            <a class='btn btn-primary' href="{{ route('sentinel.users.create') }}">Create User</a>
        </div>
    </div>

    @foreach ($users as $user)

        <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
            <div class="well profile_view">
                <div class="col-sm-12">
                    <h4 class="brief"><i>Digital Strategist</i></h4>
                    <div class="left col-xs-7">
                        <h2>Nicole Pearson</h2>
                        <ul class="list-unstyled">
                            <li><i class="fa fa-envelope"></i> Email: {{ $user->email }}</li>
                            <li><i class="fa fa-phone"></i> Phone #: </li>
                        </ul>
                    </div>
                    <div class="right col-xs-5 text-center">
                        <img src="images/img.jpg" alt="" class="img-circle img-responsive">
                    </div>
                </div>
                <div class="col-xs-12 bottom text-center">
                    <div class="emphasis">
                        <button type="button" class="btn btn-primary btn-sm"
                                onClick="location.href='{{ route('sentinel.users.show', array($user->hash)) }}'">
                            <i class="fa fa-user"> </i> {{ trans('actions.view') }}
                        </button>

                        <button class="btn btn-success btn-sm" type="button"
                                onClick="location.href='{{ route('sentinel.users.edit', array($user->hash)) }}'"
                                title="{{ trans('actions.edit') }}"><i class="fa fa-pencil"></i></button>
                        @if ($user->status != 'Banned')
                            <button class="btn btn-warning btn-sm" type="button"
                                    onClick="location.href='{{ route('sentinel.users.ban', array($user->hash)) }}'"
                                    title="{{ trans('actions.ban') }}"><i class="fa fa-lock"> </i></button>
                        @else
                            <button class="btn btn-warning btn-sm" type="button"
                                    onClick="location.href='{{ route('sentinel.users.unban', array($user->hash)) }}'"
                                    title="{{ trans('actions.unban') }}"><i class="fa fa-unlock"> </i></button>
                        @endif
                        <button class="btn btn-danger btn-sm action_confirm"
                                href="{{ route('sentinel.users.destroy', array($user->hash)) }}"
                                data-token="{{ Session::getToken() }}" data-method="delete"
                                title="{{ trans('actions.delete') }}"><i class="fa fa-remove"> </i></button>
                    </div>
                </div>
            </div>
        </div>

    @endforeach
@stop
