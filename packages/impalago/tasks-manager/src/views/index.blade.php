@extends(config('tasks.extend_view'))

{{-- Web site Title --}}
@section('title')
    @parent
    @lang('tasks::tasks.main-title')
@stop

{{-- Content --}}
@section('content')

    <div class="row tasks-index">
        <div class='page-header text-right'>
            <a class='btn btn-success ajax-popup-link'
               href="{{ route('tasks.create') }}" >{!! trans('tasks::actions.add') !!}</a>
        </div>
    </div>
@stop

@push('styles')
<link href="{{ asset('vendor/tasks/css/tasks.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<script src="{{ asset('vendor/tasks/js/tasks.js') }}"></script>
@endpush