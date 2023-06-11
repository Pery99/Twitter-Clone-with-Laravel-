<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class FollowController extends Controller
{
    public function store(Request $request, User $user)
    {
        $follower = auth()->user(); // get the authenticated user
        if($follower->id == $user->id) {
            return back()->with('message', 'You cannot follow yourself');
        }
        
        $followeduser = auth()->user()->following->contains($user->id);
        
        if($followeduser) {
            $user->followers()->detach($follower->id); // dettach the follower to the user's followers
            auth()->user()->notifications()->create([
                'type' => 'follow',
                'notifiable_type' => 'alert',
                'notifiable_id' => 1,
                'data' =>' You Unfollowed  '. $user->username,
    
            ]);
            return back()->with('message', $user->username . ' Unfollowed');
        }

        $user->followers()->attach($follower->id);
        
        auth()->user()->notifications()->create([
            'type' => 'follow',
            'notifiable_type' => 'alert',
            'notifiable_id' => 1,
            'data' =>' You Followed  '. $user->username,

        ]);// attach the follower to the user's followers

        return back()->with('message', 'You are now following '.$user->username);
    }
}

