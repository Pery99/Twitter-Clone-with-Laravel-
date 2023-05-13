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
            $user->followers()->detach($follower->id); // attach the follower to the user's followers
            return back()->with('message', $user->username . ' Unfollowed');
        }

        $user->followers()->attach($follower->id); // attach the follower to the user's followers

        return back()->with('message', 'You are now following '.$user->username);
    }
}

