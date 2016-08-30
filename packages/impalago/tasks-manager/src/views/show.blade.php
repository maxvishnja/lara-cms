@inject('taskTime', 'Impalago\TasksManager\Http\Controllers\TaskTimeController')

<div class="container white-popup task-show" >
    <div class="row">
        <div class="col-md-12">
            <br>

            <div class="task-actions">

                    <a class="btn btn-success task-start {{ $taskTime->checkStatus($task->id) == '1' ? 'hide' : '' }}"
                       href="#"
                       data-method="post"
                       data-action="{{ route('tasks.work-start', $task->id) }}">{{ $taskTime->checkStatus($task->id) == '0' ? 'Начать выполнение' : 'Продолжить работу' }}</a>

                    <a class="btn btn-success task-pause {{ ($taskTime->checkStatus($task->id) == '0' or $taskTime->checkStatus($task->id) == '2') ? 'hide' : '' }}"
                       href="#"
                       data-method="post"
                       data-action="{{ route('tasks.work-pause', $task->id) }}">Приостановить</a>

                <a class="btn btn-success task-end"
                   href="#"
                   data-method="post"
                   data-action="{{ route('tasks.work-end', $task->id) }}">Завершить</a>
            </div>

            <div class="panel panel-warning">
                <div class="panel-heading"><h2>{{ $task->name }}</h2></div>
                <div class="panel-body">

                    {{ $task->description }}

                    @if(isset($company->name))
                        <hr><h4>Компания: {{ $company->name }}</h4>
                    @endif
                </div>
            </div>


        </div>
    </div>
</div>