<div class="container white-popup task-show" >
    <div class="row">
        <div class="col-md-12">
            <br>

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