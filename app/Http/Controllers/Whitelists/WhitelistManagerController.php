<?php

namespace App\Http\Controllers\Whitelists;

use App\Whitelist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\User;

use App\Server_Config;

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

        return view('whitelist.whitelistmanager', ['whitelists' => $whitelists])->render();
    }

    public function edit($id) {
        // Get role by roledid
        $whitelist = Whitelist::find($id)->paginate();

        return view('whitelist.editwhitelist', ['whitelist' => $whitelist[0]])->render();
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

        //var_dump(intval($request->input('modpackid')));

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
