<?php

namespace App\Http\Controllers\Player;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Models\Whitelist;


class WhitelistManagerController extends Controller
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
        // All roles
        $whitelists = Whitelist::paginate();

        return view('player.whitelistManager', ['whitelists' => $whitelists])
            ->with('currentTreeView', 'playerManagement')->with('currentMenuView', 'whitelistManager')
            ->render();
    }

    public function edit($id) {

        if ($id == 0) {
            $whitelist = new Whitelist();
            return view('player.editWhitelist', ['whitelist' => $whitelist])
                ->with('currentTreeView', 'playerManagement')->with('currentMenuView', 'whitelistManager')
                ->render();
        }

        $whitelist = Whitelist::findOrFail($id);

        return view('player.editWhitelist', ['whitelist' => $whitelist])
            ->with('currentTreeView', 'playerManagement')->with('currentMenuView', 'whitelistManager')
            ->render();
    }

    public function saveEdit(Request $request) {
        // Get POST vars
        $id = $request->input('whitelistid');

        $team = null;

        if($id == null || $id == 0) {
            $whitelist = new Whitelist();
        } else {
            $whitelist = Whitelist::findOrFail($id);
        }

        $whitelist->name = $request->input('whitelistname');;

        $whitelist->save();


        activity()
            ->causedBy(Auth::user())
            ->performedOn($whitelist)
            ->log('INFO: '.Auth::user()->name.' renamed the Whitelist '.$whitelist->name.'!');

        return redirect('whitelists');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function add(Request $request) {
        $whitelist = new Whitelist;
        $whitelist->name = $request->input('name');
        $whitelist->save();

        activity()
            ->causedBy(Auth::user())
            ->performedOn($whitelist)
            ->log('INFO: '.Auth::user()->name.' added the Whitelist '.$whitelist->name.'!');

        return redirect('whitelists');
    }

    public function del(Request $request) {
        $whitelistId = $request->input('whitelistid');

        $whitelist = Whitelist::find($whitelistId);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($whitelist)
            ->log('INFO: '.Auth::user()->name.' deleted the Whitelist '.$whitelist->name.'!');

        $whitelist->forceDelete();

        return redirect('whitelists');
    }

    public function delete($id) {
        $whitelist = Whitelist::findOrFail($id);
        $whitelist->players()->detach();

        activity()
            ->causedBy(Auth::user())
            ->performedOn($whitelist)
            ->log('INFO: '.Auth::user()->name.' deleted the Whitelist '.$whitelist->title.'!');

        $whitelist->forceDelete();

        return redirect('whitelists');
    }
}
