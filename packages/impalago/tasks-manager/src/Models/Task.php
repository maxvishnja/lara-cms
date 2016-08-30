<?php

namespace Impalago\TasksManager\Models;

use Illuminate\Database\Eloquent\Model;
use Impalago\TasksManager\Models\TaskFile;

class Task extends Model
{
    protected $fillable = [
        'company_id', 'name', 'description', 'status', 'priority', 'deadline'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function files()
    {
        return $this->hasMany('Impalago\TasksManager\Models\FileTask');
    }

    /**
     * Получить комментарии к записи.
     */
    public function time()
    {
        return $this->hasMany('Impalago\TasksManager\Models\TaskTime');
    }
}
