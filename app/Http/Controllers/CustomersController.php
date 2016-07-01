<?php

namespace App\Http\Controllers;

use App\Customers;
use App\Http\Requests;
use App\Http\Requests\CustomerUpdateRequest;
use App\Http\Requests\CustomerCreateRequest;
use Intervention\Image\Facades\Image;
use Sentinel\Repositories\Group\SentinelGroupRepositoryInterface;
use Sentinel\Repositories\User\SentinelUserRepositoryInterface;

class CustomersController extends Controller
{

    public function __construct(
        SentinelUserRepositoryInterface $userRepository,
        SentinelGroupRepositoryInterface $groupRepository
    )
    {
        $this->userRepository  = $userRepository;
        $this->groupRepository = $groupRepository;
        $this->middleware('sentry.admin');
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $customers = Customers::all();
        return view('modules/customers.index',['customers'=>$customers]);

    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $users = $this->userRepository->all();
        foreach($users as $key=>$value)
        {
            if($value->hasAccess('admin') or $value->hasAccess('manager')){
              $managers[$key]=$value;
            }
        }
        return view('modules/customers.create',['managers'=>$managers]);
    }


    /**
     * @param UserCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CustomerCreateRequest $request)
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
        $users = $this->userRepository->all();
        foreach($users as $key=>$value)
        {
            if($value->hasAccess('admin') or $value->hasAccess('manager')){
                $managers[$key]=$value;
            }
        }
        return view('modules/customers.edit',['customer'=>$customer, 'managers'=>$managers]);
    }


    /**
     * @param CustomerUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CustomerUpdateRequest $request, $id)
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
