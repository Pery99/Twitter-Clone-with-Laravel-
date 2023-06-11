<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request)
    {

        auth()->user()->comments()->create([
            'tweet_id' => $request->tweet_id,
            'comment' => $request->comment,

        ]);

        $tweet = Tweet::find($request->tweet_id);
        if ($tweet->user->username === auth()->user()->username) {
            $user = 'your';
        } else {
            $user = $tweet->user->username;
        }

        auth()->user()->notifications()->create([
            'type' => 'like',
            'notifiable_type' => 'alert',
            'notifiable_id' => 1,
            'data' => ' You made a comment "' . $request->comment . '"' . ' on ' . $user . ' post "' . $tweet->tweets . '"',

        ]);

        return redirect()->back()->with('message', 'Reply sent');
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();

        if ($comment->user->username === auth()->user()->username) {
            $user = 'your';
        } else {
            $user = $comment->user->username;
        }

        auth()->user()->notifications()->create([
            'type' => 'like',
            'notifiable_type' => 'alert',
            'notifiable_id' => 1,
            'data' => ' You deleted your comment "' . $comment->comment . '"' . ' on ' . $user . ' post',

        ]);

        return back()->with('message', 'Comment Deleted');
    }

}