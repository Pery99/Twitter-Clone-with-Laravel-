<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class EditController extends Controller
{
    //
    public function index() {
        $user = auth()->user();
        return view('edit', [
            'user' => $user,
        ]);
    }
    
    public function update() {
        $data = request()->validate([
            'name'=> ['required', 'max:13'],
            'email'=>['required' , 'email'],
            'username'=>['required', 'min:4'],
        ]);
        $password = request()->validate([
            'confirmpassword' => 'required',
        ]);
       if(auth()->user()->password === $password['confirmpassword']) {
           auth()->user()->update(
               $data,
           );
           return back()->with('message', 'Details Updated');
       }else{
           return back()->with('message', 'Wrong Password');
       }
    }

    // public function destroy($id) 
    // {
    //     // $user = User::find($id);
    //     // $user->user()->delete();
    //     // $user->profile()->delete();
    //     // $user->tweets()->delete();
    //     // $user->comments()->delete();
    //     // $user->bookmarks()->delete();
    //     // $user->followers()->delete();
    //     // $user->following()->delete();    
    //     // return redirect('/login')->with('message', 'Account Deleted');
    // }
}
