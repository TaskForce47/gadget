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

        if($id != 0) {
            // Get role by roledid
            $serverConfig = DB::table('server_configs')->where('server_configs.id', '=', $id)->paginate();
        } else {
            $serverConfig[0] = new Server_Config();
        }
        var_dump($serverConfig[0]);

        return view('server.editserverconfig', ['serverConfig' => $serverConfig[0]])
            ->with('currentTreeView', 'servercontrol')->with('currentMenuView', 'servermanager')
            ->render();
    }

    public function saveEdit(Request $request) {

        $serverConfig = null;

        $serverId = $request->input('serverId');

        if($serverId == 0) {
            $serverConfig = new Server_Config;
        } else {
            $serverConfig = Server_Config::find($serverId);
        }

        $serverConfig->gadget_name = $request->input('gadgetName');
        $serverConfig->name = $request->input('name');
        $serverConfig->password = $request->input('password');
        $serverConfig->admin_password = $request->input('adminPassword');
        $serverConfig->motd = $request->input('motd');
        $serverConfig->motd_interval = intval($request->input('motdInterval'));
        $serverConfig->max_players = intval($request->input('maxPlayers'));
        $serverConfig->kick_duplicates = intval($request->input('kickDuplicates'));
        $serverConfig->verify_signatures = intval($request->input('verifySignatures'));
        $serverConfig->headless_clients = $request->input('headlessClients');
        $serverConfig->vote_mission_players = intval($request->input('voteMissionPlayers'));
        $serverConfig->vote_threshold = floatval($request->input('voteThreshold'));
        $serverConfig->disable_von = intval($request->input('disableVon'));
        $serverConfig->von_codec_quality = intval($request->input('vonQuality'));
        $serverConfig->persistent = intval($request->input('persistent'));
        $serverConfig->battle_eye = intval($request->input('battleye'));
        $serverConfig->max_ping = intval($request->input('maxPing'));
        $serverConfig->max_desync = intval($request->input('maxDesync'));
        $serverConfig->max_packetloss = floatval($request->input('maxPacketloss'));
        $serverConfig->disconnect_timeout = intval($request->input('disconnectTimeout'));
        $serverConfig->kick_clients_on_slow_network =
            intval($request->input('kickSlowClients'));
        $serverConfig->double_id_detected = $request->input('doubleIdCode');
        $serverConfig->on_user_connected = $request->input('userConnectCode');
        $serverConfig->on_user_disconnected = $request->input('userDisconnectCode');
        $serverConfig->on_hacked_data = $request->input('hackedDataCode');
        $serverConfig->on_different_data = $request->input('differentDataCode');
        $serverConfig->on_unsigned_data = $request->input('unsignedDataCode');
        $serverConfig->regular_check = $request->input('regularCheckCode');
        $serverConfig->mission = $request->input('mission');
        $serverConfig->modpack_id =
            intval($request->input('modpackid')) == 0 ? null : intval($request->input('modpackid'));
        $serverConfig->save();

        activity()
            ->causedBy(Auth::user())
            ->performedOn($serverConfig)
            ->log('INFO: '.Auth::user()->name.' editet the Server Config'.$serverConfig->name.'!');

        return redirect('servermanager');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addServer(Request $request) {
        return 'deprecated';
        $serverConfig = new Server_Config;

        var_dump(intval($request->input('modpackid')));


    }

    public function delServer(Request $request) {

        $serverId = $request->input('serverId');

        var_dump($serverId);

        $server = Server_Config::find($serverId);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($server)
            ->log('INFO: '.Auth::user()->name.' deleted the Server Config '.$server->name.'!');

        $server->forceDelete();

        return redirect('servermanager');
    }
}
