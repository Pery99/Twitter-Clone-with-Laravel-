<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Tweet;
use App\Models\Tweets;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Unique;

class ProfileController extends Controller
{
    Public function index() {
        
        $user = auth()->user();
        $tweets = auth()->user()->tweets()->latest()->filter(request(['search']))->get();
        $comments = auth()->user()->comments()->latest()->get();

        return view('profile', [
            'user' => $user,
            'tweets' => $tweets,
            'comments' => $comments,
            
        ]);
    }
    
    public function allUsers()
    {
        $alluser = User::paginate(5);
        return view ('suggestion' , [
            
            'users' => $alluser,
        ]);
    }
    public function show($id) {
        $user = Profile::find($id);
      
        return view('p', [
            'user' => $user,
            'tweets' => $user->user->tweets()->latest()->get(),
            'comments' => $user->user->comments()->latest()->get(),
        ]);
    }
      public function update ()
    {
        $data = request()->validate([
            'bio' => '',
            'pphoto' =>  'image',
    
        ]);
        if(request('pphoto')){
            
            $imagepath = (request('pphoto')->store('profilePhoto', 'public'));

            $imageArray = ['pphoto' => $imagepath];
   
        }
        auth()->user()->profile()->update(array_merge(
            $data,
            $imageArray ?? [],
        ));
        return redirect('/profile')->with('done', 'Profile Updated');
    }
        
}
