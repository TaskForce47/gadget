<?php

namespace App\Http\Controllers\Player;

use App\Http\Models\Comment;
use App\Http\Models\Whitelist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Models\Player;
use App\Http\Models\Team;


class PlayerManagerController extends Controller
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
        // All players
        $players = Player::all();

        $teams = Team::all();

        return view('player.playerManager', ['players' => $players, 'teams' => $teams])
            ->with('currentTreeView', 'playerManagement')->with('currentMenuView', 'playerManager')
            ->render();
    }

    public function edit($id) {

        $teams = Team::all();

        $selectTeams = array();

        foreach ($teams as $team) {
            $selectTeams[$team->id] = $team->title;
        }


        $whitelists = Whitelist::all();
        if(empty($whitelists)) {
            $whitelists = array();
        }
        var_dump($whitelists);
        $player = new Player();


        if ($id == 0) {
            return view('player.editPlayer', ['player' => $player, 'selectTeams' => $selectTeams,
                'whitelists' => $whitelists, 'errorMsg' => ''])
                ->with('currentTreeView', 'playerManagement')->with('currentMenuView', 'playerManager')
                ->render();
        }

        $player = Player::findOrFail($id);


        return view('player.editPlayer', ['player' => $player, 'selectTeams' => $selectTeams,
            'whitelists' => $whitelists, 'errorMsg' => ''])
            ->with('currentTreeView', 'playerManagement')->with('currentMenuView', 'playerManager')
            ->render();
    }

    public function comments($id)
    {
        $player = Player::findOrFail($id);

        $comments = $player->comments()->get();

        return view('player.comments', ['player' => $player, 'comments' => $comments, 'errorMsg' => ''])
            ->with('currentTreeView', 'playerManagement')->with('currentMenuView', 'playerManager')
            ->render();
    }

    public function editComment($id, $commentId)
    {

        $player = Player::findOrFail($id);

        $whitelist = Whitelist::all();

        $comment = null;

        if($commentId == null || $commentId == 0) {
            $comment = new Comment();
        } else {
            return 'not implemented';
        }


        return view('player.editComment', ['player' => $player, 'comment' => $comment, 'whitelists' => $whitelist,
            'errorMsg' => ''])->with('currentTreeView', 'playerManagement')->with('currentMenuView', 'playerManager')
            ->render();
    }

    public function saveComment(Request $request)
    {
        $playerId = $request->input('playerDatabaseId');
        $commentId = $request->input('commentId');

        $player = Player::findOrFail($playerId);
        $comment = null;

        if($commentId > 0) {
            $comment = Comment::findOrFail($commentId);
        } else {
            $comment = new Comment();
        }

        $whitelistId = $request->input('whitelist');


        if($whitelistId > 0) {
            $whitelist = Whitelist::findOrFail($whitelistId);
            $comment->whitelist()->associate($whitelist);
        } else {
            $comment->whitelist()->associate(null);
        }



        $comment->player()->associate($player);
        $comment->author()->associate(Auth::user());
        var_dump(intval($request->input('warning')));

        $comment->comment = $request->input('comment');
        $comment->warning = intval($request->input('warning'));
        $comment->save();

        return redirect('players/'.$playerId.'/comments');
    }

    public function saveEdit(Request $request) {
        // Get POST vars
        $id = $request->input('playerDatabaseId');

        $player = null;

        if($id == null || $id == 0) {
            $player = new Player();
        } else {
            $player = Player::findOrFail($id);
        }

        $player->player_id = $request->input('playerId');
        $player->name = $request->input('name');
        $teamId = $request->input('team');
        if($teamId == '') {
            $player->team_id = null;
        } else {
            $player->team_id = $request->input('team');
        }
        $player->remark = $request->input('remark');
        $player->email = $request->input('email');
        $player->icq = $request->input('icq');
        $player->steam = $request->input('steam');
        $player->skype = $request->input('skype');
        $player->country = $request->input('country');

        $player->save();

        for ($i = 1; $i <= count(Whitelist::all()); $i++) {
            $whitelistCheckboxResult = $request->input('whitelist_'. $i);
            if($whitelistCheckboxResult >= 0) {
                $whitelist = Whitelist::findOrFail($whitelistCheckboxResult);
                $player->whitelists()->save($whitelist);
            } else {
                $player->whitelists()->detach($i);
            }
        }

        activity()
            ->causedBy(Auth::user())
            ->performedOn($player)
            ->log('INFO: '.Auth::user()->name.' modified the player '.$player->name.'!');

        return redirect('players');
    }

    public function del(Request $request) {
        $playerId = $request->input('playerid');


        $player = Player::findOrFail($playerId);

        $player->whitelists()->detach();

        activity()
            ->causedBy(Auth::user())
            ->performedOn($player)
            ->log('INFO: '.Auth::user()->name.' deleted the tean '.$player->title.'!');

        $player->forceDelete();

        return redirect('players');
    }
}
