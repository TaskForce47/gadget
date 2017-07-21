<?php

namespace App\Http\Controllers\Player;

use App\Http\Models\Comment;
use App\Http\Models\Whitelist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Models\Player;
use App\Http\Models\Team;


class CommentManagerController extends Controller
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

    public function index($id)
    {
        $player = Player::findOrFail($id);

        $comments = $player->comments()->get();

        return view('player.playerComment', ['player' => $player, 'comments' => $comments, 'errorMsg' => ''])
            ->with('currentTreeView', 'playerManagement')->with('currentMenuView', 'comments')
            ->render();
    }

    public function indexAll()
    {
        $comments = Comment::all();

        return view('player.playerComment', ['player' => null, 'comments' => $comments, 'errorMsg' => ''])
            ->with('currentTreeView', 'playerManagement')->with('currentMenuView', 'comments')
            ->render();
    }

    public function edit($id, $commentId)
    {

        $player = Player::findOrFail($id);

        $whitelists = Whitelist::all();

        $comment = null;

        if($commentId == null || $commentId == 0) {
            $comment = new Comment();
        } else {
            $comment = Comment::findOrFail($commentId);
        }

        $allWhitelists[0] = 'Allgemein';
        foreach ($whitelists as $whitelist) {
            $allWhitelists[$whitelist->id] = $whitelist->name;
        }

        return view('player.editComment', ['player' => $player, 'comment' => $comment, 'allWhitelists' => $allWhitelists,
            'errorMsg' => ''])->with('currentTreeView', 'playerManagement')->with('currentMenuView', 'comments')
            ->render();
    }

    public function saveEdit(Request $request)
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

        $comment->comment = $request->input('comment');
        $comment->warning = intval($request->input('warning'));
        $comment->save();

        activity()
            ->causedBy(Auth::user())
            ->performedOn($comment)
            ->log('INFO: '.Auth::user()->name.' modified the comment '.$comment->id.'!');

        return redirect('players/'.$playerId.'/comments');
    }

    public function delete($id, $commentId, $showAll) {
        $comment = Comment::findOrFail($commentId);
        $comment->deleted = 1;
        $comment->save();

        activity()
            ->causedBy(Auth::user())
            ->performedOn($comment)
            ->log('INFO: '.Auth::user()->name.' deleted the comment '.$comment->id.'!');

        if($showAll == 1) {
            return redirect('comments');
        } else {
            return redirect('players/' . $id . '/comments');
        }
    }

    public function recover($id, $commentId, $showAll) {
        $comment = Comment::findOrFail($commentId);
        $comment->deleted = 0;
        $comment->save();

        activity()
            ->causedBy(Auth::user())
            ->performedOn($comment)
            ->log('INFO: '.Auth::user()->name.' recovered the comment '.$comment->id.'!');

        if($showAll == 1) {
            return redirect('comments');
        } else {
            return redirect('players/' . $id . '/comments');
        }
    }
}
