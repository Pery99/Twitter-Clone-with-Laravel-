<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tweet;
use App\Models\Bookmark;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
     public function store(Request $request, Tweet $tweet) {
        
       auth()->user()->bookmarks()->create([
            'tweet_id' => $request->tweet_id,
            
        ]);
        
        return redirect()->back()->with('message', 'Done, Added to bookmark');
        

    }

    public function show()
    {
       
        $save = auth()->user()->bookmarks()->pluck('tweet_id');
        $bookmark = Tweet::whereIn('id', $save)->latest()->get();
        return view('bookmark', [
            'tweets' => $bookmark,
        ]);
    }

    public function destroy($id) 
    {
        $bookmark = Bookmark::find($id);
        $bookmark->delete();

        return redirect('tweet')->with('message', 'Tweet Removed from Bookmark');
    }
}
