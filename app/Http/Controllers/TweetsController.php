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
            'followedUserTweets' => $tweets
        ]);

    }
    
    
    // 'tweets' => auth()->user()->tweets()->tweets->latest()->filter(request(['search']))
    // ->get()

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

            return back()->with('sucess', 'Tweet created sucessfully!');
        
    }
}

// $post = Tweet::create([
        //     'username' => auth()->user()->username,
        //     'tweets' => $request->tweets,
        // ]);
        
        // return redirect('/')->with('Tweet', 'Tweet created sucessfully!');