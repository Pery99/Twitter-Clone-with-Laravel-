<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $tweet->user->name }}'s Tweet</title>
</head>
<link rel="stylesheet" href="/css/tweet.css">

<body>
    {{-- Div of the whole body --}}
    <div class="main_container">
        {{-- div of the first side --}}
        @extends('layouts.nav')
        @section('nav-link')
            {{-- div of the second side containing the tweet section e.t.c --}}
            <div class="second_side">
                @if (session()->has('message'))
                    <div class="message-div" x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show">
                        <p class="message">
                            {{ session('message') }}
                        </p>
                    </div>
                @endif
                <div class="s-container">
                    <h3 style="padding: 2px 8px; text-transform:capitalize">{{ $tweet->user->name . '`' . 's' }} Tweet</h3>
                    <div class="cnt-body">
                        <br><br>
                        <div class="view-tweet">
                            <div class="info">
                                <div class="prof">
                                    <a href="/profile/{{ $tweet->user->profile['id'] }}"><img class="p-photo"
                                            src="{{ $tweet->user->profile->pphoto ? asset('storage/' . $tweet->user->profile->pphoto) : asset('images/default.jpeg') }}"
                                            alt=""></a>
                                    <div class="id">
                                        @if ($tweet->user->followers->count() >= 3)
                                            <h3 style="text-transform: capitalize;">{{ $tweet->user->name }}&check;</h3>
                                            <p style="font-size: medium;">{{ '@' . $tweet->user->username }}</p>
                                            <h5>{{ $tweet->created_at }}</h5>
                                        @else
                                            <h3 style="text-transform: capitalize;">{{ $tweet->user->name }}</h3>
                                            <p style="font-size: medium;">{{ '@' . $tweet->user->username }}</p>
                                            <h5>{{ $tweet->created_at }}</h5>
                                        @endif
                                        <img class="menue" src="icon/three-dots.svg" alt="">
                                    </div>
                                </div>
                                <div class="post">
                                    <br>
                                    <p style="font-weight: bold;">{{ $tweet->tweets }}</p>
                                </div>
                                </a>
                            </div>
                        </div>

                        @if ($tweet->image == '')
                            <p></p>
                        @else
                            <div class="image-post">
                                <img class="img-upload" src="/storage/{{ $tweet->image }}" alt="">
                            </div>
                        @endif
                        <p style="display: flex; justify-content:end; padding:0 5px;">{{ $tweet->created_at }}</p>
                        <ul class="reactions">
                            <label for="comment">
                                <img class="l-react" src="/icon/chat.svg" alt="">
                                <p class="count">{{ count($tweet->comments) }}</p>
                            </label>
                            <form action="/bookmark" method="POST">
                                @csrf
                                <input type="hidden" name="tweet_id" id="" value="{{ $tweet->id }}">
                                <button style="background:none; border:none" type="submit">
                                    <img class="l-react bookmark-js" src="/icon/bookmark.svg" alt="">
                                    <p class="count">{{ count($tweet->bookmarks) }}</p>
                                </button>
                            </form>
                            @if (DB::table('likes')->where('tweet_id', $tweet->id)->where('user_id', auth()->user()->id)->first())
                                <form action="/like" method="POST">
                                    @csrf
                                    <input type="hidden" name="tweet_id" id="" value="{{ $tweet->id }}">
                                    <button style="background:none; border:none" type="submit">
                                        <img style="width: 30px; cursor:pointer; vertical-align: middle"
                                            src="/icon/2855967.png" alt="">
                                        <p class="count">{{ $tweet->likes->count() }}</p>
                                    </button>
                                </form>
                            @else
                                <form action="/like" method="POST">
                                    @csrf
                                    <input type="hidden" name="tweet_id" id="" value="{{ $tweet->id }}">
                                    <button style="background:none; border:none" type="submit">
                                        <img class="l-react" src="/icon/heart.svg" alt="">
                                        <p class="count">{{ $tweet->likes->count() }}</p>
                                    </button>
                                </form>
                            @endif
                            <li> <img class="l-react" src="/icon/repeat.svg" alt="">
                                <p class="count">0</p>
                            </li>
                            <li> <img class="l-react" src="icon/upload.svg" alt=""></li>
                        </ul>

                        <div class="comments">
                            <h4 style="text-align: start">Comments</h4>
                            @foreach ($tweet->comments as $comment)
                                <div class="com-bd">
                                    @if (auth()->user()->id == $comment->user->profile['id'])
                                        <a href="/profile"> <img class="p-photo"
                                                src="/storage/{{ $comment->user->profile->pphoto }}" alt=""></a>
                                    @else
                                        <a href="/profile/{{ $comment->user->profile['id'] }}"> <img class="p-photo"
                                                src="/storage/{{ $comment->user->profile->pphoto }}" alt=""></a>
                                    @endif
                                    <div class="details">
                                        <div class="rep">
                                            @if (count($comment->user->followers) >= 3)
                                                <h3 style="text-transform: capitalize;">{{ $comment->user->name }}&check;</h3>
                                            @else
                                                <h3 style="text-transform: capitalize;">{{ $comment->user->name }}</h3>
                                            @endif
                                            <p>{{ '@' . $comment->user->username }}</p>
                                        </div>
                                        <p style="color:gray">replying to <span
                                                style="color:rebeccapurple; cursor:pointer">
                                                {{ '@' . $tweet->user->username }}</span></p>
                                        <p>{{ $comment->comment }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <form action="/comment" method="POST" class="write-comment">
                            @csrf
                            <input type="hidden" name="tweet_id" value="{{ $tweet->id }}" id="">
                            <textarea name="comment" class="comment" id="comment" cols="75" rows="1"
                                placeholder="Tweet your reply" required></textarea>
                            <Button type="submit" class="send">Reply</Button>
                        </form>
                    </div>
                </div>
            </div>
            {{-- Div containing the search --}}
            <div class="third-container">
                <div class="th-container">
                    {{-- Div containing the others like suggestions --}}
                    <div class="others">
                        <div class="follow">
                            <div class="follow-id">
                                @if ($tweet->user->id == auth()->user()->id)
                                    <a href="/profile"><img class="p-photo"
                                            src="{{ $tweet->user->profile->pphoto ? asset('storage/' . $tweet->user->profile->pphoto) : asset('images/default.jpeg') }}"
                                            alt=""></a>
                                @else
                                    <a href="/profile/{{ $tweet->user->profile['id'] }}"><img class="p-photo"
                                            src="{{ $tweet->user->profile->pphoto ? asset('storage/' . $tweet->user->profile->pphoto) : asset('images/default.jpeg') }}"
                                            alt=""></a>
                                @endif
                                @if ($tweet->user->followers->count() >= 3)
                                    <div class="f-text">
                                        <p style="font-size: large; font-weight: bold;">{{ $tweet->user->name }}&check;
                                        </p>
                                        <p style="font-size: small;">{{ '@' . $tweet->user->username }}</p>
                                    </div>
                                @else
                                    <div class="f-text">
                                        <p style="font-size: large; font-weight: bold;text-transform: capitalize;">{{ $tweet->user->name }}</p>
                                        <p style="font-size: small;">{{ '@' . $tweet->user->username }}</p>
                                    </div>
                                @endif
                            </div>
                            <form action=" /users/{{ $tweet->user->username }}/follow" method="POST">
                                @csrf
                                @if (auth()->user()->following->contains($tweet->user->id))
                                    <button style="cursor: pointer" onclick="" class="follow-btn">Following</button>
                                @else
                                    <button style="cursor: pointer" onclick="" class="follow-btn">Follow</button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </body>
@endsection

<script>
    function s() {
        var first = document.getElementById("logout");
        first.classList.toggle("l-out");
    }

    function f() {
        document.getElementById("follow").innerHTML = "Following";
        document.getElementById("follow").style.backgroundColor = "white";
        document.getElementById("follow").style.color = "black";
    }
</script>
<script src="bookmark.js"></script>

</html>
