@extends('layouts.main')

{{-- Web site Title --}}
@section('title')
    @parent
    @lang('companies.company-profile')
@stop

{{-- Content --}}
@section('content')


    <div class="x_content">
        <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
            <div class="profile_img">
                <div id="crop-avatar">
                    <!-- Current avatar -->
                    <img class="img-responsive img-circle avatar-view" src="/{{ $company->avatar }}"
                         alt="{{ $company->name }}"
                         title="{{ $company->name }}">
                </div>
            </div>
            <h3>{{ $company->name }}</h3>

            <ul class="list-unstyled user_data">
                <li><i class="fa fa-envelope"></i> {{ $company->email }}</li>
                {!! $company->phone ? '<li><i class="fa fa-phone"></i> '.$company->phone.' </li>' : '' !!}
            </ul>

            <a class="btn btn-success" href="{{ route('companies.edit', $company->id) }}"><i
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
                                @if ($company->name)
                                    <p><strong>{{ trans('companies.field-name') }}:</strong> {{ $company->name }} </p>
                                @endif
                                <p><strong>{{ trans('companies.field-email') }}:</strong> {{ $company->email }}</p>
                                @if ($company->phone)
                                    <p><strong>{{ trans('companies.field-phone') }}:</strong> {{ $company->phone }}
                                    </p>
                                @endif
                                @if ($company->skype)
                                    <p><strong>{{ trans('companies.field-skype') }}:</strong> {{ $company->skype }}
                                    </p>
                                @endif
                                @if ($company->discount)
                                    <p><strong>{{ trans('companies.companies-discount') }}
                                            :</strong> {{ $company->discount }} %</p>
                                @endif
                                @if ($company->description)
                                    <p><strong>{{ trans('users.user-description') }}:</strong></p>
                                    <p>{{ $company->description }}</p>
                                @endif

                            </div>
                            <div class="col-md-4">
                                <p><em>{{ trans('companies.company-date_of_contract') }}
                                        : {{ $company->date_of_contract }}</em></p>
                                <p><em>{{ trans('companies.company-last-updated') }}: {{ $company->updated_at }}</em>
                                </p>
                            </div>
                        </div>

                        @if($manager)
                            <h4>{{ trans('companies.profile-manager') }}:</h4>
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
                        @endif
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                        <table class="table jambo_table" id="history-table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>{{ trans('datatables.history-table.info') }}</th>
                                <th>{{ trans('datatables.history-table.time') }}</th>
                            </tr>
                            </thead>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('styles')
<link href="{{ asset('css/datatables.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<script src="{{ asset('js/datatables.js') }}"></script>
<script>
    $(function () {
        $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
            $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust()
                    .responsive.recalc();
        } );
        var table = $('#history-table').DataTable({

            scrollY: "400px",
            searching: false,
            info: false,
            responsive: true,
            ajax: '{{ route('company.history', $company->id) }}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'text', name: 'text'},
                {data: 'date', name: 'date'}
            ],
            language: {
                processing: "{{ trans('datatables.companies.processing') }}",
                search: "{{ trans('datatables.companies.search') }}",
                lengthMenu: "{{ trans('datatables.companies.lengthMenu') }}",
                info: "{{ trans('datatables.companies.info') }}",
                infoEmpty: "{{ trans('datatables.companies.infoEmpty') }}",
                infoFiltered: "{{ trans('datatables.companies.infoFiltered') }}",
                infoPostFix: "{{ trans('datatables.companies.infoPostFix') }}",
                loadingRecords: "{{ trans('datatables.companies.loadingRecords') }}",
                zeroRecords: "{{ trans('datatables.companies.zeroRecords') }}",
                emptyTable: "{{ trans('datatables.companies.emptyTable') }}",
                paginate: {
                    first: "{{ trans('datatables.companies.first') }}",
                    previous: "{{ trans('datatables.companies.previous') }}",
                    next: "{{ trans('datatables.companies.next') }}",
                    last: "{{ trans('datatables.companies.last') }}"
                }
            }
        });

    });
</script>
@endpush
