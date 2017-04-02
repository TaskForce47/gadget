<?php

namespace App\Http\Controllers\Whitelists;

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

        return view('whitelist.whitelistmanager', ['whitelists' => $whitelists])
            ->with('currentTreeView', 'whitelist')->with('currentMenuView', 'whitelistManager')
            ->render();
    }

    public function edit($id) {
        $whitelist = Whitelist::find($id)->paginate();

        return view('whitelist.editwhitelist', ['whitelist' => $whitelist[0]])
            ->with('currentTreeView', 'whitelist')->with('currentMenuView', 'whitelistManager')
            ->render();
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
}
