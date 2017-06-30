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
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $ticketlog = Ticketlog::where('mission_id', '=', $id)->get();
        $actions = Action::all();

        return view('mission.ticketlog', ['ticketlog' => $ticketlog, 'actions' => $actions])
            ->with('currentTreeView', 'mission')->with('currentMenuView', 'ticketlog')
            ->render();
    }
}
