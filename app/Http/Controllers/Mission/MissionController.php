<?php

namespace App\Http\Controllers\Mission;

use App\Http\Models\Ticketlog;
use App\Http\Models\Action;
use App\Http\Controllers\Controller;


class MissionController extends Controller
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
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $currentRound = Ticketlog::where('mission_id', '=', $id)->max('round');
        $ticketLog = Ticketlog::where('mission_id', '=', $id)->where('round', '=', $currentRound)->get();
        return view('mission.ticketlog', ['ticketLog' => $ticketLog])
            ->with('currentTreeView', 'mission')->with('currentMenuView', 'ticketlog')
            ->render();
    }

    public function old($id)
    {
        $currentRound = Ticketlog::where('mission_id', '=', $id)->max('round');
        $ticketLog = null;
        $oldRounds = array();
        for($i = $currentRound; $i > 0; $i--) {
            $ticketLog = Ticketlog::where('mission_id', '=', $id)->where('round', '=', $i)
                ->orderBy('timestamp','DESC')->get();
            if($ticketLog->count() > 0) {
                array_push($oldRounds, $ticketLog);
            }
        }
        return view('mission.oldTicketLog', ['oldRounds' => $oldRounds])
            ->with('currentTreeView', 'mission')->with('currentMenuView', 'ticketLog')
            ->render();
    }
}
