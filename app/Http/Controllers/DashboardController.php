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

        $lastTicketLogs = DB::table('ticketlog')
            ->select(DB::raw("*, actions.name AS 'action_name'"))
            ->leftJoin('actions', 'ticketlog.action_id','=', 'actions.id')
            ->leftJoin('players', 'ticketlog.player_id', '=', 'players.id')
            ->orderBy('timestamp', 'DESC')
            ->take(20)
            ->get();

        // SELECT players.name, (SUM(`change`) * -1) AS 'lostTickets' FROM ticketlog JOIN players ON
        // ticketlog.player_id = players.id WHERE players.player_id != '76561198022749433' GROUP BY players.id ORDER BY lostTickets DESC LIMIT 10;

        $top10TicketWaste = DB::table('ticketlog')
            ->select(DB::raw("players.name, (SUM(`change`) * -1) AS 'lostTickets'"))
            ->join('players', 'ticketlog.player_id', '=', 'players.id')
            ->where('players.player_id', '!=', '76561198022749433')
            ->groupBy('players.id')
            ->orderBy('lostTickets', 'DESC')
            ->take(10)
            ->get();

        return view('dashboard',
            ['whitelistCount' => $whitelistCount, 'teamCount' => $teamCount,
                'lastTicketLogs' => $lastTicketLogs, 'top10TicketWaste' => $top10TicketWaste])
            ->with('currentTreeView', 'home')->with('currentMenuView', 'dashboard');
    }
}
