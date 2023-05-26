<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request) {

       auth()->user()->comments()->create([
            'tweet_id' => $request->tweet_id,
            'comment' => $request->comment,
            
        ]);
        
        return redirect()->back()->with('message', 'Reply sent');
    }

    public function destroy($id) {
        $comment = Comment::find($id);
        $comment->delete();

        return back()->with('message', 'Comment Deleted');
    }

}
