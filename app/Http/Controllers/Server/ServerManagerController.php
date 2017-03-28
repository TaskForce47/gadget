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
        // All Server Configs
        $server_config = Server_Config::paginate();

        return view('server.servermanager', ['server_config' => $server_config])
            ->with('currentTreeView', 'servercontrol')->with('currentMenuView', 'servermanager')
            ->render();
    }

    public function edit($id) {

        // Get role by roledid
        $serverConfig = DB::table('server_configs')->where('server_configs.id', '=', $id)->paginate();

        return view('server.editserverconfig', ['serverConfig' => $serverConfig[0]])
            ->with('currentTreeView', 'servercontrol')->with('currentMenuView', 'servermanager')
            ->render();
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

        $serverConfig->gadget_name = $request->input('gadgetName');
        $serverConfig->name = $request->input('name');
        $serverConfig->password = $request->input('password');
        $serverConfig->admin_password = $request->input('adminPassword');
        $serverConfig->motd = $request->input('motd');
        $serverConfig->motd_interval = intval($request->input('motdInterval'));
        $serverConfig->max_players = intval($request->input('maxPlayers'));
        // TODO: Wyh int here?
        $serverConfig->kick_duplicates = intval($request->input('kickDuplicates') == 'on' ? 1 : 0);
        $serverConfig->verify_signatures = boolval($request->input('verifySignatures') == 'on' ? 1 : 0);
        $serverConfig->headless_clients = $request->input('headlessClients');
        $serverConfig->vote_mission_players = intval($request->input('voteMissionPlayers'));
        $serverConfig->vote_threshold = floatval($request->input('voteThreshold'));
        $serverConfig->disable_von = boolval($request->input('disableVon') == 'on' ? 1 : 0);
        $serverConfig->von_codec_quality = intval($request->input('vonQuality'));
        $serverConfig->persistent = boolval($request->input('persistent') == 'on' ? 1 : 0);
        $serverConfig->battle_eye = boolval($request->input('battleye') == 'on' ? 1 : 0);
        $serverConfig->max_ping = intval($request->input('maxPing'));
        $serverConfig->max_desync = intval($request->input('maxDesync'));
        $serverConfig->max_packetloss = floatval($request->input('maxPacketloss'));
        $serverConfig->disconnect_timeout = intval($request->input('disconnectTimeout'));
        $serverConfig->kick_clients_on_slow_network = boolval($request->input('kickSlowClients') == 'on' ? 1 : 0);
        $serverConfig->double_id_detected = $request->input('doubleIdCode');
        $serverConfig->on_user_connected = $request->input('userConnectCode');
        $serverConfig->on_user_disconnected = $request->input('userDisconnectCode');
        $serverConfig->on_hacked_data = $request->input('hackedDataCode');
        $serverConfig->on_different_data = $request->input('diffDataCode');
        $serverConfig->on_unsigned_data = $request->input('unsignedDataCode');
        $serverConfig->regular_check = $request->input('regularCheckCode');
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
