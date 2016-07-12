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
        $editAction = action('\\Sentinel\Controllers\UserController@edit', [$user->hash]);
    }
    ?>

    <div class="x_content">
        <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
            <div class="profile_img">
                <div id="crop-avatar">
                    <!-- Current avatar -->
                    <img class="img-responsive img-circle avatar-view" src="/{{ $user->avatar }}"
                         alt="{{ $user->first_name }} {{ $user->last_name }}"
                         title="{{ $user->first_name }} {{ $user->last_name }}">
                </div>
            </div>
            <h3>{{ $user->first_name }} {{ $user->last_name }}</h3>

            <ul class="list-unstyled user_data">
                <li><i class="fa fa-envelope"></i> {{ $user->email }}</li>
                {!! $user->phone ? '<li><i class="fa fa-phone"></i> '.$user->phone.' </li>' : '' !!}
            </ul>

            <a class="btn btn-success" href="{{ $editAction }}"><i
                        class="fa fa-edit m-right-xs"></i> {{ trans('actions.edit') }}</a>

        </div>
        <div class="col-md-9 col-sm-9 col-xs-12">

            <div class="" role="tabpanel" data-example-id="togglable-tabs">
                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab"
                                                              data-toggle="tab" aria-expanded="true">Информация</a>
                    </li>
                    <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab"
                                                        data-toggle="tab" aria-expanded="false">История</a>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                        <div class="well clearfix">
                            <div class="col-md-8">
                                @if ($user->first_name)
                                    <p><strong>{{ trans('users.user-first-name') }}:</strong> {{ $user->first_name }}
                                    </p>
                                @endif
                                @if ($user->middle_name)
                                    <p><strong>{{ trans('users.user-middle-name') }}:</strong> {{ $user->middle_name }}
                                    </p>
                                @endif
                                @if ($user->last_name)
                                    <p><strong>{{ trans('users.user-last-name') }}:</strong> {{ $user->last_name }} </p>
                                @endif
                                <p><strong>{{ trans('users.user-field-email') }}:</strong> {{ $user->email }}</p>
                                @if ($user->phone)
                                    <p><strong>{{ trans('users.user-phone') }}:</strong> {{ $user->phone }} </p>
                                @endif
                                @if ($user->skype)
                                    <p><strong>{{ trans('users.user-skype') }}:</strong> {{ $user->skype }} </p>
                                @endif
                                @if ($user->date_of_birth)
                                    <p><strong>{{ trans('users.user-date_of_birth') }}
                                            :</strong> {{ $user->date_of_birth }} </p>
                                @endif

                                @if ($user->description)
                                    <p><strong>{{ trans('users.user-description') }}:</strong></p>
                                    <p>{{ $user->description }}</p>
                                @endif

                            </div>
                            <div class="col-md-4">
                                <p><em>{{ trans('users.user-account-created') }}: {{ $user->created_at }}</em></p>
                                <p><em>{{ trans('users.user-last-updated') }}: {{ $user->updated_at }}</em></p>
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

                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">


                        @if(isset($revisions))
                            <ul class="list-group">
                                @foreach($revisions as $item)
                                    @if($item->key == 'created_at' && !$item->old_value)
                                        <li class="list-group-item">
                                            <b>{{ $item->userResponsible()->first_name }} {{ $item->userResponsible()->last_name }}</b>
                                            создал ресурс {{ $item->newValue() }}</li>
                                    @else
                                        <li class="list-group-item">
                                            @lang('revision.edit', [
                                                'First_name' => $item->userResponsible()->first_name,
                                                'Last_name' => $item->userResponsible()->last_name,
                                                'fieldName' => array_get(trans('revision.companies'), $item->fieldName()),
                                                'oldValue' => $item->oldValue(),
                                                'newValue' => $item->newValue()
                                                ])
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>




@stop
