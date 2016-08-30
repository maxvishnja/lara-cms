<?php

namespace Impalago\TasksManager\Http\Controllers;

use App\Company;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Impalago\TasksManager\Models\TaskFile;
use Sentry;
use Illuminate\Http\Request;
use Impalago\TasksManager\Models\Task;
use Sentinel\Repositories\User\SentinelUserRepositoryInterface;

use App\Http\Requests;
use Yajra\Datatables\Datatables;

class TasksController extends Controller
{

    public function __construct(
        SentinelUserRepositoryInterface $userRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->userId = Sentry::getUser()->id;
        $this->middleware('sentry.auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tasks::index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $getUsers = $this->userRepository->all();
        $users = $this->getUsers();
        $companies = $this->getCompanies();

        return view('tasks::create', ['users' => $users, 'companies' => $companies]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = new Task;
        $task->initiator_id = Sentry::getUser()->id;
        $task->company_id = $request->company_id ? $request->company_id : null;
        $task->name = $request->name;
        $task->description = $request->description;
        $task->status = 0;
        $task->priority = $request->priority;
        $task->deadline = $request->deadline;
        $task->save();

        $taskResponsible = Task::find($task->id);
        $taskResponsible->users()->attach($request->responsible);

        $request->session()->flash('success', trans('tasks.message.create', ['name' => $task->name]));
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);

        $company = null;
        if ($task->company_id) {
            $company = Company::findOrFail($task->company_id);
        }

        return view('tasks::show', ['task' => $task, 'company' => $company]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $task->responsible = array_pluck($task->users, 'id');
        $files = $task->files;
        $users = $this->getUsers();
        $companies = $this->getCompanies();
        return view('tasks::edit', ['task' => $task, 'users' => $users, 'companies' => $companies, 'files' => $files]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        $task->company_id = $request->company_id ? $request->company_id : null;
        $task->name = $request->name;
        $task->description = $request->description;
        $task->status = 0;
        $task->priority = $request->priority;
        $task->deadline = $request->deadline;
        $task->save();

        $taskResponsible = Task::find($id);
        $taskResponsible->users()->sync($request->responsible);

        $request->session()->flash('success', trans('tasks.message.update', ['name' => $task->name]));
        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $task = Task::find($id);
        Task::destroy($id);
        $request->session()->flash('success', trans('tasks.message.destroy', ['name' => $task->name]));
        return 'success';
    }

    /**
     * @return array
     */
    public function getUsers()
    {
        $getUsers = $this->userRepository->all();
        $users = [];
        foreach ($getUsers as $key => $user) {
            $users[$user->id] = $user->first_name . ' ' . $user->last_name;
        }
        return $users;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getCompanies()
    {
        return Company::all();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getData(Request $request)
    {
        if (Sentry::getUser()->hasAccess('admin')) {
            $tasks = DB::table('tasks')
                ->leftJoin('users', 'tasks.initiator_id', '=', 'users.id')
                ->select([
                    'tasks.id',
                    'tasks.name',
                    'tasks.initiator_id',
                    'tasks.priority',
                    'tasks.deadline',
                    DB::raw('concat(users.first_name, " ", users.last_name) as full_name'),
                ]);
        } else {
            $tasks = DB::table('tasks')
                ->leftJoin('users', 'users.id', '=', 'tasks.initiator_id')
                ->join('task_user', 'task_user.task_id', '=', 'tasks.id')
                ->where('tasks.initiator_id', $this->userId)
                ->orWhere('task_user.user_id', '=', $this->userId)
                ->select([
                    'tasks.id',
                    'tasks.name',
                    'tasks.initiator_id',
                    'tasks.priority',
                    'tasks.deadline',
                    DB::raw('concat(users.first_name, " ", users.last_name) as full_name'),
                ]);
        }

        return Datatables::of($tasks)
            ->editColumn('priority', function ($task) {
                $typeArr = config('tasks.priority_task');
                return $typeArr[$task->priority];
            })
            ->addColumn('action', function ($task) {

                $buttons = '<a class="btn btn-primary btn-xs task-popup" href="' . route("tasks.show", array($task->id), false) . '" title="' . trans("actions.view") . '">
                        <i class="fa fa-user"> </i> ' . trans("actions.view") . '</a>';

                if ($task->initiator_id == $this->userId) {
                    $buttons .= '
                        <a class="btn btn-success btn-xs task-popup" type="button" href="' . route("tasks.edit", array($task->id), false) . '" title="' . trans("actions.edit") . '"><i class="fa fa-pencil"></i></a>

                        <a class="btn btn-danger btn-xs task-destroy" href=""
                            href="#"
                            data-company-id="' . $task->id . '"
                            title="' . trans("actions.delete") . '">
                            <i class="fa fa-remove"> </i>
                        </a>
                    ';
                }

                return $buttons;
            })
            ->removeColumn('initiator_id')
            ->setRowClass('task-item')
            ->setRowAttr([
                'data-task-id' => '{{$id}}',
            ])
            ->make();
    }
}
