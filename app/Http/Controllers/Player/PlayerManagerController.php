<?php

namespace App\Http\Controllers\Player;

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
        $players = Player::paginate();

        $teams = Team::paginate();

        return view('player.playermanager', ['players' => $players, 'teams' => $teams])->render();
    }

    public function edit($id) {
        $player = Player::findOrFail($id)->paginate();

        return view('player.editplayer', ['player' => $player])->render();
    }

    public function saveEdit(Request $request) {
        // Get POST vars
        $whitelistId = $request->input('whitelistid');
        $whitelistName = $request->input('whitelistname');

        $whitelist = Whitelist::find($whitelistId);

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
