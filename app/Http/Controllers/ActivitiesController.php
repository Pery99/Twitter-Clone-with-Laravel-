<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivitiesController extends Controller
{
    public function show() {
        $notification = auth()->user()->notifications;
        return view('notification',[
            'notifications' => $notification
        ]);
    }
}
