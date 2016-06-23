@extends('layouts.main')

{{-- Web site Title --}}
@section('title')
@parent
@lang('users.user-profile')
@stop

{{-- Content --}}
@section('content')

    <?php
        // Determine the edit profile route
        if (($user->email == Sentry::getUser()->email)) {
            $editAction = route('sentinel.profile.edit');
        } else {
            $editAction =  action('\\Sentinel\Controllers\UserController@edit', [$user->hash]);
        }
    ?>

  	<div class="well clearfix">
	    <div class="col-md-8">
		    @if ($user->first_name)
		    	<p><strong>{{ trans('users.user-first-name') }}:</strong> {{ $user->first_name }} </p>
			@endif
			@if ($user->last_name)
		    	<p><strong>{{ trans('users.user-last-name') }}:</strong> {{ $user->last_name }} </p>
			@endif
		    <p><strong>{{ trans('users.user-field-email') }}:</strong> {{ $user->email }}</p>
		    
		</div>
		<div class="col-md-4">
			<p><em>{{ trans('users.user-account-created') }}: {{ $user->created_at }}</em></p>
			<p><em>{{ trans('users.user-last-updated') }}: {{ $user->updated_at }}</em></p>
			<button class="btn btn-success" onClick="location.href='{{ $editAction }}'">{{ trans('actions.edit') }}</button>
		</div>
	</div>

	<h4>{{ trans('users.user-groups') }}:</h4>
	<?php $userGroups = $user->getGroups(); ?>
	<div class="well">
	    <ul>
	    	@if (count($userGroups) >= 1)
		    	@foreach ($userGroups as $group)
					<li>{{ $group['name'] }}</li>
				@endforeach
			@else 
				<li>{{ trans('users.user-no-groups') }}</li>
			@endif
	    </ul>
	</div>

@stop
