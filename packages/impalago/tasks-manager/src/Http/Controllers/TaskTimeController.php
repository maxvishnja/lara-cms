<?php

namespace Impalago\TasksManager\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Impalago\TasksManager\Models\TaskTime;
use Sentry;
use Illuminate\Support\Facades\Storage;
use Impalago\TasksManager\Models\Task;

class TaskTimeController extends Controller
{

    public function __construct()
    {
        $this->userId = Sentry::getUser()->id;
        $this->status = config('tasks.status_task');
        $this->middleware('sentry.auth');
    }

    /**
     * @param $id
     * @return string
     */
    public function start($id)
    {
        $newRec = new TaskTime;
        $newRec->task_id = $id;
        $newRec->user_id = $this->userId;
        $newRec->status = 1;
        if ($newRec->save()) {
            return 'start';
        }

        return 'error';
    }

    /**
     * @param $id
     * @return string
     */
    public function pause($id)
    {
        $newRec = new TaskTime;
        $newRec->task_id = $id;
        $newRec->user_id = $this->userId;
        $newRec->status = 2;
        if ($newRec->save()) {
            return 'pause';
        }

        return 'error';
    }

    /**
     * @param $id
     * @return string
     */
    public function end($id)
    {
        return 'end';
    }

    public function checkStatus($id)
    {
        $lastRecordTime = TaskTime::where('task_id', $id)->orderBy('created_at', 'desc')->first();
        if ($lastRecordTime) {
            return $lastRecordTime->status;
        }
        return 0;
    }


}
