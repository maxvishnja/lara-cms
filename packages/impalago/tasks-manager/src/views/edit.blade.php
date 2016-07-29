<div class="container white-popup">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>{{ trans('tasks::tasks.edit-title') }}</h3>
            </div>

            {!! Form::model($task, ['route' => ['tasks.update', $task->id], 'method' => 'put', 'class' => '']) !!}

            @include('tasks::fieldsForm')

            {!! Form::close() !!}

            <hr>

            <h4 class="mt20">Прикрепленные файлы</h4>

            @if(isset($files))
                @foreach($files as $file )
                    <a href="{{ route('tasks.download-file', [ $file['file'] ]) }}">{{ $file['original_name'] }}</a>
                @endforeach
            @else
                <p>Нет прикрепленных файлов</p>
            @endif

            <hr>

            <button type="button" class="btn btn-danger" data-toggle="collapse" data-target="#dropzone">{{ trans('actions.add-files') }}</button>

            <div id="dropzone" class="collapse">
                {!! Form::open(['route' => ['tasks.store-files', $task->id], 'class' => 'dropzone']) !!}
                {!! Form::close() !!}
            </div>

        </div>
    </div>
</div>