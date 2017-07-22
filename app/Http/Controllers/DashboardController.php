<?php

namespace App\Http\Controllers;

use App\Http\Models\Mission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $whitelistCount = DB::table('whitelists')
            ->select(DB::raw("whitelists.*, COUNT(*) AS 'count'"))
            ->leftJoin('player_whitelist', 'whitelists.id','=', 'player_whitelist.whitelist_id')
            ->groupBy('whitelists.id')->get();


        $teamCount = DB::table('teams')
            ->select(DB::raw("teams.title, COUNT(*) as 'count'"))
            ->leftJoin('players', 'players.team_id', '=', 'teams.id')
            ->groupBy('teams.id')
            ->get();

        $lastTicketlogs = DB::table('ticketlog')
            ->select(DB::raw("*, actions.name AS 'action_name'"))
            ->leftJoin('actions', 'ticketlog.action_id','=', 'actions.id')
            ->leftJoin('players', 'ticketlog.player_id', '=', 'players.id')
            ->orderBy('timestamp', 'DESC')
            ->get();

        return view('dashboard',
            ['whitelistCount' => $whitelistCount, 'teamCount' => $teamCount,
                'lastTicketlogs' => $lastTicketlogs, 'missionsMenu' => Mission::all()])
            ->with('currentTreeView', 'home')->with('currentMenuView', 'dashboard');
    }
}
