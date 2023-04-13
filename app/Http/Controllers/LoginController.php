<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function login(Request $request){

        $user = request()->validate([
            'email'=>['required' , 'email'],
            'password'=> ['required', 'min:8'],
        ]);

        $user = User::where([
            'email'=>$request->email,
            'password'=>$request->password,
        ])->first();

        auth()->login($user);

        
        Auth::login($user, true);

        return redirect('/');
    }


    public function logout(Request $request) {
        
        Auth::guard('web')->logout();
        
        return redirect('login');
    }
}

