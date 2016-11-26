<?php

namespace App\Http\Controllers\Server;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\User;

class ServerManagerController extends Controller
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
        $server_config = DB::table('server_config')->paginate();

        return view('server.servermanager', ['server_config' => $server_config])->render();
    }

    public function edit($id) {
        return '';
        // Get role by roledid
        $role = DB::table('roles')->where('roles.id', '=', $id)->paginate();

        // Get perms for roleid
        $perms = DB::table('roles')
            ->rightJoin('role_has_permissions', 'roles.id', '=', 'role_has_permissions.role_id')
            ->rightJoin('permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
            ->select('permissions.name as permname')
            ->where('roles.id', '=', $id)
            ->get();

        // Get all roles
        $allPerms = DB::table('permissions')->paginate();

        $rolePerms = [];

        // push all user roles into an array
        foreach ($perms as $perm) {
            array_push($rolePerms, $perm->permname);
        }

        return view('admin.editgroup', ['role' => $role[0], 'perms' => $allPerms, 'rolePerms' => $rolePerms])->render();
    }

    public function saveEdit(Request $request) {
        return '';

        // Get POST vars
        $groupname = $request->input('groupname');
        $count = $request->input('count');

        // Push all checked perm ids into $perms
        $permsOn = [];
        $permsOff = [];

        // Find the role
        $role = Role::where('name','like',$groupname)->first();

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
        return '';

        $groupname = $request->input('groupname');

        $role = Role::create(['name' => $groupname]);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($role)
            ->log('INFO: '.Auth::user()->name.' added the Group '.$role->name.'!');

        return redirect('groupmanager');
    }

    public function delGroup(Request $request) {
        return '';
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