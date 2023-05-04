<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{$user->user->username}}</title>
        <link rel="stylesheet" href="/css/userprofile.css">
        <style>
            .active {
                border-bottom: 2px solid #1da1f2;
            }
        </style>
    </head>
    <body>
       <div class="main_container">
        @extends('layouts.nav')

        @section('nav-link')
        {{-- div of the second side --}}
        <div class="second_side">
            @if (session()->has('message'))

            <div class="message-div" x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show">
            <p class="message">
                {{session('message')}}
            </p>
            </div>
            @endif
           
            {{-- div containing the back button... --}}
           <div class="s-head">
            <div class="s-head-icon">
                <a href="#"><img src="/icon/arrow-left.svg" alt=""></a>
            </div>
            <div class="s-head-txt">
                <h3>{{$user->user->username}}</h3>
                <p style="font-size: small">{{count($user->user->tweets)}} Tweets</p>
                </div>
           </div>

           <div class="cover-photo">
                {{-- Add an image here later --}}
           </div>
           
           <div class="profile-picture">
            <div class="pp-cnt">
                <img onclick="showPhoto()" class="profile-photo" src="{{$user->user->profile->pphoto ? asset('storage/' .$user->user->profile->pphoto) : asset('images/default.jpeg')}}" alt="">
                @if ($user->user_id == auth()->user()->id)
                <p></p>
                @else
               
                <form action=" /users/{{$user->user->username}}/follow" method="POST">
                    @csrf
                    @if (auth()->user()->following->contains($user->id))
                    <button onclick="" class="button">Following</button>
                    @else
                    <button onclick="" class="button">Follow</button>
                    @endif
                </form>
                @endif
            </div>
           </div>
           <div class="rest">
             <div class="profile-details">
                @if ($user->user->followers->count() >= 3)
                <h2>{{$user->user->name}}&check;</h2>
                    @else
                     <h2>{{$user->user->name}}</h2>
                @endif
                <p class="whitesmoke">{{'@' . $user->user->username}}</p>
                <br>
                <p>{{$user->bio}}</p>
                <p>{{$user->email}}</p>
               <div class="joined"><img class="calender" src="/icon/calendar3.svg" alt=""><p class="whitesmoke">{{'Joined '. $user->user->created_at}}</p></div>
                <div class="followers">
                    <p class="whitesmoke"><span style="color:black; font-weight:bold;">{{$user->user->following->count()}} </span>Following</p>
                    <p class="whitesmoke"><span style="color:black; font-weight:bold;">{{$user->user->followers->count()}} </span>Followers</p>
                </div>
           </div>
           <div class="sections">
               <div class="sec-cnt">
                <h4 class="tablinks active" onclick="slide(event, 'tweet')" id="defaultOpen">Tweets</h4>
                <h4 class="tablinks" onclick="slide(event, 'tweetAndReply')">Tweets & replies ({{count($comments)}})</h4>
                <h4 class="tablinks" onclick="slide(event, 'media')">Media</h4>
                <h4>Likes</h4>
                </div>
           </div>
            <div class="tweetss" id="tweet">
            @unless (count($tweets) == 0)
            @foreach ($tweets as $tweet) 
            <div class="view-tweet">
                <div class="info">
                    <div class="prof">
                        <img class="p-photo" src="{{$user->user->profile->pphoto ? asset('storage/' .$user->user->profile->pphoto) : asset('images/default.jpeg')}}" alt="">
                        <div class="id">
                            <h3>{{$user->user->name}}</h3><p style="font-size:smaller;">{{'@'. $user->user->username}}</p><h5>{{$tweet->created_at}}</h5>
                            <img  class="menue" src="/icon/three-dots.svg" alt="">
                        </div>
                       
                    </div>
                    <div class="post">
                        <br>
                        <p style="font-weight: bold;">{{$tweet->tweets}}</p>
                    </div>
            </div>
        </div>
        @if ($tweet->image == '')
        <p></p>
    @else
    <div class="image-post">
        <img class="img-upload" src="/storage/{{$tweet->image}}" alt="">
    </div>
    @endif
        <ul class="reactions">
            <li> <img class="l-react" src="/icon/chat.svg" alt="">0</li>
            <li> <img class="l-react" src="/icon/repeat.svg" alt="">0</li>
            <li> <img class="l-react" src="/icon/heart.svg" alt="">0</li>
            <li> <img class="l-react" src="/icon/bar-chart.svg" alt="">0</li>
            <li> <img class="l-react" src="/icon/upload.svg" alt=""></li>
        </ul>
        @endforeach
        @else
        <h1 style="display: flex; justify-content:center; align-items:center; margin-top:20px;">No tweets found</h1>
            @endunless
           </div>

           <div class="tweetss" id="tweetAndReply" style="display: none;">
            @unless (count($comments) == 0)
            @foreach ($comments as $comment) 
            @php 
            $id = rand();
            @endphp   
            <div id = "id{{$id}}" class="view-tweet">
                <div class="info">
                    <div class="prof">
                        <img class="p-photo" src="{{$comment->user->profile->pphoto ? asset('storage/' . $comment->user->profile->pphoto) : asset('images/default.jpeg')}}" alt="">
                        <div class="id">
                            <h3>{{$comment->user->name}}</h3><p style="font-size: large;">{{'@'. $comment->user->username}}</p><h5>{{$comment->created_at}}</h5>
                            <img onclick="menue('id{{$id}}')" class="menue" src="icon/three-dots.svg" alt="">
                        </div>
                        <form class="men-ue" id="" action="{{""}}">
                            <button class="menue-li">Pin Post</button>
                            <button class="menue-li">Delete Post</button>
                            <button class="menue-li">Edit Post</button>
                        </form>
                    </div>
                         <div class="post">
                        <br>
                       {{-- <p style="color:gray">replying to <span style="color:rebeccapurple; cursor:pointer"> {{'@'. $tweet->user->username}}</span></p> --}}
                        <p style="font-weight: bold;">{{$comment->comment}}</p>
                    </div>
                </div>
            </div>
            @endforeach
        @else
        <h1 style="display: flex; justify-content:center; align-items:center; margin-top:20px;">No Comments made</h1>
            @endunless
           </div>
           {{-- End... --}}
           </div>
        </div>
        {{-- div of the last container --}}
        <div class="third-container">
            <div class="th-container">
                <div class="search-head">
                    <img class="search" src="icon/search.svg" alt=""> 
                <form action="#">
                    <input class="search" type="search" name="profile-search" id="" placeholder="Search {{$user->user->username}} pfofile">
                </form>
            </div>
           
            <div class="trending">
                <h3>Trends for you</h3>
                <div class="trend">
                    <div class="trending-cnt">
                        <div class="links">
                        <p style="color: rgb(192, 190, 190);">News . Trending</p>
                        <h4>BREAKING NEWS</h4><p></p>
                        <p style="color: rgb(192, 190, 190);">133k Tweets</p>
                    </div>
                    <div class="t-opt">
                        <img src="icon/three-dots.svg" alt="">
                    </div>
                </div>
                
                <div class="trending-cnt">
                    <div class="links">
                        <p style="color: rgb(192, 190, 190);">Trending in Nigeria</p>
                        <h4>Aunty Esther</h4><p></p>
                        <p style="color: rgb(192, 190, 190);">3k Tweets</p>
                    </div>
                    <div class="t-opt">
                        <img src="icon/three-dots.svg" alt="">
                    </div>
                </div>

                <div class="trending-cnt">
                    <div class="links">
                        <p style="color: rgb(192, 190, 190);">Trending in Nigeria</p>
                        <h4>Pery</h4><p></p>
                        <p style="color: rgb(192, 190, 190);">114k Tweets</p>
                    </div>
                    <div class="t-opt">
                        <img src="icon/three-dots.svg" alt="">
                    </div>
                </div>

                <div class="trending-cnt">
                    <div class="links">
                        <p style="color: rgb(192, 190, 190);">Trending in Nigeria</p>
                        <h4>Tech</h4><p></p>
                        <p style="color: rgb(192, 190, 190);">206M Tweets</p>
                    </div>
                    <div class="t-opt">
                        <img src="icon/three-dots.svg" alt="">
                    </div>
                </div>

                <div class="trending-cnt">
                    <div class="links">
                        <p style="color: rgb(192, 190, 190);">Trending in Nigeria</p>
                        <h4>Buhari</h4><p></p>
                        <p style="color: rgb(192, 190, 190);">133M Tweets</p>
                    </div>
                    <div class="t-opt">
                        <img src="icon/three-dots.svg" alt="">
                    </div>
                </div>
                <a href="#" style="text-decoration: none;">See more</a>
            </div>
        </div>
    </div>
            {{-- Div containing the others like suggestions --}}
             
        </div>
       </div>
    </body>
    @endsection

<div class="photo-display">
    <p style="cursor: pointer; font-size: 30px; width: 3%; margin-left: 90%; margin-bottom:6%" onclick="exitPhoto()">&times</p>
    <img class="big-photo" src="{{$user->user->profile->pphoto ? asset('storage/' .$user->user->profile->pphoto) : asset('images/default.jpeg')}}" alt="">
</div>
    <script>
        function menue(id) {
            var post = document.getElementById(id);
            var first = post.querySelector('.men-ue');
            first.classList.toggle("men-ue1");
    }

    function edit() {
        document.querySelector('.edit-profile').style.display = 'block';
        document.querySelector('.second_side').style.filter = 'blur(5px)';
    }

    function exit() {
        document.querySelector('.edit-profile').style.display = 'none';
         document.querySelector('.second_side').style.filter = 'none';
    }
    function showPhoto() {
        document.querySelector('.photo-display').style.display = 'block';
        document.querySelector('.second_side').style.filter = 'blur(5px)';
    }

    function exitPhoto() {
        document.querySelector('.photo-display').style.display = 'none';
         document.querySelector('.second_side').style.filter = 'none';
    }

    function slide(evt, tabName) {
    var i, tweetss, tablinks;

    tweetss = document.getElementsByClassName("tweetss");
    for (let i = 0; i < tweetss.length; i++) {
        tweetss[i].style.display = "none";
    }

    tablinks = document.getElementsByClassName("tablinks");
    for (let i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}

    </script>
    
</html>