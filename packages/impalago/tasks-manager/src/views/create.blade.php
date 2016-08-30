<div class="container white-popup">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>{{ trans('tasks::tasks.create-title') }}</h3>
            </div>

            <h4 class="mt20">Прикрепить файлы</h4>
            <hr>

            {!! Form::open(['route' => 'tasks.store', 'class' => '']) !!}

            @include('tasks::fieldsForm')

            {!! Form::close() !!}
        </div>
    </div>
</div>