<?php

namespace Impalago\TasksManager\Models;

use Illuminate\Database\Eloquent\Model;

class TaskTime extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'task_time';

    protected $fillable = [
        'task_id', 'status'
    ];

}
