@extends(config('tasks.extend_view'))

{{-- Web site Title --}}
@section('title')
    @parent
    @lang('tasks::tasks.main-title')
@stop

{{-- Content --}}
@section('content')

    @include('tasks::notifications')

    <div class="row tasks-index">
        <div class='page-header text-right'>
            <a class='btn btn-success ajax-popup-link'
               href="{{ route('tasks.create') }}">{!! trans('tasks::actions.add') !!}</a>
        </div>
    </div>

    <table class="table table-striped jambo_table" id="tasks-table">
        <thead>
        <tr>
            <th>Id</th>
            <th>{{ trans('tasks::tasks.table-head.name') }}</th>
            <th>{{ trans('tasks::tasks.table-head.priority') }}</th>
            <th>{{ trans('tasks::tasks.table-head.deadline') }}</th>
            <th>{{ trans('tasks::tasks.table-head.initiator') }}</th>
            <th>{{ trans('tasks::tasks.table-head.actions') }}</th>
        </tr>
        </thead>
    </table>
@stop

@push('styles')
<link href="{{ asset('css/datatables.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/tasks/css/tasks.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<script src="{{ asset('js/datatables.js') }}"></script>
<script src="{{ asset('vendor/tasks/js/tasks.js') }}"></script>
<script>
    $(function () {
        $('.ajax-popup-link').magnificPopup({
            type: 'ajax',
            alignTop: true,
            removalDelay: 500,
            mainClass: 'mfp-fade',
            callbacks: {
                ajaxContentAdded: function (mfpResponse) {
                    $(".select-multiple").select2({
                        placeholder: "{{ trans('tasks::tasks.form-fields.responsible') }}",
                        language: {
                            noResults: function () {
                                return "{{ trans('tasks::tasks.form-fields.responsible-no-result') }}";
                            }
                        },
                    });

                    jQuery.datetimepicker.setLocale('{{ trans('tasks::tasks.datepicker-locale') }}');
                    $('#deadline').datetimepicker({
                        format: 'Y-m-d H:i',
                    });
                }
            }
        });

        var table = $('#tasks-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{!! route('tasks.data') !!}',
                data: function (d) {
//                    d.type_id = $('#type_id').val() == 0 ? '' : $('#type_id').val();
//                    d.manager = $('#manager').val() == 0 ? '' : $('#manager').val();
                }
            },
            responsive: true,
            columns: [
                {"width": "6%"},
                {"width": "19%"},
                {"width": "10%"},
                {"width": "14%"},
                {"width": "10%"},
                {
                    "width": "16%",
                    orderable: false,
                    searchable: false,
                    className: "text-center"
                }
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

                $('.task-popup').magnificPopup({
                    type: 'ajax',
                    alignTop: true,
                    removalDelay: 500,
                    mainClass: 'mfp-fade',
                    callbacks: {
                        ajaxContentAdded: function (mfpResponse) {
                            $(".select-multiple").select2({
                                placeholder: "{{ trans('tasks::tasks.form-fields.responsible') }}",
                                language: {
                                    noResults: function () {
                                        return "{{ trans('tasks::tasks.form-fields.responsible-no-result') }}";
                                    }
                                },
                            });

                            jQuery.datetimepicker.setLocale('{{ trans('tasks::tasks.datepicker-locale') }}');
                            $('#deadline').datetimepicker({
                                format: 'Y-m-d H:i',
                            });

                            var myDropzone = new Dropzone(".dropzone", {
                                dictDefaultMessage: '{{ trans('actions.dropzone-default-message') }}',
                                dictRemoveFile: '{{ trans('actions.delete') }}',
                                addRemoveLinks: true,
                                clickable: true
                            });

                            myDropzone.on("removedfile", function(file) {
                                var fileId = file.xhr.response;
                                destroyFile(fileId);
                            });

                            $('.file-destroy').on('click', function() {
                                var fileId = $(this).data('file-id');
                                var tr = $(this).closest('tr');
                                $.confirm({
                                    title: '{{ trans('actions.confirm-title') }}',
                                    content: ' ',
                                    confirmButton: '{{ trans('actions.confirm-but-yes') }}',
                                    cancelButton: '{{ trans('actions.confirm-but-no') }}',
                                    confirm: function () {
                                        destroyFile(fileId);
                                        tr.remove();
                                    }
                                });
                            });
                        }
                    }
                });
            }
        });


        $('#tasks-table tbody').on('click', '.task-item', function () {
            table.$('.task-item.selected').removeClass('selected');
            $(this).addClass('selected');
        });

        // Delete task
        $('body').on('click', '.task-destroy', function (e) {
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
                        url: 'tasks/' + companyId,
                        type: 'delete',
                        success: function (data) {
                            table.draw();
                        }
                    });
                }
            });
        });

        function destroyFile (fileId) {
            $.ajax({
                url: '{{ route('tasks.destroy-drop-file') }}/' + fileId,
                type: 'post',
                success: function (data) {
                    table.draw();
                }
            });
        }
    });
</script>
@endpush