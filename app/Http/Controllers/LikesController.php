<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tweet;
use App\Notifications\LikeNotification;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;

class LikesController extends Controller
{

    public function store(Request $request, Tweet $tweet)
    {
        $tweet_id = $request->tweet_id;
        $user_id = auth()->user()->id;
        $notification = new LikeNotification();

        $existing = DB::table('likes')->where('tweet_id', $tweet_id)->where('user_id', $user_id)->first();
        if ($existing) {
            DB::table('likes')->where('tweet_id', $tweet_id)->where('user_id', $user_id)->delete();
            return back();

        } else {
            auth()->user()->likes()->create([
                'tweet_id' => $tweet_id,
            ]);

            $tweet = Tweet::find($tweet_id);

            if ($tweet->user->username === auth()->user()->username) {
                $user = 'your';
                $user_post = $tweet->tweets;
            } else {
                $user = $tweet->user->username;
                $user_post = $tweet->tweets;
            }
            auth()->user()->notifications()->create([
                'type' => 'like',
                'notifiable_type' => 'alert',
                'notifiable_id' => 1,
                'data' => ' You liked  ' . $user . ' post "' . $user_post . '" ',
            ]);

            return back();

        }
    }

}