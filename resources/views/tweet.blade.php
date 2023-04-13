<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$tweet['username']}}</title>
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

            <div class="message-div" x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show">
            <p class="message">
                {{session('message')}}
            </p>
            </div>
            @endif
            <div class="s-container">
                <h3 style="padding: 2px 8px;">{{$tweet->user->name .'`' . 's' }} Tweet</h3>
                <div class="cnt-body">
                   
                <br><br> 
                            <div class="view-tweet">
                                <div class="info">
                                    <div class="prof">
                                        <a href="/profile/{{$tweet->user->profile['id']}}"><img class="p-photo" src="{{$tweet->user->profile->pphoto ? asset('storage/' . $tweet->user->profile->pphoto) : asset('images/default.jpeg')}}" alt=""></a>
                                        <div class="id">
                                            <h3>{{$tweet->user->name}}</h3><p style="font-size: smaller;">{{'@'. $tweet->user->username}}</p><h5>.1h</h5>
                                            <img class="menue" src="icon/three-dots.svg" alt="">
                                        </div>
                                    </div>
                                    <div class="post">
                                        <br>
                                        <p style="font-weight: bold;">{{$tweet->tweets}}</p>
                                    </div>
                                </a> 
                            </div>
                        </div>
                        @if ($tweet->image == '')
                        <p></p>
                    @else
                    <div class="image-post">
                        <img class="img-upload" src="/storage/{{$tweet->image}}" alt="">
                    </div>
                    @endif
                    <p style="display: flex; justify-content:end; padding:0 5px;">{{$tweet->created_at}}</p>
                        <ul class="reactions">
                            <li> <img class="l-react" src="/icon/chat.svg" alt=""> 0</li>
                            <li> <img class="l-react" src="/icon/repeat.svg" alt="">0 </li>
                            <li> <img class="l-react" src="/icon/heart.svg" alt=""> 0</li>
                            <li> <img class="l-react" src="/icon/bar-chart.svg" alt=""> 0</li>
                            <li> <img class="l-react" src="/icon/upload.svg" alt=""></li>
                        </ul>
           
            <p>Comments will be displayed here later... :)</p>
        </div>
                </div>
            </div> 
           {{-- Div containing the search --}}
           <div class="third-container">
               <div class="th-container">
                   {{-- <div class="search-head">
                       <img class="search" src="icon/search.svg" alt=""> 
                       <input class="search" type="search" name="" id="" placeholder="Search">
                    </div> --}}
                    
                    {{-- Div containing the others like suggestions --}}
                    <div class="others">
                        <div class="follow">
                            <div class="follow-id">
                                @if ($tweet->user->id == auth()->user()->id)
                                <a href="/profile"><img class="p-photo" src="{{$tweet->user->profile->pphoto ? asset('storage/' . $tweet->user->profile->pphoto) : asset('images/default.jpeg')}}" alt=""></a>
                                    
                                @else
                                    
                                <a href="/profile/{{$tweet->user->profile['id']}}"><img class="p-photo" src="{{$tweet->user->profile->pphoto ? asset('storage/' . $tweet->user->profile->pphoto) : asset('images/default.jpeg')}}" alt=""></a>
                                @endif
                    <div class="f-text">
                        <p style="font-size: large; font-weight: bold;">{{$tweet->user->name}}</p>
                        <p style="font-size: small;">{{'@' . $tweet->user->username}}</p>
                    </div>
                </div>
                <form action=" /users/{{$tweet->user->username}}/follow" method="POST">
                    @csrf
                    @if (auth()->user()->following->contains($tweet->user->id))
                    <button onclick="" class="follow-btn">Following</button>
                    @else
                    <button onclick="" class="follow-btn">Follow</button>
                    @endif
                </form>
            </div>
        </div> 
        </div>
    </div>
</body>
@endsection

<script>
    function s(){
        var first = document.getElementById("logout");
        first.classList.toggle("l-out");
    }
    function f(){
        document.getElementById("follow").innerHTML = "Following";
        document.getElementById("follow").style.backgroundColor = "white";
        document.getElementById("follow").style.color = "black";
    }
</script>
</html>