<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Models\Permission;
use App\Http\Models\Role;
use Carbon\Carbon;

class GroupManagerController extends Controller
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
        $roles = Role::all();

        return view('admin.groupManager', ['roles' => $roles])
            ->with('currentTreeView', 'admin')->with('currentMenuView', 'groupManager')
            ->render();
    }

    public function edit($id) {
        $permissions = Permission::all();

        if($id == 0) {
            $role = new Role();
        } else {
            $role = Role::findOrFail($id);
        }

        return view('admin.editGroup', ['role' => $role, 'permissions' => $permissions])
            ->with('currentTreeView', 'admin')->with('currentMenuView', 'groupManager')
            ->render();
    }

    public function saveEdit(Request $request) {

        // Get POST vars
        $id = $request->input('roleId');

        $role = null;

        if($id == null || $id == 0) {
            $role = new Role();
            $role->created_at = Carbon::now();
        } else {
            $role = Role::findOrFail($id);
        }

        // Get POST vars
        $role->name = $request->input('rolename');
        $role->updated_at = Carbon::now();
        $role->save();

        $addedPerms = [];
        $removedPerms = [];

        foreach (Permission::all() as $permission) {
            var_dump($request->input('permission_'. $permission->id));
            if($request->input('permission_'. $permission->id)) {
                if(!$role->hasPermissionTo($permission)) {
                    $role->givePermissionTo($permission);
                    array_push($addedPerms, $permission->name);
                }
            } else {
                $role->revokePermissionTo($permission);
                array_push($removedPerms, $permission->name);
            };
        }

        $addedPerms = emptyArray($addedPerms) ? 'nothing' : implode(",",$addedPerms);
        $removedPerms = emptyArray($removedPerms) ? 'nothing' : implode(",",$removedPerms);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($role)
            ->log('INFO: '.Auth::user()->name.' added '.$addedPerms.' permissions and '.
                'removed '.$removedPerms.' permissions for '.$role->name.'!');

        return redirect('groups');
    }

    public function delGroup(Request $request) {
        $roleid = $request->input('roleid');

        $role = Role::find($roleid);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($role)
            ->log('INFO: '.Auth::user()->name.' deleted the Group '.$role->name.'!');

        $role->forceDelete();

        return redirect('groups');
    }
}
