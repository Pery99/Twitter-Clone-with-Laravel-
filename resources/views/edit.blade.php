<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{'Edit'}}</title>
    <link rel="stylesheet" href="/css/edit.css">
</head>
<body>
    <div class="main_container">
        @extends('layouts.nav')

        @section('nav-link')

        <div class="second-side">
             @if (session()->has('message'))
            <div class="message-div" x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show">
            <p class="message">
                {{session('message')}}
            </p>
            </div>
            @endif
            <div class="content">
                <h1>Edit your account</h1>
                <form class="edit-form" action="/edit" method="POST">
                    @method('PATCH')
                    @csrf
                    <input class="input" type="text" placeholder="Name" name="name" value="{{$user->name}}"> 
                    @error('name')
                        <p>Required</p>
                    @enderror
                    <input class="input" type="email" placeholder="Enter Email" name="email" value="{{$user->email}}">
                     @error('email')
                        <p>Required</p>
                    @enderror
                    <input class="input" type="text" name="username" placeholder="Username" id="" value="{{$user->username}}">
                     @error('username')
                        <p>Required</p>
                    @enderror
                   <div>
                     <label for="">Enter Password to continue</label>
                     <input class="input" type="password" name="confirmpassword" id="" placeholder="Enter old Password">
                     @error('confirmpassword')
                        <p>{{$message}}</p>
                    @enderror
                   </div>
                    <button class="save">Save Changes</button>
                </form>
                <form class="del" action="/edit/{{auth()->user()->id}}" method="POST">
                    @csrf
                    @method('DELETE')
                 <button class="delete">Delete Account</button>
                </form>
            </div>
        </div>
    </div>
    @endsection
</body>
</html>