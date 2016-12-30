<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Models\Permission;
use App\Http\Models\Role;

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
        $roles = Role::paginate();


        return view('admin.groupmanager', ['roles' => $roles])->render();
    }

    public function edit($id) {
        // Get role by roledid
        $role = Role::findOrFail($id);

        // Get all roles
        $allPerms = Permission::all();

        return view('admin.editgroup', ['role' => $role, 'allPerms' => $allPerms])->render();
    }

    public function saveEdit(Request $request) {

        // Get POST vars
        $groupname = $request->input('groupname');
        $count = $request->input('count');

        // Push all checked perm ids into $perms
        $permsOn = [];
        $permsOff = [];

        // Find the role
        $role = Role::findByName($groupname);

        // push ticket and unticket perms into their arrays
        for($i = 1; $i < $count + 2; $i++) {
            $curPerm = $request->input('permId'.$i);
            if($curPerm == 'on') {
                array_push($permsOn, Permission::find($i)->name);
            }
            else {
                array_push($permsOff, Permission::find($i)->name);
            }
        }

        $addedPermsLog = [];
        $removedPermsLog = [];

        // add missing perms
        foreach ($permsOn as $perm) {
            if(!$role->hasPermissionTo($perm)) {
                $role->givePermissionTo($perm);
                array_push($addedPermsLog,$perm);
            }
        }

        // remove perms
        foreach ($permsOff as $perm) {
            if($role->hasPermissionTo($perm)) {
                $role->revokePermissionTo($perm);
                array_push($removedPermsLog,$perm);
            }
        }

        activity()
            ->causedBy(Auth::user())
            ->performedOn($role)
            ->log('INFO: '.Auth::user()->name.' added '.implode(",",$addedPermsLog).' permissions and '.
                'removed '.implode(",",$removedPermsLog).' permissions for '.$role->name.'!');

        return redirect('groupmanager');
    }

    public function addGroup(Request $request) {

        $groupname = $request->input('groupname');

        $role = Role::create(['name' => $groupname]);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($role)
            ->log('INFO: '.Auth::user()->name.' added the Group '.$role->name.'!');

        return redirect('groupmanager');
    }

    public function delGroup(Request $request) {
        $roleid = $request->input('roleid');

        $role = Role::find($roleid);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($role)
            ->log('INFO: '.Auth::user()->name.' deleted the Group '.$role->name.'!');

        $role->forceDelete();

        return redirect('groupmanager');
    }
}
