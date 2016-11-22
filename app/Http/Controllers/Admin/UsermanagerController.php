<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        // Check Auth
        if(Auth::check() && Auth::user()->hasRole('admin')) {

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
        } else {
            return redirect()->back();
        }
    }

    public function getUsers() {
        if(Auth::check() && Auth::user()->hasRole('admin')) {
            $users = DB::table('users')->paginate();
            return $users->toJson();
        } else {
            return redirect()->back();
        }
    }

    public function edit($id) {
        if(Auth::check() && Auth::user()->hasRole('admin')) {
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

            // push alle user roles into an array
            foreach ($roles as $role) {
                array_push($userRoles, $role->rolename);
            }

            var_dump($userRoles);
            var_dump(is_array($userRoles));
            var_dump(in_array('admin', $userRoles));
           //var_dump($allRoles);

            return view('admin.edituser', ['user' => $users[0], 'roles' => $allRoles, 'userRoles' => $userRoles])->render();
        } else {
            return redirect()->back();
        }
    }
}
