@extends('layouts.main')

{{-- Web site Title --}}
@section('title')
    @parent
    {{ trans('customers.title') }}
@stop



{{-- Content --}}
@section('content')
    <div class="row">
        <div class='page-header'>
            <a class='btn btn-success'
               href="{{ route('customers.create') }}">{!! trans('actions.customers-create') !!}</a>
        </div>
    </div>


        <div class="col-md-12 col-sm-12 col-xs-12">
            @if(count($customers))
        <div class="table-responsive">
            <table id="datatable-responsive" class="table table-striped jambo_table bulk_action">
                <thead>
                <tr>
                    <th> {{ trans('customers.field-logo') }}</th>
                    <th> {{ trans('customers.field-name') }}</th>
                    <th> {{ trans('customers.field-email') }}</th>
                    <th> {{ trans('customers.field-phone') }}</th>
                    <th> {{ trans('customers.field-skype') }}</th>
                    <th> {{ trans('customers.field-actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td><img src="/{{ $customer->avatar }}" alt="" class="avatar"></td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->skype }}</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm"
                                    onClick="location.href='{{ route('customers.show', array($customer->id)) }}'"
                                    data-toggle="tooltip" data-placement="top"
                                    data-original-title="{{ trans('actions.view') }}">
                                <i class="fa fa-user"> </i> {{ trans('actions.view') }}
                            </button>
                            <button class="btn btn-success btn-sm" type="button"
                                    onClick="location.href='{{ route('customers.edit', array($customer->id)) }}'"
                                    data-toggle="tooltip" data-placement="top"
                                    data-original-title="{{ trans('actions.edit') }}"><i class="fa fa-pencil"></i></button>
                            <button class="btn btn-danger btn-sm confirm"
                                    href="{{ route('customers.destroy', array($customer->id)) }}"
                                    data-token="{{ Session::getToken() }}" data-method="delete"
                                    data-toggle="tooltip" data-placement="top"
                                    data-original-title="{{ trans('actions.delete') }}"><i class="fa fa-remove"> </i>
                            </button>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
                @else
                <h3 class="text-center">{{ trans('customers.empty') }}</h3>
                @endif
    </div>

@stop
