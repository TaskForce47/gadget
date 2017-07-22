<?php

namespace App\Http\Controllers\Mission;

use App\Http\Models\Mission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MissionManagerController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $missions = Mission::all();
        return view('mission.missionManager', ['missions' => $missions])
            ->with('currentTreeView', 'mission')->with('currentMenuView', 'missionManager')
            ->render();
    }


    public function edit($id) {

        $mission = null;

        if ($id == 0) {
            $mission = new Mission();
        } else {
            $mission = Mission::findOrFail($id);
        }

        return view('mission.editMission', ['mission' => $mission, 'errorMsg' => ''])
            ->with('currentTreeView', 'mission')->with('currentMenuView', 'missionManager')
            ->render();
    }

    public function saveEdit(Request $request) {
        // Get POST vars
        $id = $request->input('missionDatabaseId');

        $mission = null;

        if($id == null || $id == 0) {
            $mission = new Mission();
        } else {
            $mission = Mission::findOrFail($id);
        }

        $mission->mission_id = $request->input('missionId');
        $mission->name = $request->input('name');
        $mission->active = $request->input('active') ? DB::raw(1) : DB::raw(0);
        $mission->save();

        activity()
            ->causedBy(Auth::user())
            ->performedOn($mission)
            ->log('INFO: '.Auth::user()->name.' modified the mission '.$mission->name.'!');

        return redirect('missions');
    }

    public function delete($id) {
        $mission = Mission::findOrFail($id);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($mission)
            ->log('INFO: '.Auth::user()->name.' deleted the mission '.$mission->name.'!');

        $mission->forceDelete();

        return redirect('missions');
    }
}
