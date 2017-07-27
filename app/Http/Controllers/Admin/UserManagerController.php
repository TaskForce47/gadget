<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Models\Role;
use App\Http\Models\User;

class UserManagerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // All users
        $users = User::paginate();

        return view('admin.userManager', ['users' => $users])
            ->with('currentTreeView', 'admin')->with('currentMenuView', 'userManager')
            ->render();
    }

    public function edit($id) {
        // Get users by userid
        $user = User::findOrFail($id);

        // Get all roles
        $roles = Role::all();

        return view('admin.editUser', ['user' => $user, 'roles' => $roles])
            ->with('currentTreeView', 'admin')->with('currentMenuView', 'userManager')
            ->render();
    }

    public function saveEdit(Request $request) {

        $user = User::findOrFail($request->input('userId'));

        // Get POST vars
        $user->name = $request->input('username');
        $user->save();

        $addedRoles = [];
        $removedRoles = [];

        foreach (Role::all() as $role) {
            if($request->input('role_'. $role->id)) {
                if(!$user->hasRole($role)) {
                    $user->assignRole($role);
                    array_push($addedRoles, $role->name);
                }
            } else {
                $user->removeRole($role);
                array_push($removedRoles, $role->name);
            };
        }

        $addedRoles = emptyArray($addedRoles) ? 'nothing' : implode(",",$addedRoles);
        $removedRoles = emptyArray($removedRoles) ? 'nothing' : implode(",",$removedRoles);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($user)
            ->log('INFO: '.Auth::user()->name.' added '.$addedRoles.' roles and '.
                'removed '.$removedRoles.' roles for '.$user->name.'!');

        return redirect('users');
    }
}
