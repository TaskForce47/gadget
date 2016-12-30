<?php

namespace App\Http\Controllers\Server;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Models\Permission;
use App\Http\Models\Role;

use App\Http\Models\Server_Config;

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
        $server_config = Server_Config::paginate();

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

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addServer(Request $request) {
        $serverConfig = new Server_Config;

        var_dump(intval($request->input('modpackid')));

        $serverConfig->gadget_name = $request->input('gadgetname');
        $serverConfig->name = $request->input('name');
        $serverConfig->password = $request->input('password');
        $serverConfig->admin_password = $request->input('adminpassword');
        $serverConfig->motd = $request->input('motd');
        $serverConfig->motd_interval = intval($request->input('motdinterval'));
        $serverConfig->max_players = intval($request->input('maxplayers'));
        $serverConfig->kick_duplicates = boolval($request->input('kickduplicates') == 'on' ? 1 : 0);
        $serverConfig->verify_signatures = boolval($request->input('verifysigs') == 'on' ? 1 : 0);
        $serverConfig->headless_clients = $request->input('headlessclients');
        $serverConfig->vote_mission_players = intval($request->input('votemissionp'));
        $serverConfig->vote_threshold = floatval($request->input('votethreshold'));
        $serverConfig->disable_von = boolval($request->input('disablevon') == 'on' ? 1 : 0);
        $serverConfig->von_codec_quality = intval($request->input('vonqual'));
        $serverConfig->persistent = boolval($request->input('persistent') == 'on' ? 1 : 0);
        $serverConfig->battle_eye = boolval($request->input('battleye') == 'on' ? 1 : 0);
        $serverConfig->max_ping = intval($request->input('maxping'));
        $serverConfig->max_desync = intval($request->input('maxdesync'));
        $serverConfig->max_packetloss = floatval($request->input('maxpacketloss'));
        $serverConfig->disconnect_timeout = intval($request->input('disconnecttimeout'));
        $serverConfig->kick_clients_on_slow_network = boolval($request->input('kickslowclients') == 'on' ? 1 : 0);
        $serverConfig->double_id_detected = $request->input('doubleidcode');
        $serverConfig->on_user_connected = $request->input('userconnectcode');
        $serverConfig->on_user_disconnected = $request->input('userdisconnectcode');
        $serverConfig->on_hacked_data = $request->input('hackeddatacode');
        $serverConfig->on_different_data = $request->input('diffdatacode');
        $serverConfig->on_unsigned_data = $request->input('unsigneddatacode');
        $serverConfig->regular_check = $request->input('regularcheckcode');
        $serverConfig->mission = $request->input('mission');
        $serverConfig->modpack_id = intval($request->input('modpackid')) == 0 ? null : intval($request->input('modpackid'));
        $serverConfig->save();

        activity()
            ->causedBy(Auth::user())
            ->performedOn($serverConfig)
            ->log('INFO: '.Auth::user()->name.' added the Group '.$serverConfig->name.'!');

        return redirect('servermanager');
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
