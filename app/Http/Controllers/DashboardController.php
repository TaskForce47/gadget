<?php

namespace App\Http\Controllers;

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
            ->select(DB::raw("whitelists.*, COUNT(player_whitelist.whitelist_id) AS 'count'"))
            ->leftJoin('player_whitelist', 'whitelists.id','=', 'player_whitelist.whitelist_id')
            ->groupBy('whitelists.id')->get();


        $teamCount = DB::table('teams')
            ->select(DB::raw("teams.title, COUNT(players.id) as 'count'"))
            ->leftJoin('players', 'players.team_id', '=', 'teams.id')
            ->groupBy('teams.id')
            ->get();

        $lastTicketlogs = DB::table('ticketlog')
            ->select(DB::raw("*, actions.name AS 'action_name'"))
            ->leftJoin('actions', 'ticketlog.action_id','=', 'actions.id')
            ->leftJoin('players', 'ticketlog.player_id', '=', 'players.id')
            ->orderBy('timestamp', 'DESC')
            ->take(20)
            ->get();

        return view('dashboard',
            ['whitelistCount' => $whitelistCount, 'teamCount' => $teamCount,
                'lastTicketlogs' => $lastTicketlogs])
            ->with('currentTreeView', 'home')->with('currentMenuView', 'dashboard');
    }
}
