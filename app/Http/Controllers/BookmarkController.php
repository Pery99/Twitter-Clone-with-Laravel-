<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tweet;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookmarkController extends Controller
{
    public function store(Request $request)
    {
        $tweet_id = $request->tweet_id;
        $user_id = auth()->user()->id;
        $exist = DB::table('bookmarks')->where('tweet_id', $tweet_id)->where('user_id', $user_id)->first();
        if ($exist) {
            DB::table('bookmarks')->where('tweet_id', $tweet_id)->where('user_id', $user_id)->delete();
            $tweet = Tweet::find($tweet_id);
            if ($tweet->user->username === auth()->user()->username) {
                $user = 'your';
            } else {
                $user = $tweet->user->username;
            }

            auth()->user()->notifications()->create([
                'type' => 'like',
                'notifiable_type' => 'alert',
                'notifiable_id' => 1,
                'data' => ' You removed ' . $user . ' tweet "' . $tweet->tweets . '" from your bookmark',

            ]);
            return back()->with('message', 'Removed from bookmark');
        }
        auth()->user()->bookmarks()->create([
            'tweet_id' => $tweet_id,
        ]);
        $tweet = Tweet::find($tweet_id);
        if ($tweet->user->username === auth()->user()->username) {
            $user = 'your';
        } else {
            $user = $tweet->user->username;
        }

        auth()->user()->notifications()->create([
            'type' => 'like',
            'notifiable_type' => 'alert',
            'notifiable_id' => 1,
            'data' => ' You bookmarked  ' . $user . ' tweet "' . $tweet->tweets . '"',

        ]);
        // return response()->json(['message' => 'Added to bookmark']);
        return back()->with('message', 'Added to bookmark');
    }

    public function show()
    {
        $save = auth()->user()->bookmarks()->pluck('tweet_id');
        $bookmark = Tweet::whereIn('id', $save)->latest()->filter(request(['search']))->get();

        return view('bookmark', [
            'tweets' => $bookmark,
        ]);
    }

    public function destroy()
    {
        $user_id = auth()->user()->id;
        DB::table('bookmarks')->where('user_id', $user_id)->delete();
        return back()->with('message', 'Bookmark cleared');
    }
}