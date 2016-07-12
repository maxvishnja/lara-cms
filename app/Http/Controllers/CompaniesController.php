<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests;
use App\Http\Requests\CompaniesRequest;
use Cartalyst\Sentry\Facades\Native\Sentry;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Laravelrus\LocalizedCarbon\LocalizedCarbon;
use Sentinel\Repositories\User\SentinelUserRepositoryInterface;
use App\Http\Controllers\UsersController;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class CompaniesController extends Controller
{

    public function __construct(
        SentinelUserRepositoryInterface $userRepository,
        UsersController $users
    )
    {
        $this->userRepository = $userRepository;
        $this->users = $users;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $managers = $this->users->getAllManagersForForm();
        return view('modules/companies.index', ['managers' => $managers]);
    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function getData(Request $request)
    {
        $companies = DB::table('companies')
            ->leftJoin('users', 'companies.manager', '=', 'users.id')
            ->select([
                'companies.id',
                'companies.name',
                'companies.email',
                'companies.phone',
                'companies.type_id',
                DB::raw('concat(users.first_name, " ", users.last_name) as full_name'),
            ]);

        return Datatables::of($companies)
            ->filter(function ($query) use ($request) {
                if ($request->has('type_id')) {
                    $query->where('companies.type_id', '=', $request->get('type_id'));
                }
                if ($request->has('manager')) {
                    $query->where('companies.manager', '=', $request->get('manager'));
                }
            })
            ->editColumn('type_id', function ($company) {
                $typeArr = config('company.types_of_companies');
                return $typeArr[$company->type_id];
            })
            ->addColumn('action', function ($company) {
                return '
                    <a class="btn btn-primary btn-xs" href=" ' . route("companies.show", array($company->id), false) . '" title="' . trans("actions.view") . '">
                        <i class="fa fa-user"> </i> ' . trans("actions.view") . '</a>

                     <a class="btn btn-success btn-xs" type="button" href="' . route("companies.edit", array($company->id), false) . '" title="' . trans("actions.edit") . '"><i class="fa fa-pencil"></i></a>

                    <a class="btn btn-danger btn-xs company-destroy" href=""
                        href="#"
                        data-company-id="' . $company->id . '"
                        title="' . trans("actions.delete") . '">
                        <i class="fa fa-remove"> </i>
                    </a>
                ';
            })
            ->make();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $managers = $this->users->getAllManagersForForm();
        return view('modules/companies.create', ['managers' => $managers]);
    }

    /**
     * @param CompaniesRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CompaniesRequest $request)
    {
        Company::create($request->all());
        return redirect()->route('companies.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $company = Company::findOrfail($id);
        $manager = $this->userRepository->retrieveById($company->manager);
        return view('modules/companies.show', ['company' => $company, 'manager' => $manager]);
    }

    /**
     * Get history for datatables
     *
     * @param $companyId
     * @return mixed
     */
    public function getCompanyHistory($companyId)
    {
        $company = Company::findOrfail($companyId);
        $getHistory = $company->revisionHistory;
        $dataHistory = [];
        if ($getHistory) {
            foreach ($getHistory as $item) {
                $user = $this->userRepository->retrieveById($item->user_id);
                $obj = new \stdClass;
                $obj->id = $item->id;
                $obj->text = trans('revision.edit', [
                    'First_name' => $user->first_name,
                    'Last_name' => $user->last_name,
                    'fieldName' => array_get(trans('revision.companies'), $item->key),
                    'oldValue' => $item->oldValue(),
                    'newValue' => $item->newValue()
                ]);
                $obj->date = LocalizedCarbon::instance($item->created_at)->diffForHumans();
                $dataHistory[] = $obj;
            }
        }
        $historyCollection = new Collection($dataHistory);
        return Datatables::of($historyCollection)->make(true);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $company = Company::findOrfail($id);
        $managers = $this->users->getAllManagersForForm();
        return view('modules/companies.edit', ['company' => $company, 'managers' => $managers]);
    }

    /**
     * @param CompaniesRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CompaniesRequest $request, $id)
    {
        // Gather Input
        $data = $request->all();

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $avatar = time() . $file->getClientOriginalName();
            Image::make($file)->resize(300, 300)->save(public_path('upload/avatars/' . $avatar));
            $data['avatar'] = 'upload/avatars/' . $avatar;
        }

        $company = Company::findorfail($id);
        $company->update($data);
        return redirect()->route('companies.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Company::destroy($id);
        return 'success';
    }


}
