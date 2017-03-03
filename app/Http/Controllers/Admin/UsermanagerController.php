<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Models\Role;
use App\Http\Models\User;

class UsermanagerController extends Controller
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

        return view('admin.usermanager', ['users' => $users])
            ->with('currentTreeView', 'admin')->with('currentMenuView', 'usermanager')
            ->render();
    }

    public function edit($id) {
        // Get users by userid
        $user = User::findOrFail($id);

        // Get all roles
        $allRoles = Role::all();

        return view('admin.edituser', ['user' => $user, 'allRoles' => $allRoles])
            ->with('currentTreeView', 'admin')->with('currentMenuView', 'usermanager')
            ->render();
    }

    public function saveEdit(Request $request) {

        // Get POST vars
        $username = $request->input('username');
        $count = $request->input('count');

        // Push all checked role ids into $roles
        $rolesOn = [];
        $rolesOff = [];

        // Find the user
        $user = User::findByName($username);

        // push ticket and unticket roles into their arrays
        for($i = 1; $i < $count + 2; $i++) {
            $curRole = $request->input('roleId'.$i);
            if($curRole == 'on') {
                array_push($rolesOn, Role::find($i)->name);
            }
            else {
                $foundRole = Role::find($i);
                if($foundRole != null) {
                    array_push($rolesOff, Role::find($i)->name);
                } else {
                    $count++;
                }
            }
        }

        $addedRolesLog = [];
        $removedRolesLog = [];

        // assing missing roles
        foreach ($rolesOn as $role) {
            var_dump($role);
            if(!$user->hasRole($role)) {
                $user->assignRole($role);
                array_push($addedRolesLog,$role);
            }
        }

        // remove roles
        foreach ($rolesOff as $role) {
            if($user->hasRole($role)) {
                $user->removeRole($role);
                array_push($removedRolesLog,$role);
            }
        }

        activity()
            ->causedBy(Auth::user())
            ->performedOn($user)
            ->log('INFO: '.Auth::user()->name.' added '.implode(",",$addedRolesLog).' roles and '.
                'removed '.implode(",",$removedRolesLog).' roles for '.$user->name.'!');

        return redirect('usermanager');
    }
}
