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
        $users = DB::table('users')->paginate();

        // All roles
        $roles = DB::table('users')
                        ->join('user_has_roles', 'users.id', '=', 'user_has_roles.user_id')
                        ->join('roles', 'roles.id', '=', 'user_has_roles.role_id')
                        ->select('users.id as userid', 'users.name as username', 'roles.name as rolename')
                        ->get();

        // Push all roles into user->roles
        foreach ($users as $user) {
            $user->roles = [];
            foreach ($roles as $role) {
                if($user->name == $role->username) {
                    array_push($user->roles, $role);
                }
            }
        }

        return view('admin.usermanager', ['users' => $users])->render();
    }

    public function getUsers() {
        return response('Code 501 - Not implemented.', Response::HTTP_NOT_IMPLEMENTED);
        /*
        $users = DB::table('users')->paginate();
        return $users->toJson();
        */
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

        // assing missing roles
        foreach ($rolesOn as $role) {
            if(!$user->hasRole($role)) {
                $user->assignRole($role);
            }
        }

        // remove roles
        foreach ($rolesOff as $role) {
            if($user->hasRole($role)) {
                $user->removeRole($role);
            }
        }

        return redirect('usermanager');
    }
}
