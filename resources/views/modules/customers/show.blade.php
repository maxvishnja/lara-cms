@extends('layouts.main')

{{-- Web site Title --}}
@section('title')
    @parent
    @lang('customers.customer-profile')
@stop

{{-- Content --}}
@section('content')


    <div class="x_content">
        <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
            <div class="profile_img">
                <div id="crop-avatar">
                    <!-- Current avatar -->
                    <img class="img-responsive img-circle avatar-view" src="/{{ $customer->avatar }}"
                         alt="{{ $customer->name }}"
                         title="{{ $customer->name }}">
                </div>
            </div>
            <h3>{{ $customer->name }}</h3>

            <ul class="list-unstyled user_data">
                <li><i class="fa fa-envelope"></i> {{ $customer->email }}</li>
                {!! $customer->phone ? '<li><i class="fa fa-phone"></i> '.$customer->phone.' </li>' : '' !!}
            </ul>

            <a class="btn btn-success" href="{{ route('customers.edit', $customer->id) }}"><i
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
                                @if ($customer->name)
                                    <p><strong>{{ trans('customers.field-name') }}:</strong> {{ $customer->name }} </p>
                                @endif
                                <p><strong>{{ trans('customers.field-email') }}:</strong> {{ $customer->email }}</p>
                                @if ($customer->phone)
                                    <p><strong>{{ trans('customers.field-phone') }}:</strong> {{ $customer->phone }}
                                    </p>
                                @endif
                                @if ($customer->skype)
                                    <p><strong>{{ trans('customers.field-skype') }}:</strong> {{ $customer->skype }}
                                    </p>
                                @endif
                                @if ($customer->discount)
                                    <p><strong>{{ trans('customers.customer-discount') }}
                                            :</strong> {{ $customer->discount }} %</p>
                                @endif
                                @if ($customer->description)
                                    <p><strong>{{ trans('users.user-description') }}:</strong></p>
                                    <p>{{ $customer->description }}</p>
                                @endif

                            </div>
                            <div class="col-md-4">
                                <p><em>{{ trans('customers.customer-date_of_contract') }}
                                        : {{ $customer->date_of_contract }}</em></p>
                                <p><em>{{ trans('customers.customer-last-updated') }}: {{ $customer->updated_at }}</em>
                                </p>
                            </div>
                        </div>

                        <h4>{{ trans('customers.profile-manager') }}:</h4>
                        <div class="well clearfix">
                            <div class="col-md-3">
                                <img src="/{{ $manager->avatar }}" alt="" class="img-circle profile_img">
                            </div>
                            <div class="col-md-9 text-left">
                                <div class="message_wrapper">
                                    <p><i class="fa fa-user"></i> {{ $manager->last_name.' '. $manager->first_name }}
                                    @if ($manager->email)
                                        <p><i class="fa fa-envelope"></i>  {{ $manager->email }}
                                    @endif
                                    @if ($manager->phone)
                                        <p><i class="fa fa-phone"></i> {{ $manager->phone }}
                                    @endif
                                    @if ($manager->skype)
                                        <p><i class="fa fa-skype"></i>  {{ $manager->skype }}
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                        <!-- start user projects -->
                        <table class="data table table-striped no-margin">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Project Name</th>
                                <th>Client Company</th>
                                <th class="hidden-phone">Hours Spent</th>
                                <th>Contribution</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>New Company Takeover Review</td>
                                <td>Deveint Inc</td>
                                <td class="hidden-phone">18</td>
                                <td class="vertical-align-mid">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-success" data-transitiongoal="35"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>New Partner Contracts Consultanci</td>
                                <td>Deveint Inc</td>
                                <td class="hidden-phone">13</td>
                                <td class="vertical-align-mid">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-danger" data-transitiongoal="15"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Partners and Inverstors report</td>
                                <td>Deveint Inc</td>
                                <td class="hidden-phone">30</td>
                                <td class="vertical-align-mid">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-success" data-transitiongoal="45"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>New Company Takeover Review</td>
                                <td>Deveint Inc</td>
                                <td class="hidden-phone">28</td>
                                <td class="vertical-align-mid">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-success" data-transitiongoal="75"></div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <!-- end user projects -->

                    </div>
                </div>
            </div>
        </div>
    </div>




@stop
