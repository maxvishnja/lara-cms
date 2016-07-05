<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests;
use App\Http\Requests\CompaniesRequest;
use Intervention\Image\Facades\Image;
use Sentinel\Repositories\User\SentinelUserRepositoryInterface;
use App\Http\Controllers\UsersController;

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
        $companies = Company::all();
        return view('modules/companies.index', ['companies' => $companies]);
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
        return redirect()->route('companies.index');
    }


}
