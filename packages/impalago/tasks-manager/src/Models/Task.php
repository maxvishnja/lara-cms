<?php

namespace Impalago\TasksManager\Models;

use Illuminate\Database\Eloquent\Model;
use Impalago\TasksManager\Models\TaskFile;

class Task extends Model
{
    protected $fillable = [
        'company_id', 'name', 'description', 'status', 'priority', 'deadline'
    ];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function files()
    {
        return $this->hasMany('Impalago\TasksManager\Models\TaskFile');
    }
}
