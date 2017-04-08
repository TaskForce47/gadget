<?php

namespace App\Http\Controllers\Player;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Models\Team;


class TeamManagerController extends Controller
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
        // All teams
        $teams = Team::all();

        return view('player.teamManager', ['teams' => $teams])
            ->with('currentTreeView', 'playerManagement')->with('currentMenuView', 'teamManager')
            ->render();
    }

    public function edit($id) {
        $team = new Team();

        if ($id == 0) {
            return view('player.editTeam', ['team' => $team, 'errorMsg' => ''])
                ->with('currentTreeView', 'playerManagement')->with('currentMenuView', 'teamManager')
                ->render();
        }

        $team = Team::findOrFail($id);


        return view('player.editTeam', ['team' => $team, 'errorMsg' => ''])
            ->with('currentTreeView', 'playerManagement')->with('currentMenuView', 'teamManager')
            ->render();
    }

    public function saveEdit(Request $request) {
        // Get POST vars
        $id = $request->input('teamId');

        $team = null;

        if($id == null || $id == 0) {
            $team = new Team();
        } else {
            $team = Team::findOrFail($id);
        }

        $team->title = $request->input('teamTitle');
        $team->nick = $request->input('teamTag');
        $team->email = $request->input('teamEmail');
        $team->web = 'http://task-force47.de/';
        $team->name = '[TF47] Task Force 47 - Die ArmA 3 ACE-Community';

        $team->save();

        activity()
            ->causedBy(Auth::user())
            ->performedOn($team)
            ->log('INFO: '.Auth::user()->name.' modified the team '.$team->title.'!');

        return redirect('teams');
    }

    public function del(Request $request) {
        $teamId = $request->input('teamid');

        $team = Team::find($teamId);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($team)
            ->log('INFO: '.Auth::user()->name.' deleted the tean '.$team->title.'!');

        $team->forceDelete();

        return redirect('teams');
    }
}
