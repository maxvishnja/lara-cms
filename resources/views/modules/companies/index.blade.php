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

    <div class="well well-sm well-filter">
        <div class="row">
            <div class="col-md-12">
                <h2 class="pull-left">Фильтр</h2>
                <div class="pull-left">
                    <button class="btn btn-warning btn-xs filter_reset" type="reset">Сбросить</button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('type_id', trans('companies.type_company'), ['class' => 'control-label']) !!}
                    <?php
                    $types = config('company.types_of_companies');
                    array_unshift($types, trans('actions.nothing-selected')); ?>
                    {!! Form::select('type_id', $types, null, [
                        'id' => 'type_id',
                        'class' => 'form-control'
                    ]) !!}
                </div>
            </div>
            <div class="col-md-3">
                {!! Form::label('manager', trans('companies.field-manager'), ['class' => 'control-label']) !!}
                <div class="form-group">
                    {!! Form::select('manager', $managers, null, [
                        'id' => 'manager',
                        'class' => 'form-control'
                    ]) !!}
                </div>
            </div>
        </div>
    </div>


    <hr>

    <table class="table table-striped jambo_table" id="companies-table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Название</th>
            <th>Email</th>
            <th>Телефон</th>
            <th>Тип компании</th>
            <th>Ответственный</th>
            <th>Действия</th>
        </tr>
        </thead>
    </table>

@stop

@push('styles')
<link href="{{ asset('css/datatables.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<script src="{{ asset('js/datatables.js') }}"></script>
<script>
    $(function () {
        var table = $('#companies-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{!! route('companies.data') !!}',
                data: function (d) {
                    d.type_id = $('#type_id').val() == 0 ? '' : $('#type_id').val();
                    d.manager = $('#manager').val() == 0 ? '' : $('#manager').val();
                }
            },
            columns: [
                {"width": "2%"},
                {"width": "20%"},
                {"width": "14%"},
                {"width": "14%"},
                {"width": "13%"},
                {"width": "10%"},
                {"width": "14%"}
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
                },
                aria: {
                    sortAscending: "{{ trans('datatables.companies.sortAscending') }}",
                    sortDescending: "{{ trans('datatables.companies.sortDescending') }}"
                }
            },
            drawCallback: function (settings) {
                $('a[title]').tooltip({
                    container: 'body',
                    placement: 'top'
                });
            }
        });

        $('#type_id, #manager').on('change', function (e) {
            table.draw();
            e.preventDefault();
        });

        $('.filter_reset').on('click', function (e) {
            e.preventDefault();
            $('#type_id, #manager').val('0');
            table.draw();
        });

        // Delete Company
        $('body').on('click', '.company-destroy', function (e) {
            e.preventDefault();
            var companyId = $(this).data('company-id');
            var tr = $(this).closest('tr');
            $.confirm({
                title: '{{ trans('actions.confirm-title') }}',
                content: ' ',
                confirmButton: '{{ trans('actions.confirm-but-yes') }}',
                cancelButton: '{{ trans('actions.confirm-but-no') }}',
                confirm: function () {
                    $.ajax({
                        url: 'companies/' + companyId,
                        type: 'delete',
                        success: function (data) {
                            table.draw();
                        }
                    });
                }
            });
        });
    });
</script>
@endpush

