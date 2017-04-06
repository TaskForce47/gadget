<?php

namespace App\Http\Controllers\Player;

use App\Http\Models\Whitelist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Models\Player;
use App\Http\Models\Team;


class PlayerManagerController extends Controller
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
        // All players
        $players = Player::all();

        $teams = Team::all();

        return view('player.playermanager', ['players' => $players, 'teams' => $teams])
            ->with('currentTreeView', 'playerManagement')->with('currentMenuView', 'playerManager')
            ->render();
    }

    public function addNew() {
        return $this->edit(null);
    }

    public function edit($id) {

        $teams = Team::all();
        $whitelists = Whitelist::all();

        $player = new Player();

        var_dump($player->id);

        if ($id == null) {
            return view('player.editplayer', ['player' => $player, 'teams' => $teams,
                'whitelists' => $whitelists, 'errorMsg' => ''])->render();
        }

        $player = Player::findOrFail($id);


        return view('player.editplayer', ['player' => $player, 'teams' => $teams,
            'whitelists' => $whitelists, 'errorMsg' => ''])
            ->with('currentTreeView', 'playerManagement')->with('currentMenuView', 'playerManager')
            ->render();
    }

    public function saveEdit(Request $request) {
        // Get POST vars

        $id = $request->input('id');

        $playerId = $request->input('playerId');

        $player = null;

        if($id == null) {
            if(Player::findByPlayerId($playerId) == null) {

            } else {
                return;
            }
            $player = new Player();

        }





        $player = Player::findByPlayerId($playerId);

        if($player == null) {

        }

        $whitelistName = $request->input('whitelistname');

        $whitelist = null;//Whitelist::find($whitelistId);

        $whitelist->name = $whitelistName;

        $whitelist->save();


        activity()
            ->causedBy(Auth::user())
            ->performedOn($whitelist)
            ->log('INFO: '.Auth::user()->name.' renamed the Whitelist '.$whitelist->name.'!');

        return redirect('players');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function add(Request $request) {
        $player = new Player;
        $player->name = $request->input('name');
        $player->player_id = $request->input('playerId');
        $player->country = $request->input('country');




        //$player->user_id = null;
        $player->save();

        activity()
            ->causedBy(Auth::user())
            ->performedOn($player)
            ->log('INFO: '.Auth::user()->name.' added the Player '.$player->name.'!');

        return redirect('players');
    }

    public function del(Request $request) {
        $whitelistId = $request->input('whitelistid');

        $whitelist = Player::find($whitelistId);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($whitelist)
            ->log('INFO: '.Auth::user()->name.' deleted the Whitelist '.$whitelist->name.'!');

        $whitelist->forceDelete();

        return redirect('players');
    }
}
