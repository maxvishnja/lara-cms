@extends('layouts.main')

{{-- Web site Title --}}
@section('title')
    @parent
    @lang('Tickets::tickets.title')
@stop

{{-- Content --}}
@section('content')

    <div class="row">
        <div class="well">
            @include('Tickets::blocks.nav')
        </div>
    </div>

@stop