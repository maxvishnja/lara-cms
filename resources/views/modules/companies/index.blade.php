@extends('layouts.main')

{{-- Web site Title --}}
@section('title')
    @parent
    {{ trans('companies.title') }}
@stop



{{-- Content --}}
@section('content')
    <div class="row">
        <div class='page-header'>
            <a class='btn btn-success'
               href="{{ route('companies.create') }}">{!! trans('actions.companies-create') !!}</a>
        </div>
    </div>


    <div class="col-md-12 col-sm-12 col-xs-12">
        @if(count($companies))
            <div class="table-responsive">
                <table id="datatable-responsive" class="table table-striped jambo_table bulk_action">
                    <thead>
                    <tr>
                        <th> {{ trans('companies.field-logo') }}</th>
                        <th> {{ trans('companies.field-name') }}</th>
                        <th> {{ trans('companies.field-email') }}</th>
                        <th> {{ trans('companies.field-phone') }}</th>
                        <th> {{ trans('companies.field-skype') }}</th>
                        <th> {{ trans('actions.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($companies as $company)
                        <tr>
                            <td><img src="/{{ $company->avatar }}" alt="" class="avatar"></td>
                            <td>{{ $company->name }}</td>
                            <td>{{ $company->email }}</td>
                            <td>{{ $company->phone }}</td>
                            <td>{{ $company->skype }}</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm"
                                        onClick="location.href='{{ route('companies.show', array($company->id)) }}'"
                                        data-toggle="tooltip" data-placement="top"
                                        data-original-title="{{ trans('actions.view') }}">
                                    <i class="fa fa-user"> </i> {{ trans('actions.view') }}
                                </button>
                                <button class="btn btn-success btn-sm" type="button"
                                        onClick="location.href='{{ route('companies.edit', array($company->id)) }}'"
                                        data-toggle="tooltip" data-placement="top"
                                        data-original-title="{{ trans('actions.edit') }}"><i class="fa fa-pencil"></i>
                                </button>
                                <button class="btn btn-danger btn-sm confirm"
                                        href="{{ route('companies.destroy', array($company->id)) }}"
                                        data-token="{{ Session::getToken() }}" data-method="delete"
                                        data-toggle="tooltip" data-placement="top"
                                        data-original-title="{{ trans('actions.delete') }}"><i
                                            class="fa fa-remove"> </i>
                                </button>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        @else
            <h3 class="text-center">{{ trans('companies.empty') }}</h3>
        @endif
    </div>

@stop
