<div class="container white-popup">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>{{ trans('tasks::tasks.edit-title') }}</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            {!! Form::model($task, ['route' => ['tasks.update', $task->id], 'method' => 'put', 'class' => '']) !!}

            @include('tasks::fieldsForm')

            {!! Form::close() !!}

        </div>
        <div class="col-md-4">

            <h4 class="mt0">Прикрепленные файлы</h4>

            @if(isset($files))
                <table class="table table-hover files-table">
                    @foreach($files as $file )
                        <tr>
                            <td>{{ $file['original_name'] }}</td>
                            <td>
                                <a class="btn btn-success btn-xs" href="{{ route('tasks.download-file', [ $file['file'] ]) }}" data-original-title="{{ trans('actions.download')}}"><i class="fa fa-download"></i></a>
                                <a class="btn btn-danger btn-xs file-destroy" href="#" data-file-id="{{ $file['id'] }}" data-original-title="{{ trans('actions.destroy')}}"><i class="fa fa-remove"></i></a>
                            </td>
                        </tr>

                    @endforeach
                </table>
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

    <div class="row">

    </div>
</div>