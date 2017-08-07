<?php

namespace App\Http\Controllers\Player;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Models\Team;
use DB;
use Spatie\Permission\Models\Permission;

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
        // All teams with count
        //SELECT teams.*,count(*) as 'count' from teams LEFT JOIN players ON players.team_id=teams.id GROUP BY id;

        $teams = DB::table('teams')
            ->select(DB::raw("teams.*, COUNT(player_id) as 'count'"))
            ->leftJoin('players', 'players.team_id', '=', 'teams.id')
            ->groupBy('id')
            ->get();

        return view('player.teamManager', ['teams' => $teams])
            ->with('currentTreeView', 'playerManagement')->with('currentMenuView', 'teamManager')
            ->render();
    }

    public function edit($id) {
        if ($id == 0) {
            $team = new Team();
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
        $team->tag = $request->input('teamTag');
        $team->email = $request->input('teamEmail');
        $team->web = 'task-force47.de';
        $team->name = '[TF47] Task Force 47 - Die ArmA 3 ACE-Community';
        $team->directory = $request->input('teamDirectory');

        $team->save();

        if($id == null || $id == 0) {
            Permission::create(['name' => 'team_'. $team->id]);
        }

        activity()
            ->causedBy(Auth::user())
            ->performedOn($team)
            ->log('INFO: '.Auth::user()->name.' modified the team '.$team->title.'!');

        return redirect('teams');
    }

    public function delete($id) {
        $team = Team::findOrFail($id);

        foreach($team->players()->get() as $player) {
            $player->team()->dissociate();
            $player->save();
        }

        activity()
            ->causedBy(Auth::user())
            ->performedOn($team)
            ->log('INFO: '.Auth::user()->name.' deleted the team '.$team->title.'!');

        $team->forceDelete();

        return redirect('teams');
    }
}
