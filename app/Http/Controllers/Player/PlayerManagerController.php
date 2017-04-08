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

        return view('player.playerManager', ['players' => $players, 'teams' => $teams])
            ->with('currentTreeView', 'playerManagement')->with('currentMenuView', 'playerManager')
            ->render();
    }

    public function edit($id) {

        $teams = Team::all();
        $whitelists = Whitelist::all();

        $player = new Player();


        if ($id == 0) {
            return view('player.editPlayer', ['player' => $player, 'teams' => $teams,
                'whitelists' => $whitelists, 'errorMsg' => ''])
                ->with('currentTreeView', 'playerManagement')->with('currentMenuView', 'playerManager')
                ->render();
        }

        $player = Player::findOrFail($id);


        return view('player.editPlayer', ['player' => $player, 'teams' => $teams,
            'whitelists' => $whitelists, 'errorMsg' => ''])
            ->with('currentTreeView', 'playerManagement')->with('currentMenuView', 'playerManager')
            ->render();
    }

    public function saveEdit(Request $request) {
        // Get POST vars
        $id = $request->input('playerDatabaseId');

        $player = null;

        if($id == null || $id == 0) {
            $player = new Player();
        } else {
            $player = Player::findOrFail($id);
        }

        $player->player_id = $request->input('playerId');
        $player->name = $request->input('name');
        $teamId = $request->input('team');
        if($teamId == '') {
            $player->team_id = null;
        } else {
            $player->team_id = $request->input('team');
        }
        $player->remark = $request->input('remark');
        $player->email = $request->input('email');
        $player->icq = $request->input('icq');
        $player->steam = $request->input('steam');
        $player->skype = $request->input('skype');
        $player->country = $request->input('country');

        $player->save();

        for ($i = 1; $i <= count(Whitelist::all()); $i++) {
            $whitelistCheckboxResult = $request->input('whitelist_'. $i);
            if($whitelistCheckboxResult >= 0) {
                $whitelist = Whitelist::findOrFail($whitelistCheckboxResult);
                $player->whitelists()->save($whitelist);
            } else {
                $player->whitelists()->detach($i);
            }
        }

        activity()
            ->causedBy(Auth::user())
            ->performedOn($player)
            ->log('INFO: '.Auth::user()->name.' modified the player '.$player->name.'!');

        return redirect('players');
    }

    public function del(Request $request) {
        $playerId = $request->input('playerid');


        $player = Player::findOrFail($playerId);

        $player->whitelists()->detach();

        activity()
            ->causedBy(Auth::user())
            ->performedOn($player)
            ->log('INFO: '.Auth::user()->name.' deleted the tean '.$player->title.'!');

        $player->forceDelete();

        return redirect('players');
    }
}
