<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ 'Edit' }}</title>
    <link rel="stylesheet" href="/css/edit.css">
</head>

<body>
    <div class="pop-container">
        <div class="pop">
            <h3>Are you sure you want to delete your account?</h3>
            <p>All your records will be gone and you cant retrive it back...</p>
            <div class="opt">
                <form class="yes-form" action="" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="yes">Yes</button>
                </form>
                <button class="no">No</button>
            </div>
        </div>
    </div>
    <div class="main_container">
        @extends('layouts.nav')

        @section('nav-link')
        @endsection
        <div class="second-side">
            @if (session()->has('message'))
                <div class="message-div" x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show">
                    <p class="message">
                        {{ session('message') }}
                    </p>
                </div>
            @endif
            <div class="content">
                <h1>Edit your account</h1>
                <form class="edit-form" action="/edit" method="POST">
                    @method('PATCH')
                    @csrf
                    <label for="name">Name</label>
                    <input class="input" type="text" placeholder="Name" name="name" value="{{ $user->name }}">
                    @error('name')
                        <p>Required</p>
                    @enderror
                    <label for="name">Email</label>
                    <input class="input" type="email" placeholder="Enter Email" name="email"
                        value="{{ $user->email }}">
                    @error('email')
                        <p>Required</p>
                    @enderror
                    <label for="name">Username</label>
                    <input class="input" type="text" name="username" placeholder="Username"
                        value="{{ $user->username }}">
                    @error('username')
                        <p>Required</p>
                    @enderror
                    <div>
                        <label for="">Enter Password to continue</label>
                        <input class="input" type="password" name="confirmpassword" id=""
                            placeholder="Enter Password">
                        @error('confirmpassword')
                            <p style="color: red; font-weight: bold; margin:10px 0;">{{ $message }}</p>
                        @enderror
                    </div>
                    <button class="save">Save Changes</button>
                </form>
                <div class="del">
                    <button class="delete">Delete Account</button>
                </div>
            </div>
        </div>
    </div>


    <script src="edit.js"></script>
</body>

</html>
