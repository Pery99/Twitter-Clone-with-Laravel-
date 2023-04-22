<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function signin(Request $request){
        
        $user = request()->validate([
            'name'=> ['required', 'max:13'],
            'email'=>['required' , 'email', 'unique:users'],
            'password'=> ['required', 'min:8'],
            'username'=>['required', 'min:4', 'unique:users'],
        ]);

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password,
            'username'=>$request->username,
        ]);
        
        auth()->login($user);
        return redirect("/list");

       
    }
  
}
