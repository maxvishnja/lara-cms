<?php

namespace App\Http\Controllers;

use App\Customers;
use App\Http\Requests;
use App\Http\Requests\CustomerRequest;
use Intervention\Image\Facades\Image;
use Sentinel\Repositories\Group\SentinelGroupRepositoryInterface;
use Sentinel\Repositories\User\SentinelUserRepositoryInterface;
use App\Http\Controllers\UsersController;

class CustomersController extends Controller
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
        $customers = Customers::all();
        return view('modules/customers.index', ['customers' => $customers]);
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $managers = $this->users->getAllManagersForForm();
        return view('modules/customers.create', ['managers' => $managers]);
    }


    /**
     * @param UserCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CustomerRequest $request)
    {
        Customers::create($request->all());
        return redirect()->route('customers.index');
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $customer=Customers::findOrfail($id);

        $manager=$this->userRepository->retrieveById($customer->manager);

        return view('modules/customers.show',['customer'=>$customer, 'manager'=>$manager]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $customer=Customers::findOrfail($id);
        $managers = $this->users->getAllManagersForForm();
        return view('modules/customers.edit',['customer'=>$customer, 'managers'=>$managers]);
    }


    /**
     * @param CustomerRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CustomerRequest $request, $id)
    {
        // Gather Input
        $data = $request->all();

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $avatar = time() . $file->getClientOriginalName();
            Image::make($file)->resize(300, 300)->save(public_path('upload/avatars/' . $avatar));
            $data['avatar'] = 'upload/avatars/' . $avatar;
        }

        $customer = Customers::findorfail($id);

        $customer->update($data);

        return redirect()->route('customers.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Customers::destroy($id);
        return redirect()->route('customers.index');
    }


}
