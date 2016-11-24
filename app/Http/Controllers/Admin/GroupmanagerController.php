<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Spatie\Permission\Models\Role;
use App\User;

class GroupmanagerController extends Controller
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
        // All roles
        $roles = DB::table('roles')->paginate();

        // All roles
        $perms = DB::table('roles')
            ->join('role_has_permissions', 'roles.id', '=', 'role_has_permissions.role_id')
            ->join('permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
            ->select('roles.id as roleid', 'permissions.name as permname', 'roles.name as rolename')
            ->get();

        var_dump($perms);

        // Push all roles into user->roles
        foreach ($roles as $role) {

            $role->perms = [];
            foreach ($perms as $perm) {
                if($role->name == $perm->rolename) {
                    array_push($role->perms, $perm);
                }
            }
        }

        var_dump($roles[0]);

        return view('admin.groupmanager', ['roles' => $roles])->render();
    }

    public function edit($id) {
        // Get users by userid
        $users = DB::table('users')->where('users.id', '=', $id)->paginate();

        // Get roles for userid
        $roles = DB::table('users')
            ->rightJoin('user_has_roles', 'users.id', '=', 'user_has_roles.user_id')
            ->rightJoin('roles', 'roles.id', '=', 'user_has_roles.role_id')
            ->select('roles.name as rolename')
            ->where('users.id', '=', $id)
            ->get();

        // Get all roles
        $allRoles = DB::table('roles')->paginate();

        $userRoles = [];

        // push all user roles into an array
        foreach ($roles as $role) {
            array_push($userRoles, $role->rolename);
        }

        return view('admin.edituser', ['user' => $users[0], 'roles' => $allRoles, 'userRoles' => $userRoles])->render();
    }

    public function saveEdit(Request $request) {

        // Get POST vars
        $username = $request->input('username');
        $count = $request->input('count');

        // Push all checked role ids into $roles
        $rolesOn = [];
        $rolesOff = [];

        // Find the user
        $user = User::where('name','like',$username) -> first();

        // push ticket and unticket roles into their arrays
        for($i = 1; $i < $count + 2; $i++) {
            $curRole = $request->input('roleId'.$i);
            if($curRole == 'on') {
                array_push($rolesOn, Role::find($i)->name);
            }
            else {
                array_push($rolesOff, Role::find($i)->name);
            }
        }

        $addedRolesLog = [];
        $removedRolesLog = [];

        // assing missing roles
        foreach ($rolesOn as $role) {
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
            ->log('INFO: '.Auth::user()->name.' added '.implode(",",$addedRolesLog).' roles and'.
                'removed '.implode(",",$removedRolesLog).' roles for '.$user->name.'!');

        return redirect('usermanager');
    }
}
