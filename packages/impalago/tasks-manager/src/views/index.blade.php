@extends(config('tasks.extend_view'))

{{-- Web site Title --}}
@section('title')
    @parent
    @lang('tasks::tasks.main-title')
@stop

{{-- Content --}}
@section('content')

    <div class="row">
        <div class='page-header text-right'>
            <a class='btn btn-success'
               href="{{ route('sentinel.users.create') }}">{!! trans('tasks::actions.add') !!}</a>
        </div>
    </div>

@stop
