<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use App\Models\Tweet;
use App\Models\Following;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TweetsController extends Controller
{
    
    public function index() {
        $forYou = Tweet::latest()->latest()->filter(request(['search']))->get();
        $users = auth()->user()->following()->pluck('following_id');
        $tweets = Tweet::whereIn('user_id', $users)->latest()->filter(request(['search']))
        ->get();
        
        return view('home', [
           'forYou' => $forYou,
            'followedUserTweets' => $tweets,
            'user_id' =>auth()->user()->id, 
        ]);

    }
    

    public function show($id){
       
        $tweet =  Tweet::with('comments')->find($id); 
        return view('tweet', [
            'tweet' => $tweet,
            
        ]);
    }


    
    public function store(Request $request){

        $data = request()->validate([
            'tweets' => 'required',
            'image' => ['', 'image'],
        ]);
        if($request->hasFile('image')){
         $imagepath = (request('image')->store('uploads', 'public'));
        }else{
            $imagepath = '';
        }
        
        auth()->user()->tweets()->create([
                'tweets' =>$data['tweets'],
                'image' => $imagepath,
                
            ]);

            

            auth()->user()->notifications()->create([
                'type' => 'like',
                'notifiable_type' => 'alert',
                'notifiable_id' => 1,
                'data' =>' You made a Tweet "'. $data['tweets'] .'"' ,
            ]);

            return back()->with('message', 'Tweet created sucessfully!');
        
    }

    public function destroy($id) {
        $tweet = Tweet::find($id);
        $tweet->delete();

        auth()->user()->notifications()->create([
            'type' => 'like',
            'notifiable_type' => 'alert',
            'notifiable_id' => 1,
            'data' =>' You Deleted your Tweet "'. $tweet->tweets .'"' ,
        ]);

        return back()->with('message', 'Tweet Deleted Sucessfully');
    }
    
}
