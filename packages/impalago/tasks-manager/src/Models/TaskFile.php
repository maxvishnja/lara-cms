<?php

namespace Impalago\TasksManager\Models;

use Illuminate\Database\Eloquent\Model;

class TaskFile extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'task_file';

    protected $fillable = [
        'task_id', 'file', 'original_name'
    ];
}
