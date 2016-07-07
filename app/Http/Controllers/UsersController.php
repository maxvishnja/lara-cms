<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Sentinel\Repositories\Group\SentinelGroupRepositoryInterface;
use Sentinel\Repositories\User\SentinelUserRepositoryInterface;

class UsersController extends Controller
{

    public function __construct(
        SentinelUserRepositoryInterface $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Get all managers for forms
     *
     * @return mixed
     */
    public function getAllManagersForForm()
    {
        $users = $this->userRepository->all();
        $managers = array(trans('actions.nothing-selected'));
        foreach ($users as $key => $user) {
            if ($user->hasAccess('admin') or $user->hasAccess('manager')) {
                $managers[$user->id] = $user->first_name . ' ' . $user->last_name;

            }
        }
        return $managers;
    }
}
