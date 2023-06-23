<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Follow</title>
    <link rel="stylesheet" href="/css/suggestion.css">
</head>

<body>
    @if (session()->has('message'))
        <div class="message-div" x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show">
            <p class="message">
                {{ session('message') }}
            </p>
        </div>
    @endif
    <div class="others">
        <h2 style="display:flex;justify-content:center;">People you can follow</h2>
        <br>
        @unless (count($users) === 1)
        @foreach ($users as $user)
            @if ($user->id == auth()->user()->id)
            @else
                <div class="follow">
                    <div class="follow-id">
                        <img class="p-photo" src="/storage/{{ $user->profile->pphoto }}" alt="">
                        <div class="f-text">
                            <p style="font-size: large; font-weight: bold;">{{ $user->name }}</p>
                            <p style="font-size: medium;">{{ '@' . $user->username }}</p>
                        </div>
                    </div>
                    <form action=" /users/{{ $user->username }}/follow" method="POST">
                        @csrf
                        @if (auth()->user()->following->contains($user->id))
                            <button onclick="" class="follow-btn">Following</button>
                        @else
                            <button onclick="" class="follow-btn">Follow</button>
                        @endif
                    </form>
                </div>
                <hr>
            @endif
        @endforeach
        @else
        <h3 style="text-align: center;">No user found</h3>
        @endunless
        <br>
        {{ $users->links() }}
        <div>
            <a style="display: flex; justify-content:center; text-decoration: none; color:#03a9f4; margin:10px 0;"
                href="/">Skip</a>
            <p style="text-align: center">You have to follow a user before you can view their post.</p>
        </div>
</body>
<script src="https://cdn.tailwindcss.com"></script>
</html>
