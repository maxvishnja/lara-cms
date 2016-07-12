<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Laravelrus\LocalizedCarbon\LocalizedCarbon;
use Sentinel\Repositories\Group\SentinelGroupRepositoryInterface;
use Sentinel\Repositories\User\SentinelUserRepositoryInterface;
use App\User;
use Yajra\Datatables\Datatables;

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

    /**
     * Get history for datatables
     *
     * @param $userId
     * @return mixed
     */
    public function getUserHistory($userId)
    {
        $getHistory = \Venturecraft\Revisionable\Revision::where('user_id', $userId)->get();
        $dataHistory = [];
        if ($getHistory) {
            foreach ($getHistory as $item) {
                // Get User
                $user = $this->userRepository->retrieveById($item->user_id);

                // Get record name
                $className = $item->revisionable_type;
                $revisionableName = $className::findOrFail($item->revisionable_id);

                $obj = new \stdClass;
                $obj->id = $item->id;
                $obj->text = trans('revision.edit-user', [
                    'First_name' => $user->first_name,
                    'Last_name' => $user->last_name,
                    'record_name' => $revisionableName->name,
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
}
